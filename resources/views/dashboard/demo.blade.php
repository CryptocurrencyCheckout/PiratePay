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

                {!! Form::open(['action' => 'DemoController@testTransaction', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}

                    <div class="form-group">
                        {{Form::label('api_key', 'PiratePay API Key')}}
                        {{Form::text('api_key', '', ['class' => 'form-control', 'placeholder' => 'This is an API Key Generated in the API Keys tab on the PiratePay Dashboard.'])}}
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
