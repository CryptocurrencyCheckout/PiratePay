<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Crypt;
use Illuminate\Http\Request;
use App\Setting;
use Purifier;

class SettingController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('throttle:15');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $settings = Setting::find(1);
        return view('dashboard.settings')->with('settings', $settings);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

        $this->validate($request, [
            'platform'=> 'required|alpha_num',
            'client'=> 'required_if:platform,woocommerce',
            'secret'=> 'required_if:platform,woocommerce',
            'link'=> 'required_if:platform,woocommerce',
            'key'=> 'required_if:platform,whmcs',
            ]);

        $platform = Purifier::clean($request->input('platform'));
        $client = Purifier::clean($request->input('client'));
        $secret = Purifier::clean($request->input('secret'));
        $link = Purifier::clean($request->input('link'));
        $key = Purifier::clean($request->input('key'));
        
        Setting::updateOrCreate(
            [
            'id' => 1,
            ],
            [
            'platform' => $platform,
            'client' => $client,
            'secret' => $this->encrypt($secret),
            'link' => $link,
            'key' => $this->encrypt($key),
            ]
        );

        return redirect('/dashboard')->with('success', 'Information Received');
    }

    private function encrypt($value)
    {
        if (empty($value)) {
            return null;
        } else {
            return Crypt::encryptString($value);
        }
    }
}
