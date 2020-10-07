<?php

namespace App\Http\Controllers\API;
use App\Http\Resources\Address as AddressResource;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\GetAddress;
use Denpa\Bitcoin\Traits\Bitcoind;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Psr7;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Validator;
use App\Jobs\CheckWallet;
use App\Transaction;
use Carbon\Carbon;
use App\Error;
use Exception;
use Purifier;
use Storage;


class PirateController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        
        $this->middleware('auth:api');

    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $validator = Validator::make($request->all(), [

            'store_currency' => 'required|max:5',
            'store_order_id' => 'required|max:255',
            'store_order_price' => 'required|numeric|max:255',
            'store_buyer_name' => 'max:255',
            'store_buyer_email' => 'email',

        ]);

        if ($validator->fails()) {

            Storage::append( 'ApiErrors.log', Carbon::now() . ' ' . __('errors.api_error_missing_fields') );

            $error = new Error;
            $error->code = '400';
            $error->error = __('errors.api_error_missing_fields');
            $error->save();

            return response()->json(
                ['error' => $validator->errors()],
                400
            );

        };

        $store_currency = Purifier::clean($request->input('store_currency'));
        $store_order_id = Purifier::clean($request->input('store_order_id'));
        $store_order_price = Purifier::clean($request->input('store_order_price'));
        $store_buyer_name = Purifier::clean($request->input('store_buyer_name'));
        $store_buyer_email = Purifier::clean($request->input('store_buyer_email'));


        if ( empty($store_order_id) && empty($store_order_price) && empty($store_buyer_name) && empty($store_buyer_email) ){

            Storage::append( 'ApiErrors.log', Carbon::now() . ' ' . __('errors.api_error_missing_fields') );

            $error = new Error;
            $error->code = '400';
            $error->error = __('errors.api_error_missing_fields');
            $error->save();

            return response()->json(
                ['error' => __('errors.api_error_missing_fields')],
                400
            );

        } else {

            $crypto_address = $this->getAddress();

            if (empty($crypto_address)){

                Storage::append( 'WalletErrors.log', Carbon::now() . ' ' . __('errors.wallet_error_address_no_response') );

                $error = new Error;
                $error->code = '503';
                $error->error = __('errors.wallet_error_address_no_response');
                $error->save();

                return response()->json(
                    ['error' => __('errors.wallet_error_address_no_response')],
                    503
                );
    
            } else {

                $start_balance = $this->getBalance($crypto_address);

                if (isset($start_balance)){

                    $crypto_market_price = $this->getMarketPrice();
                    $crypto_conversion = $store_order_price / $crypto_market_price;
                    $crypto_price = number_format($crypto_conversion, 6, '.', '');
                    
        
                    $data = [];
                    $data['crypto_address'] = $crypto_address;
                    $data['start_balance'] = $start_balance;
    
                    $data['crypto_market_price'] = $crypto_market_price;
                    $data['crypto_price'] = $crypto_price;
                    
                    $data['store_currency'] = $store_currency;
                    $data['store_order_id'] = $store_order_id;
                    $data['store_order_price'] = $store_order_price;
                    $data['store_buyer_name'] = $store_buyer_name;
                    $data['store_buyer_email'] = $store_buyer_email;
                    
                    $transaction = $this->writeDatabase($data);

                    CheckWallet::dispatch($transaction)->delay(now()->addMinutes(1));
                    
                    return new AddressResource($transaction);

                } else {

                    Storage::append( 'WalletErrors.log', Carbon::now() . ' ' . __('errors.wallet_error_balance_no_response') );

                    $error = new Error;
                    $error->code = '503';
                    $error->error = __('errors.wallet_error_balance_no_response');
                    $error->save();

                    return response()->json(
                        ['error' => __('errors.wallet_error_balance_no_response')],
                        503
                    );

                }
                
            }

        }

    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getAddress()
    {

        try {

            $pirateRPC = bitcoind()->client('pirate');
            $z_address = $pirateRPC->z_getnewaddress();
            
            return $z_address->get();

        } catch (Exception $e) {

            report($e);
            return false;

        }

    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getBalance($crypto_address)
    {

        try {

            $pirateRPC = bitcoind()->client('pirate');
            $z_balance = $pirateRPC->z_getbalance($crypto_address);
            
            return $z_balance->get();

        } catch (Exception $e) {

            report($e);
            return false;

        }

    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function writeDatabase($data)
    {

        $qr_code = 'https://chart.googleapis.com/chart?chs=300x300&chld=L|2&cht=qr&chl=pirate:' . $data['crypto_address'] . '?amount=' . $data['crypto_price'] . '&message=' . $data['store_order_id'] . '&label='. $data['store_order_id'] . '';

        $transaction = new Transaction;
        $transaction->store_currency  = $data['store_currency'];
        $transaction->store_order_id = $data['store_order_id'];
        $transaction->store_order_price = $data['store_order_price'];
        $transaction->store_buyer_name = $data['store_buyer_name'];
        $transaction->store_buyer_email = $data['store_buyer_email'];

        $transaction->crypto_market_price = $data['crypto_market_price'];
        $transaction->crypto_price = $data['crypto_price'];
        
        $transaction->crypto_address = $data['crypto_address'];

        $transaction->start_balance = $data['start_balance'];
        $transaction->end_balance = null;

        $transaction->crypto_expected = $data['crypto_price'];
        $transaction->crypto_received = null;
        $transaction->crypto_percent = null;
        $transaction->crypto_qr = $qr_code;

        $transaction->status = '0';
        $transaction->wallet_checks = '0';
        $transaction->transmitted = '0';

        $transaction->save();

        return $transaction;

    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getMarketPrice()
    {

        $response = Http::withHeaders([
            'Accept'        => 'application/json',
            'Content-Type' => 'application/json',

        ])->withOptions([
            'verify' => true,

        ])->get(url('https://cryptocurrencycheckout.com/api'));

        $response->throw()->json();

        return $response['arrr']['usd']['price'];

    }


}
