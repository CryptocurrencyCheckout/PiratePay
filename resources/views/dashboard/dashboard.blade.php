@extends('layouts.dashboard')

@section('content')
<div class="container-fluid">

        <div class="container">
                @include('inc.messages')
        </div>

        <ul class="list-group">
                
                <li class="list-group-item active font-weight-bold">@lang('dashboard.your_transactions')</li>


                        @if(count($transactions) > 0)
                                @foreach($transactions as $transaction)

                                <li class="list-group-item">
                                        <div class="container-fluid">
                                                <div class="row">

                                                        <div class="col-12 col-xl-1">
                                                                <b>@lang('dashboard.transaction')</b><br>
                                                                <a href="/dashboard/transaction/{{$transaction->id}}">#{{$transaction->id}}</a>
                                                        </div>

                                                        <div class=" col-12 col-xl-1">
                                                                <b>@lang('dashboard.store_order_id')</b><br>
                                                                # {{$transaction->store_order_id}}
                                                        </div>

                                                        <div class="col-12 col-xl-1">
                                                                <b>@lang('dashboard.store_order_price')</b><br>
                                                                $ {{$transaction->store_order_price}}
                                                        </div>

                                                        <div class="col-12 col-xl-5 text-truncate">
                                                                <b>@lang('dashboard.receive_address')</b><br>
                                                                {{$transaction->crypto_address}}
                                                        </div>

                                                        <div class="col-12 col-xl-1">
                                                                <b>@lang('dashboard.crypto_amount')</b><br>
                                                                {{$transaction->crypto_price}}
                                                        </div>

                                                        <div class="col-12 col-xl-1">
                                                                <b>@lang('dashboard.crypto_received')</b><br>
                                                                {{$transaction->crypto_received}}
                                                        </div>

                                                        <div class="col-12 col-xl-1">
                                                                <b>@lang('dashboard.status')</b><br>

                                                                @if ( $transaction->status == 0)
                                                                        <span style="color:orange">@lang('dashboard.status_pending')</span>
                                                                @elseif ( $transaction->status == 1 )
                                                                        <span style="color:green">@lang('dashboard.status_found')</span>
                                                                @elseif ( $transaction->status == 2 )
                                                                        <span style="color:red">@lang('dashboard.status_missing')</span>
                                                                @elseif ( $transaction->status == 3 )
                                                                        <span style="color:blue">@lang('dashboard.status_overpaid')</span>
                                                                @elseif ( $transaction->status == 4 )
                                                                        <span style="color:red">@lang('dashboard.status_underpaid')</span>
                                                                @else
                                                                        <span style="color:black">@lang('dashboard.status_unknown')</span>
                                                                @endif
                                                        </div>

                                                        <div class="col-12 col-xl-1">
                                                                <b>@lang('dashboard.transmitted')</b><br>

                                                                @if ( $transaction->transmitted )
                                                                <span style="color:green">@lang('dashboard.transmitted_yes')</span>
                                                                @else
                                                                <span style="color:red">@lang('dashboard.transmitted_no')</span>
                                                                @endif 
                                                        </div>
        
                                                </div>
                                        </div>
                                </li>
                                
                                @endforeach 

                                {{ $transactions->links() }}

                        @else
                                <li class="list-group-item">
                                        <div class="container-fluid">
                                        <div class="row">
                                                <div class="col">
                                                        <b>@lang('dashboard.transaction_not_found')</b>
                                                        <br> @lang('dashboard.transaction_not_found_message')
                                                </div>
                                        </div>
                                        </div>
                                </li>
                        @endif
                </li>
        </ul> 

</div>

@endsection



