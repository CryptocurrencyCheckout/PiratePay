<?php

namespace App\Jobs;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Denpa\Bitcoin\Traits\Bitcoind;
use App\Transaction;
use Carbon\Carbon;
use App\Setting;
use Exception;
use App\Error;
use Storage;



class CheckWallet implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $transaction, $requiredConfirmations, $maximumChecks, $minutesBetweenChecks, $requiredAccuracy;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($transaction)
    {
        $this->transaction = $transaction;

        $this->requiredConfirmations = env('SCAN_REQUIRED_CONFIRMATIONS', 1);
        $this->requiredAccuracy = env('SCAN_REQUIRED_ACCURACY', 98);

        $this->minutesBetweenChecks = env('SCAN_MINUTES_BETWEEN', 5);
        $this->maximumChecks = env('SCAN_MAX_ATTEMPTS', 36);

    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {  

        $walletChecks = Transaction::find($this->transaction['id']);


        if ( $walletChecks->wallet_checks >= $this->maximumChecks){

            Storage::append('WalletCheck.log', Carbon::now() . ' ' . __('errors.wallet_check_not_found') . ' Order ID: ' . $this->transaction['store_order_id'] . '  Attempts: ' . $this->maximumChecks);

            $checkWallet = Transaction::find($this->transaction['id']);
            $checkWallet->status = 2;
            $checkWallet->save();

            $error = new Error;
            $error->code = '402';
            $error->error = __('errors.wallet_check_not_found');
            $error->save();


        } else {

            $endBalance = $this->getBalance();

            if (isset($endBalance)){

                if ($endBalance == $this->transaction['start_balance']){

                    $checkWallet = Transaction::find($this->transaction['id']);
                    $checkWallet->wallet_checks = $this->transaction['wallet_checks'] + '1';
                    $checkWallet->end_balance = $endBalance;
                    $checkWallet->save();

                    CheckWallet::dispatch($checkWallet)->delay(now()->addminutes($this->minutesBetweenChecks));

                } else {

                    $expectedTotal = $this->transaction['start_balance'] + $this->transaction['crypto_expected'];
                    $percentRecieved = ($endBalance - $this->transaction['start_balance']) / $this->transaction['crypto_expected'] * 100;

                    $remainingBalance = $endBalance - $this->transaction['start_balance'];
                    $percentageDifference = ($remainingBalance - $this->transaction['crypto_expected']) / $this->transaction['crypto_expected'] * 100;
                    $percentAccurate = 100 - abs($percentageDifference); 

                    if ($percentAccurate >= $this->requiredAccuracy){

                        $checkWallet = Transaction::find($this->transaction['id']);
                        $checkWallet->end_balance = $endBalance;
                        $checkWallet->crypto_received = $remainingBalance;
                        $checkWallet->crypto_percent = $percentAccurate;
                        $checkWallet->status = 1;
                        $checkWallet->save();

                        $this->sendToModule($checkWallet);

                    } elseif ($endBalance >= $expectedTotal) {

                        $checkWallet = Transaction::find($this->transaction['id']);
                        $checkWallet->end_balance = $endBalance;
                        $checkWallet->crypto_received = $remainingBalance;
                        $checkWallet->crypto_percent = $percentRecieved;
                        $checkWallet->status = 3;
                        $checkWallet->save();

                        $this->sendToModule($checkWallet);

                    } else {

                        if ( $walletChecks->status == 4){

                            $checkWallet = Transaction::find($this->transaction['id']);
                            $checkWallet->wallet_checks = $this->transaction['wallet_checks'] + '1';
                            $checkWallet->end_balance = $endBalance;
                            $checkWallet->crypto_received = $remainingBalance;
                            $checkWallet->crypto_percent = $percentRecieved;
                            $checkWallet->save();

                            CheckWallet::dispatch($checkWallet)->delay(now()->addminutes($this->minutesBetweenChecks));

                        } else {

                            Storage::append('WalletCheck.log', Carbon::now() . ' ' . __('errors.wallet_check_underpaid') . ' Order ID: ' . $this->transaction['store_order_id'] . ' Received: ' . $this->transaction['crypto_received'] . ' Expected: ' . $this->transaction['crypto_expected']);

                            $error = new Error;
                            $error->code = '402';
                            $error->error = __('errors.wallet_check_underpaid');
                            $error->save();
    
                            $checkWallet = Transaction::find($this->transaction['id']);
                            $checkWallet->wallet_checks = $this->transaction['wallet_checks'] + '1';
                            $checkWallet->end_balance = $endBalance;
                            $checkWallet->crypto_received = $remainingBalance;
                            $checkWallet->crypto_percent = $percentRecieved;
                            $checkWallet->status = 4;
                            $checkWallet->save();
    
                            CheckWallet::dispatch($checkWallet)->delay(now()->addminutes($this->minutesBetweenChecks));

                        }

                    }

                }

        
            } else {

                Storage::append( 'WalletCheck.log', Carbon::now() . ' ' . __('errors.wallet_error_balance_no_response') );

                $error = new Error;
                $error->code = '503';
                $error->error = __('errors.wallet_error_balance_no_response');
                $error->save();

            }

        }

    }

    private function getBalance()
    {

        try {
            $pirateRPC = bitcoind()->client('pirate');
            $z_balance = $pirateRPC->z_getbalance($this->transaction['crypto_address'], $this->requiredConfirmations);
            return $z_balance->get();

        } catch (Exception $e) {

            report($e);
            return false;

        }

    }

    private function checkSettings()
    {

        try {
            $settings = Setting::findOrFail(1);
            return $settings;
        } catch (ModelNotFoundException $exception) {
            $error = new Error;
            $error->code = '404';
            $error->error = __('errors.setting_error_not_found');
            $error->save();
        }

    }

    private function sendToModule($checkWallet)
    {

        $settings = $this->checkSettings();
        if ($settings['platform'] == 'woocommerce'){
            UpdateWoocommerce::dispatch($checkWallet)->delay(now()->addminutes(1));
        } elseif ($settings['platform'] == 'api'){
            // do nothing, no module used for standard API calls.
        } else {
            //do nothing, no module selected.
        }
    }

}
