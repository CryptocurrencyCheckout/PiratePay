@extends('layouts.dashboard')

@section('content')
<div class="container-fluid">

        <div class="container">
                @include('inc.messages')
        </div>

        <div class="container my-4">
            <a href="{{ action('WalletController@testTransaction') }}" class="btn btn-primary btn-block font-weight-bold">@lang('dashboard.wallet_test_button')</a>
        </div>

        <div class="card">


            <div class="card-header"> 
    
                <span><strong>@lang('dashboard.wallet_header')</strong></span>
                
            </div>
    
            <div class="card-body">

                <div class="card text-center mx-auto mb-2 shadow" style="max-width: 60rem;">
                    <div class="card-body">

                        <h5 class="card-title">@lang('dashboard.wallet_status_header')</h5>

                        @isset ($wallet['blocks'])

                            @isset ($explorer['info']['blocks'])

                                @if ($wallet['blocks'] >= ($explorer['info']['blocks'] - 5) && $wallet['blocks'] <= ($explorer['info']['blocks'] + 5))
                                    <span style="color:green">@lang('dashboard.wallet_blockheight_match')</span>
                                @else
                                    <span style="color:red">@lang('dashboard.wallet_blockheight_mismatch')</span>
                                @endif

                            @else
                                <span style="color:red">@lang('dashboard.explorer_blockheight_noresponse')</span>
                            @endisset

                        @else
                            <span style="color:red">@lang('dashboard.wallet_blockheight_noresponse')</span>
                        @endisset

                    </div>
                </div>

                <div class="table my-3 shadow">
                    <table class="table table-bordered text-center">
                        <thead>
                            <tr>
                                <th>@lang('dashboard.wallet_version_header')</th>
                            </tr>
                        </thead>
                        <tbody>
                    
                            <tr>
                                <td>

                                <div class="row">
                                    <div class="col-sm">
                                        <b>@lang('dashboard.wallet_version_name')</b>
                                        
                                        <br>

                                        @isset($wallet['name'])
                                            {{ $wallet['name'] }}
                                        @else
                                            <span style="color:red">@lang('dashboard.error')</span>
                                        @endisset

                                    </div>
                                    <div class="col-sm">
                                        <b>@lang('dashboard.wallet_version_kmd')</b>
                                        
                                        <br>

                                        @isset($wallet['KMDversion'])
                                            {{ $wallet['KMDversion'] }}
                                        @else
                                            <span style="color:red">@lang('dashboard.error')</span>
                                        @endisset

                                    </div>
                                    <div class="col-sm">
                                        <b>@lang('dashboard.wallet_version_wallet')</b>
                                        
                                        <br> 

                                        @isset($wallet['version'])
                                            {{ $wallet['version'] }}
                                        @else
                                            <span style="color:red">@lang('dashboard.error')</span>
                                        @endisset

                                    </div>
                                </div>

                                </td>
                            </tr>

                            
                        </tbody>
    
                    </table>
    
                </div>
    
                <div class="table my-3 shadow">
                    <table class="table table-bordered text-center">
                        <thead>
                            <tr>
                                <th>@lang('dashboard.wallet_blockheight_header')</th>
                            </tr>
                        </thead>
                        <tbody>
                    
                            <tr>
                                <td>

                                <div class="row">
                                    <div class="col-sm">
                                        <b>@lang('dashboard.wallet_blockheight_found')</b>

                                        <br>

                                        @isset($wallet['longestchain'])
                                            {{ $wallet['longestchain'] }}
                                        @else
                                            <span style="color:red">@lang('dashboard.error')</span>
                                        @endisset

                                    </div>
                                    <div class="col-sm">
                                        <b>@lang('dashboard.wallet_blockheight_current')</b>

                                        <br>

                                        @isset($wallet['blocks'])
                                            {{ $wallet['blocks'] }}
                                        @else
                                            <span style="color:red">@lang('dashboard.error')</span>
                                        @endisset

                                    </div>
                                    <div class="col-sm">
                                        <b>@lang('dashboard.wallet_blockheight_explorer')</b>

                                        <br>

                                        @isset($explorer['info']['blocks'])
                                            {{ $explorer['info']['blocks'] }}
                                        @else
                                            <span style="color:red">@lang('dashboard.error')</span>
                                        @endisset

                                    </div>
                                </div>

                                </td>
                            </tr>

                            
                        </tbody>
    
                    </table>
    
                </div>

                <div class="table my-3 shadow">
                    <table class="table table-bordered text-center">
                        <thead>
                            <tr>
                                <th>@lang('dashboard.wallet_balance_header')</th>
                            </tr>
                        </thead>
                        <tbody>
                    
                            <tr>
                                <td>

                                <div class="row">
                                    <div class="col-sm">
                                        <b>@lang('dashboard.wallet_balance_transparent')</b>
                                        
                                        <br>

                                        @isset($balance['transparent'])
                                            {{ $balance['transparent'] }}
                                        @else
                                            <span style="color:red">@lang('dashboard.error')</span>
                                        @endisset

                                    </div>
                                    <div class="col-sm">
                                        <b>@lang('dashboard.wallet_balance_private')</b>
                                        
                                        <br>

                                        @isset($balance['private'])
                                            {{ $balance['private'] }}
                                        @else
                                            <span style="color:red">@lang('dashboard.error')</span>
                                        @endisset

                                    </div>
                                    <div class="col-sm">
                                        <b>@lang('dashboard.wallet_balance_total')</b>
                                        
                                        <br>

                                        @isset($balance['total'])
                                            {{ $balance['total'] }}
                                        @else
                                            <span style="color:red">@lang('dashboard.error')</span>
                                        @endisset

                                    </div>

                                </div>

                                </td>
                            </tr>

                            
                        </tbody>
    
                    </table>
    
                </div>
            </div>
        </div>

</div>

@endsection



