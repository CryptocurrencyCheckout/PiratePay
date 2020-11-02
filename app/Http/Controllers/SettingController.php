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
            'client'=> 'required',
            'secret'=> 'required',
            'link'=> 'required',
            ]);

        $platform = Purifier::clean($request->input('platform'));
        $client = Purifier::clean($request->input('client'));
        $secret = Purifier::clean($request->input('secret'));
        $link = Purifier::clean($request->input('link'));

        $vote = Setting::updateOrCreate([
            'id' => 1,
        ],
        [
            'platform' => $platform,
            'client' => Crypt::encryptString($client),
            'secret' => Crypt::encryptString($secret),
            'link' => $link,
        ]);

        return redirect('/dashboard')->with('success', 'Information Received');

    }

}
