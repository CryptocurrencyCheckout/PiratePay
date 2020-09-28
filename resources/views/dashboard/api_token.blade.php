@extends('layouts.dashboard') 

@section('content')

<!-- Main Card Body-->
<div class="container">
          
    <!--Card Body Content-->
    <div class="card">
        <div class="card-header">
            @lang('dashboard.your_api_keys')
        </div>
        <div class="card-body">

            <div class="container">

                    <passport-personal-access-tokens></passport-personal-access-tokens>

            </div>
            
        </div>
    </div>
    <!--End Card Body Content-->
 
</div>
<!-- End Main Card Body-->

@endsection