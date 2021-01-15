<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Purifier;

class DemoController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('throttle:10');
    }


    /**
     * Show the application wallet Dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function demonstration()
    {
        return view('dashboard.demo');
    }

    
    /**
     * Show the application wallet Dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function testTransaction(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'api_key' => 'required|max:255',
        ]);

        $api_key = Purifier::clean($request->input('api_key'));
        $date = Carbon::now();

        $response = Http::withHeaders([
            'Accept'        => 'application/json',
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer ' . $api_key,

        ])->withOptions([
            'verify' => false,

        ])->post(url('/api/v1/initiate'), [
            'store_order_price' => '0.01',
            'store_order_id' => 'test ' . $date->toTimeString(),
            'store_currency' => 'usd',
            'store_buyer_name' => 'John Doe',
            'store_buyer_email' => 'test@test.com',

        ]);

        if ($response->successful()){

            $payment = $response->json();

            return view('dashboard.demo_pay')->with('payment', $payment);

        } else {

            return 'Error!';
            
        }
        
    }


}
