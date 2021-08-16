<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Http;
use App\Transaction;
use Carbon\Carbon;
use App\Setting;
use App\Error;
use Storage;

class UpdateWhmcs implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $checkWallet;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($checkWallet)
    {
        $this->checkWallet = $checkWallet;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

        if (isset($this->checkWallet)) {
            $settings = Setting::find(1);

            if (isset($settings['key']) && $settings['platform'] == 'whmcs') {
                if ($this->checkWallet['transmitted'] == 0) {
                    $whmcsAPI = $this->whmcsPaid($settings);

                    if ($whmcsAPI) {
                        $transaction = Transaction::find($this->checkWallet['id']);
                        $transaction->transmitted = 1;
                        $transaction->save();
                    }
                } else {
                    //do nothing.
                }
            } else {
                // Error: 400 - WHMCS Response = Some of the WHMCS settings inside PiratePay appear to not be set.
                Storage::append('WhmcsErrors.log', Carbon::now() . ' ' . __('errors.whmcs_error_settings_missing'));
        
                $error = new Error;
                $error->code = '400';
                $error->error = __('errors.whmcs_error_settings_missing');
                $error->save();
            }
        } else {
            //Error 400 - WHMCS Response = Cannot Update Order, Transaction Values appear to be missing. This could happen if the queue was cleared before completing.
            Storage::append('WhmcsErrors.log', Carbon::now() . ' ' . __('errors.whmcs_error_values_missing'));
        
            $error = new Error;
            $error->code = '400';
            $error->error = __('errors.whmcs_error_values_missing');
            $error->save();
        }
    }

    private function whmcsPaid($settings)
    {

        $key = Crypt::decryptString($settings['key']);
        $store_id = $this->checkWallet['store_order_id'];
        $trans_id = 'ARRR:' . $this->checkWallet['crypto_price'];

        $hash = md5($store_id . $trans_id . $key);


        $response = Http::asForm()->withHeaders([

            'Accept'        => 'application/json',
            'Content-Type' => 'application/json',

        ])->post($this->checkWallet['callback'], [

            'x_status' => 'success',
            'x_invoice_id' => $store_id,
            'x_trans_id' => $trans_id,
            'x_amount' => $this->checkWallet['store_order_price'],
            'x_fee' => '0.00',
            'x_hash' => $hash,

        ]);


        if ($response->successful()) {
            return true;
        } elseif ($response->clientError()) {
            // Error 400 - WHMCS Response = 400 Bad Response. This could be caused by incorrect Callback Key, wrong URL, or client credentials.
            Storage::append('WhmcsErrors.log', Carbon::now() . ' ' . __('errors.whmcs_error_bad_client_request'));

            $error = new Error;
            $error->code = '400';
            $error->error = __('errors.whmcs_error_bad_client_request');
            $error->save();
        } elseif ($response->serverError()) {
            // Error 500 - WHMCS Response = 500 Bad Response. This is usually caused when the server does not respond at all. Verify the WHMCS Server is up, and check the Callback URL..
            Storage::append('WhmcsErrors.log', Carbon::now() . ' ' . __('errors.whmcs_error_bad_server_request'));

            $error = new Error;
            $error->code = '500';
            $error->error = __('errors.whmcs_error_bad_server_request');
            $error->save();
        }
    }
}
