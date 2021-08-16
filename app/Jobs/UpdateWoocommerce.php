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

class UpdateWoocommerce implements ShouldQueue
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

            if (isset($settings['link']) && isset($settings['client']) && isset($settings['secret']) && $settings['platform'] == 'woocommerce') {
                $woocommerceAPI = $this->woocommercePaid($settings);
    
                if ($woocommerceAPI['id'] == $this->checkWallet['store_order_id'] && $woocommerceAPI['status'] == 'completed') {
                    $transaction = Transaction::find($this->checkWallet['id']);
                    $transaction->transmitted = 1;
                    $transaction->save();

                    $woocommerceNote = $this->woocommerceNote($settings);

                    if (isset($woocommerceNote['id'])) {
                        //do nothing
                    } else {
                        // Error 400 - Woocommerce Response = Cannot Update Woocommerce Order Note, Was unable to find/edit the note attached to the order.
                        Storage::append('WoocommerceErrors.log', Carbon::now() . ' ' . __('errors.woocommerce_error_note_failed'));
                        $error = new Error;
                        $error->code = '400';
                        $error->error = __('errors.woocommerce_error_note_failed');
                        $error->save();
                    }
                } else {
                    // Error: 412 - Woocommerce Response = Woocommerce indicated that it could not find the order ID, this error could indicate that the order was deleted, did not go through, or the wrong value was received.
                    Storage::append('WoocommerceErrors.log', Carbon::now() . ' ' . __('errors.woocommerce_error_bad_orderid'));
                    $error = new Error;
                    $error->code = '412';
                    $error->error = __('errors.woocommerce_error_bad_orderid');
                    $error->save();
                }
            } else {
                // Error: 400 - Woocommerce Response = Some of the Woocommerce settings inside PiratePay appear to not be set.
                Storage::append('WoocommerceErrors.log', Carbon::now() . ' ' . __('errors.woocommerce_error_settings_missing'));
                $error = new Error;
                $error->code = '400';
                $error->error = __('errors.woocommerce_error_settings_missing');
                $error->save();
            }
        } else {
            //Error 400 - Woocommerce Response = Cannot Update Order, Transaction Values appear to be missing. This could happen if the queue was cleared before completing.
            Storage::append('WoocommerceErrors.log', Carbon::now() . ' ' . __('errors.woocommerce_error_values_missing'));
            $error = new Error;
            $error->code = '400';
            $error->error = __('errors.woocommerce_error_values_missing');
            $error->save();
        }
    }


    private function woocommercePaid($settings)
    {
        $client = $settings['client'];

        try {
            $secret = Crypt::decryptString($settings['secret']);
        } catch (DecryptException $e) {
            // Error 401 - Decryption Response = PiratePay was unable to Decrypt the api keys, this decryption error could be if the platforms encryption keys were updated/changed/deleted, or if they were never created during installation.
            Storage::append('WoocommerceErrors.log', Carbon::now() . ' ' . __('errors.decryption_error_failed'));
            $error = new Error;
            $error->code = '401';
            $error->error = __('errors.decryption_error_failed');
            $error->save();
        }

        $response = Http::withHeaders([
            'Accept'        => 'application/json',
            'Content-Type' => 'application/json',


        ])->withOptions([
            'verify' => false,

        ])->withBasicAuth($client, $secret)->post($settings['link'] . '/orders/' . $this->checkWallet['store_order_id'] , [
            
            'status' => 'completed',
            'transaction_id' => 'PiratePay # ' . $this->checkWallet['id'],

        ]);

        if ($response->successful()) {
            return $response->json();
        } elseif ($response->clientError()) {
            // Error 400 - Woocommerce Response = 400 Bad Response. This could be caused by incorrect API link, wrong client credentials, or incorrect/missing Order ID. You may also need to enable HTTP_AUTHORIZATION inside your Wordpress htaccess file to gain access to the wordpress rest API.
            Storage::append('WoocommerceErrors.log', Carbon::now() . ' ' . __('errors.woocommerce_error_bad_client_request'));
            $error = new Error;
            $error->code = '400';
            $error->error = __('errors.woocommerce_error_bad_client_request');
            $error->save();
        } elseif ($response->serverError()) {
            // Error 500 - Woocommerce Response = 500 Bad Response. This is usually caused when the server does not respond at all. Verify the WooCommerce Server is up, and check the API Link in Settings.
            Storage::append('WoocommerceErrors.log', Carbon::now() . ' ' . __('errors.woocommerce_error_bad_server_request'));
            $error = new Error;
            $error->code = '500';
            $error->error = __('errors.woocommerce_error_bad_server_request');
            $error->save();
        }
    }


    private function woocommerceNote($settings)
    {
        $client = $settings['client'];

        try {
            $secret = Crypt::decryptString($settings['secret']);
        } catch (DecryptException $e) {
            // Error 401 - Decryption Response = PiratePay was unable to Decrypt the api keys, this decryption error could be if the platforms encryption keys were updated/changed/deleted, or if they were never created during installation.
            Storage::append('WoocommerceErrors.log', Carbon::now() . ' ' . __('errors.decryption_error_failed'));

            $error = new Error;
            $error->code = '401';
            $error->error = __('errors.decryption_error_failed');
            $error->save();
        }

        $response = Http::withHeaders([
            'Accept'        => 'application/json',
            'Content-Type' => 'application/json',

        ])->withOptions([
            'verify' => false,

        ])->withBasicAuth($client, $secret)->post($settings['link'] . '/orders/' . $this->checkWallet['store_order_id'] . '/notes' , [
            
            'note' => 'PiratePay - Order ' . $this->checkWallet['store_order_id'] . ' Paid, ARRR Received: ' . $this->checkWallet['crypto_received'] . ' ARRR Expected: ' . $this->checkWallet['crypto_expected'] . ' Accuracy: ' . $this->checkWallet['crypto_percent'] . '% ARRR Market Price: ' . $this->checkWallet['crypto_market_price'] . ' To Address: ' . $this->checkWallet['crypto_address'],

        ]);

        if ($response->successful()) {
            return $response->json();
        } elseif ($response->clientError()) {
            // Error 400 - Woocommerce Response = 400 Bad Response. This could be caused by incorrect API link, wrong client credentials, or incorrect/missing Order ID.
            Storage::append('WoocommerceErrors.log', Carbon::now() . ' ' . __('errors.woocommerce_error_bad_client_request'));
            $error = new Error;
            $error->code = '400';
            $error->error = __('errors.woocommerce_error_bad_client_request');
            $error->save();
        } elseif ($response->serverError()) {
            // Error 500 - Woocommerce Response = 500 Bad Response. This is usually caused when the server does not respond at all. Verify the WooCommerce Server is up, and check the API Link in Settings.
            Storage::append('WoocommerceErrors.log', Carbon::now() . ' ' . __('errors.woocommerce_error_bad_server_request'));
            $error = new Error;
            $error->code = '500';
            $error->error = __('errors.woocommerce_error_bad_server_request');
            $error->save();
        }
    }
}
