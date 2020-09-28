<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transaction;
use App\Error;
use App\User;

use Illuminate\Support\Facades\Http;
use Carbon\Carbon;
use Storage;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        
        $transactions = Transaction::orderBy('id', 'desc')->paginate(7);
        return view('dashboard.dashboard')->with('transactions', $transactions);

    }


    /**
     * Display the specified transaction.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function transaction($id)
    {
        
        $transaction = Transaction::find($id);
        return view('dashboard.transaction')->with('transaction', $transaction);

    }

    
    /**
     * Show the application settings.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function settings()
    {
        
        // $transactions = Transaction::paginate(15)->sortDesc();
        return view('dashboard.settings');

    }



    /**
     * Show the application logs.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function logs()
    {

        $errors = Error::orderBy('id', 'desc')->paginate(8);
        return view('dashboard.logs')->with('errors', $errors);

    }


    public function api_token()
    {
        return view('dashboard.api_token');
    }



}
