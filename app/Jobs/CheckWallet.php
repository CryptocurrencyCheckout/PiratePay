<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Denpa\Bitcoin\Traits\Bitcoind;
use App\Transaction;
use Carbon\Carbon;
use Exception;
use App\Error;
use Storage;



class CheckWallet implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $transaction;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($transaction)
    {
        $this->transaction = $transaction;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

        $requiredAccuracy = 90;
        $maximumChecks = 36;
        $minutesBetweenChecks = 5;
        
        $walletChecks = Transaction::find($this->transaction['id']);


        if ( $walletChecks->wallet_checks >= $maximumChecks){

            Storage::append('WalletCheck.log', Carbon::now() . ' ' . __('errors.wallet_check_not_found') . ' Order ID: ' . $this->transaction['order_id'] . '  Attempts: ' . $maximumChecks);

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

                    CheckWallet::dispatch($checkWallet)->delay(now()->addminutes($minutesBetweenChecks));

                } else {

                    $remainingBalance = $endBalance - $this->transaction['start_balance'];
                    $percentageDifference = ($remainingBalance - $this->transaction['crypto_expected']) / $this->transaction['crypto_expected'] * 100;
                    $percentAccurate = 100 - abs($percentageDifference);

                    if ($percentAccurate >= $requiredAccuracy){

                        $checkWallet = Transaction::find($this->transaction['id']);
                        $checkWallet->end_balance = $endBalance;
                        $checkWallet->crypto_received = $remainingBalance;
                        $checkWallet->crypto_percent = $percentAccurate;
                        $checkWallet->status = 1;
                        $checkWallet->save();

                        UpdateWoocommerce::dispatch($checkWallet)->delay(now()->addminutes(1));

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



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getBalance()
    {

        try {

            $pirateRPC = bitcoind()->client('pirate');
            $z_balance = $pirateRPC->z_getbalance($this->transaction['crypto_address']);
            
            return $z_balance->get();

        } catch (Exception $e) {

            report($e);
            return false;

        }


    }


}
