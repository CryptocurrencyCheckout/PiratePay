@extends('layouts.dashboard') 

@section('content')

<!-- Main Card Body-->
<div class="container">
          
    <!--Card Body Content-->
    <div class="card text-center">
        <div class="card-header">
            @lang('dashboard.demo_make_transaction')
        </div>
        <div class="card-body">

            <div class="container">

                <h2>PiratePay</h2>
                <h4>PirateChain (ARRR) Cryptocurrency Payment:</h4>
                <img src="{{ $payment['data']['crypto_qr'] }}" alt="ARRR QR Code" width="300" height="300">
                <p><b>ARRR Market Price:</b><br>{{ $payment['data']['crypto_market_price'] }}</p>
                <p><b>Store Order Price:</b><br>{{ $payment['data']['store_order_price'] }} {{ $payment['data']['store_currency'] }}</p>
                <p><b>ARRR Order Price:</b><br>{{ $payment['data']['crypto_price'] }}</p>
                <p><b>ARRR Address:</b><br>{{ $payment['data']['crypto_address'] }}</p>

            </div>
            
        </div>
    </div>
    <!--End Card Body Content-->

 
</div>
<!-- End Main Card Body-->

@endsection
