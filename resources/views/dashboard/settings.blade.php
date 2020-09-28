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
 
</div>
<!-- End Main Card Body-->

@endsection