<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
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

        if (isset($this->checkWallet)){


            $settings = Setting::find(1);

            if (isset($settings['link']) && isset($settings['client']) && isset($settings['secret']) && $settings['platform'] == 'woocommerce' ){
    
                $woocommerceAPI = $this->woocommercePaid($settings);
    
                if ( $woocommerceAPI['id'] == $this->checkWallet['store_order_id'] && $woocommerceAPI['status'] == 'completed' ) {
        
                    
                    $transaction = Transaction::find($this->checkWallet['id']);
                    $transaction->transmitted = 1;
                    $transaction->save();

                    $woocommerceNote = $this->woocommerceNote($settings);

                    if ( isset($woocommerceNote['id']) ) {



                    } else {

                        Storage::append('WoocommerceErrors.log', Carbon::now() . ' ' . __('errors.woocommerce_error_note_failed') );

                        $error = new Error;
                        $error->code = '400';
                        $error->error = __('errors.woocommerce_error_note_failed');
                        $error->save();

                    }
        
        
                } else {
        
                    Storage::append('WoocommerceErrors.log', Carbon::now() . ' ' . __('errors.woocommerce_error_bad_orderid') );
        
                    $error = new Error;
                    $error->code = '412';
                    $error->error = __('errors.woocommerce_error_bad_orderid');
                    $error->save();
        
                }
    
    
            } else {
    
                Storage::append('WoocommerceErrors.log', Carbon::now() . ' ' . __('errors.woocommerce_error_settings_missing') );
        
                $error = new Error;
                $error->code = '400';
                $error->error = __('errors.woocommerce_error_settings_missing');
                $error->save();
    
            }
    

        } else {

            Storage::append('WoocommerceErrors.log', Carbon::now() . ' ' . __('errors.woocommerce_error_values_missing') );
        
            $error = new Error;
            $error->code = '400';
            $error->error = __('errors.woocommerce_error_values_missing');
            $error->save();

        }



    }


    private function woocommercePaid($settings)
    {

        try {
            $client = Crypt::decryptString($settings['client']);
            $secret = Crypt::decryptString($settings['secret']);
        } catch (DecryptException $e) {
            
            Storage::append('WoocommerceErrors.log', Carbon::now() . ' ' . __('errors.decryption_error_failed') );

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

        if ( $response->successful() ){

            return $response->json();

        } elseif ( $response->clientError() ){

            Storage::append('WoocommerceErrors.log', Carbon::now() . ' ' . __('errors.woocommerce_error_bad_client_request') );

            $error = new Error;
            $error->code = '400';
            $error->error = __('errors.woocommerce_error_bad_client_request');
            $error->save();

        } elseif ( $response->serverError() ){

            Storage::append('WoocommerceErrors.log', Carbon::now() . ' ' . __('errors.woocommerce_error_bad_server_request') );

            $error = new Error;
            $error->code = '500';
            $error->error = __('errors.woocommerce_error_bad_server_request');
            $error->save();

        }

    }


    private function woocommerceNote($settings)
    {

        try {
            $client = Crypt::decryptString($settings['client']);
            $secret = Crypt::decryptString($settings['secret']);
        } catch (DecryptException $e) {
            
            Storage::append('WoocommerceErrors.log', Carbon::now() . ' ' . __('errors.decryption_error_failed') );

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

        if ( $response->successful() ){

            return $response->json();

        } elseif ( $response->clientError() ){

            Storage::append('WoocommerceErrors.log', Carbon::now() . ' ' . __('errors.woocommerce_error_bad_client_request') );

            $error = new Error;
            $error->code = '400';
            $error->error = __('errors.woocommerce_error_bad_client_request');
            $error->save();

        } elseif ( $response->serverError() ){

            Storage::append('WoocommerceErrors.log', Carbon::now() . ' ' . __('errors.woocommerce_error_bad_server_request') );

            $error = new Error;
            $error->code = '500';
            $error->error = __('errors.woocommerce_error_bad_server_request');
            $error->save();

        }

    }






}
