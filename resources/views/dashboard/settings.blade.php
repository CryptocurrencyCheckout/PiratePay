@extends('layouts.dashboard') 

@section('content')

<!-- Main Card Body-->
<div class="container">
          
    <!--Card Body Content-->
    <div class="card">
        <div class="card-header">
            @lang('dashboard.your_settings')
        </div>
        <div class="card-body">

            <div class="container">

                @include('inc.messages')

                {!! Form::open(['action' => 'SettingController@update', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}

                    <div class="form-group">
                        {{Form::label('platform', 'Select Platform:')}}
                        {{Form::select('platform', ['woocommerce' => 'WooCommerce'], null, ['class' => 'form-control', 'placeholder' => 'Choose Your Platform.']) }}
                    </div>

                    <div class="form-group">
                        {{Form::label('link', 'Store API Link:')}}
                        {{Form::text('link', '', ['class' => 'form-control', 'placeholder' => 'The link to access the stores API.'])}}
                    </div>

                    <div class="form-group">
                        {{Form::label('client', 'Platform Client Key:')}}
                        {{Form::text('client', '', ['class' => 'form-control', 'placeholder' => 'The Client Key to Access the Platform API.'])}}
                    </div>

                    <div class="form-group">                     
                        {{Form::label('secret', 'Platform Client Secret:')}}
                        {{Form::text('secret', '', ['class' => 'form-control', 'placeholder' => 'The Secret Key to Access the Platform API.'])}}
                    </div>

                {{ csrf_field() }}
                
                <a href="/dashboard" class="btn btn-danger">Cancel</a>
                {{Form::submit('Submit',['class'=>'btn btn-primary float-right'])}}

                {!! Form::close() !!}

                

            </div>
            
        </div>
    </div>
    <!--End Card Body Content-->

        <!--Card Body Content-->
        <div class="card mt-4">
            <div class="card-header">
                @lang('dashboard.your_plugin_settings')
            </div>
            <div class="card-body">

                <div class="row">
                    <div class="col">
                        <p class="font-weight-bold">PiratePay API URL:</p>
                    </div>
                    <div class="col">
                        <p id="StoreID">{!! url('/api/v1'); !!}</p>
                    </div>
                    <div class="col">
                        {{-- <button class="btn float-right btn-outline-primary" data-clipboard-target="#StoreID" type="button"><i class="fa fa-copy"></i> Copy Details</button> --}}
                    </div>
                </div>

                <hr>

                <div class="row">
                    <div class="col">
                        <p class="font-weight-bold">PiratePay API Key:</p>
                    </div>
                    <div class="col">
                        <p id="StoreID"><a href='{!! url('/dashboard/api_token'); !!}'>Generate API Key Here...</a></p>
                    </div>
                    <div class="col">
                        
                    </div>
                </div>

                <hr>
                
            </div>
        </div>
        <!--End Card Body Content-->
 
</div>
<!-- End Main Card Body-->

@endsection
