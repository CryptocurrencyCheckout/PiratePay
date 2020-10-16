@extends('layouts.dashboard')

@section('content')
<div class="container">

        

    <div class="card">


        <div class="card-header"> 

            <div class="row">

                <div class="col-12 col-md-6">

                    <span class="float-left pr-3"><strong>@lang('dashboard.transaction') </strong> #{{$transaction->id}} </span>

                </div>

                <div class="col-12 col-md-6">

                    <span class="float-left float-md-right">{{date_format($transaction->created_at, 'M d, Y - g:i a')}}</span>

                </div>

            </div>               
            
        </div>

        <div class="card-body">

            <div class="table-responsive mb-2">
                <table class="table table-bordered text-center">
                    <thead>
                        <tr>

                            <th>@lang('dashboard.receive_address')</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                
                        <tr>
                            <td class="text-truncate">{{$transaction->crypto_address}}</td>
                        </tr>
                        
                    </tbody>

                </table>

            </div>

            <div class="table-responsive">
                <table class="table table-striped table-bordered text-center">
                    <thead>
                        <tr>
                            <th>@lang('dashboard.transaction_store_order_number')</th>
                            <th>@lang('dashboard.transaction_store_buyer_name')</th>
                            <th>@lang('dashboard.transaction_store_buyer_email')</th>
                            
                            
                        </tr>
                    </thead>
                    <tbody>
                     
                            <tr>
                                <td># {{$transaction->store_order_id}}</td>
                                <td>{{$transaction->store_buyer_name}}</td>
                                <td>{{$transaction->store_buyer_email}}</td>
                            </tr>
                        
                    </tbody>
                  


                </table>
            </div>


            <div class="table-responsive mt-2">
                <table class="table table-striped table-bordered text-center">
                    <thead>
                        <tr>
                            <th>@lang('dashboard.transaction_store_order_price')</th>
                            <th>@lang('dashboard.transaction_crypto_market_price')</th>

                            
                        </tr>
                    </thead>
                    <tbody>
                     
                            <tr>
                                <td>${{$transaction->store_order_price}}</td>
                                <td>${{$transaction->crypto_market_price}}</td>
                            </tr>
                        
                    </tbody>

                </table>

            </div>


            <div class="table-responsive mt-2">
                <table class="table table-striped table-bordered text-center">
                    <thead>
                        <tr>
                            <th>@lang('dashboard.transaction_expected_crypto')</th>
                            <th>@lang('dashboard.transaction_received_crypto')</th>
                            <th>@lang('dashboard.transaction_percent_crypto')</th>
                        </tr>

                    </thead>

                    <tbody>
                     
                            <tr>
                                <td>{{$transaction->crypto_expected}}</td>
                                <td>{{$transaction->crypto_received}}</td>
                                <td>{{ number_format($transaction->crypto_percent, 4)}} %</td>
                            </tr>
                        
                    </tbody>

                </table>

            </div>

        </div>
      </div>

      
      <div class="card mx-auto text-center font-weight-bold mt-4" style="max-width: 50rem;">
        <div class="card-header">
            @lang('dashboard.status')
        </div>
        <div class="card-body">

            <div class="row">
                <div class="col">

                @if ( $transaction->status == 0)
                    <h4><span style="color:orange">@lang('dashboard.transaction_status_pending')</span></h4>
                @elseif ( $transaction->status == 1 )
                    <h4><span style="color:green">@lang('dashboard.transaction_status_found')</span></h4>
                @elseif ( $transaction->status == 2 )
                    <h4><span style="color:red">@lang('dashboard.transaction_status_missing')</span></h4>
                @elseif ( $transaction->status == 3 )
                    <h4><span style="color:blue">@lang('dashboard.transaction_status_overpaid')</span></h4>
                @elseif ( $transaction->status == 4 )
                    <h4><span style="color:red">@lang('dashboard.transaction_status_underpaid')</span></h4>
                @else
                    <h4><span style="color:black">@lang('dashboard.transaction_status_unknown')</span></h4>
                @endif
                 
                </div>
                <div class="col">

                    @if ( $transaction->transmitted )
                        <h4><span style="color:green">@lang('dashboard.transaction_status_transmitted')</span></h4>
                    @else
                        <h4><span style="color:red">@lang('dashboard.transaction_status_not_transmitted')</span></h4>
                    @endif 


                </div>

              </div>
          

        </div>
    </div>

</div>

@endsection



