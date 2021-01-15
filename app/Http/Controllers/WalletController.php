<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Denpa\Bitcoin\Traits\Bitcoind;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;
use App\Error;
use Storage;

use Exception;

class WalletController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('throttle:30');
    }

    /**
     * Show the application wallet Dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function dashboard()
    {

        $getInfo = $this->getInfo();
        $getTotalBalance = $this->getTotalBalance();
        $getInfoExplorer = $this->getInfoExplorer();


        if ($getTotalBalance && $getInfo){

            if ($getInfoExplorer){

                return view('dashboard.wallet')->with('wallet', $getInfo)->with('balance', $getTotalBalance)->with('explorer', $getInfoExplorer);

            } else {

                return view('dashboard.wallet')->with('wallet', $getInfo)->with('balance', $getTotalBalance);  
            }

        } else {

            if ($getInfoExplorer){

                return view('dashboard.wallet')->with('explorer', $getInfoExplorer);

            } else {

                return view('dashboard.wallet');

            }

        }
        
    }



    /**
     * Show the application wallet Dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    private function getInfo()
    {

        try {

            $pirateRPC = bitcoind()->client('pirate');
            $getinfo = $pirateRPC->getinfo();
            
            return $getinfo->get();

        } catch (Exception $e) {

            Storage::append( 'WalletErrors.log', Carbon::now() . ' ' . __('errors.wallet_error_getinfo_no_response') );

            $error = new Error;
            $error->code = '400';
            $error->error = __('errors.wallet_error_getinfo_no_response');
            $error->save();

            return null;

        }

    }

    /**
     * Show the application wallet Dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    private function getTotalBalance()
    {

        try {

            $pirateRPC = bitcoind()->client('pirate');
            $getinfo = $pirateRPC->z_gettotalbalance();
            
            return $getinfo->get();

        } catch (Exception $e) {


            Storage::append( 'WalletErrors.log', Carbon::now() . ' ' . __('errors.wallet_error_getbalance_no_response') );

            $error = new Error;
            $error->code = '400';
            $error->error = __('errors.wallet_error_getbalance_no_response');
            $error->save();

            return null;

        }


    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    private function getInfoExplorer()
    {

        $response = Http::withHeaders([
            'Accept'        => 'application/json',
            'Content-Type' => 'application/json',

        ])->withOptions([
            'verify' => false,

        ])->get(url('http://pirate.explorer.dexstats.info/insight-api-komodo/status?q=getinfo'));

        $response->json();

        if ($response->successful()){

            return $response;

        } else {

            Storage::append( 'ExplorerErrors.log', Carbon::now() . ' ' . __('errors.explorer_error_getinfo_no_response') );

            $error = new Error;
            $error->code = '400';
            $error->error = __('errors.explorer_error_getinfo_no_response');
            $error->save();

            return null;

        }



    }


}
