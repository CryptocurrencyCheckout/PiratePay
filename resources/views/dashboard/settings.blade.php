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
                        {{Form::label('platform', __('dashboard.settings_select_platform'))}}
                        {{Form::select('platform', ['api' => 'Status API', 'woocommerce' => 'WooCommerce', 'whmcs' => 'WHMCS'], isset($settings->platform) ? $settings->platform : null, ['class' => 'form-control', 'placeholder' => __('dashboard.settings_platform')]) }}
                    </div>


                    <div class="form-group">
                        {{Form::label('key', __('dashboard.settings_callback_key'))}}
                        {{Form::password('key', array('placeholder'=> __('dashboard.settings_key'), 'class'=>'form-control' ) ) }}
                    </div>

                    @isset($settings->key)
                        <div class="py-2">
                            <hr>
                        </div>
                    @else
                        <div class="form-group">
                            <b>{{__('dashboard.settings_suggested_key')}} </b>{{ Str::random(30) }}
                        </div>
                        <hr>
                    @endisset


                    <div class="form-group">
                        {{Form::label('link', __('dashboard.settings_platform_link'))}}
                        {{Form::text('link', isset($settings->link) ? $settings->link : null, ['class' => 'form-control', 'placeholder' => __('dashboard.settings_link')])}}
                    </div>

                    <div class="form-group">
                        {{Form::label('client', __('dashboard.settings_platform_client'))}}
                        {{Form::text('client', isset($settings->client) ? $settings->client : null, ['class' => 'form-control', 'placeholder' => __('dashboard.settings_client')])}}
                    </div>

                    <div class="form-group">                     
                        {{Form::label('secret', __('dashboard.settings_platform_secret'))}}
                        {{Form::password('secret', array('placeholder'=> __('dashboard.settings_secret'), 'class'=>'form-control' ) ) }}
                    </div>

                    <div class="py-2">
                        <hr>
                    </div>

                {{ csrf_field() }}
                
                <a href="/dashboard" class="btn btn-danger">{{__('dashboard.cancel')}}</a>
                {{Form::submit(__('dashboard.submit'),['class'=>'btn btn-primary float-right'])}}

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
                        <p>{{__('dashboard.settings_piratepay_url')}}</p>
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
                        <p>{{__('dashboard.settings_piratepay_key')}}</p>
                    </div>
                    <div class="col">
                        <p id="StoreID"><a href='{!! url('/dashboard/api_token'); !!}'>{{__('dashboard.settings_piratepay_generate')}}</a></p>
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
