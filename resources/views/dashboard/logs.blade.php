@extends('layouts.dashboard')

@section('content')
<div class="container-fluid">

        <ul class="list-group">
                
                <li class="list-group-item active font-weight-bold">Your Error Logs:</li>

                        @if(count($errors) > 0)
                                @foreach($errors as $error)

                                <li class="list-group-item">
                                        <div class="container-fluid">
                                                <div class="row">

                                                        <div class="col-1">
                                                                <b>ID:</b><br>
                                                                {{$error->id}}
                                                        </div>

                                                        <div class="col-1">
                                                                <b>Error Code:</b><br>
                                                                {{$error->code}}
                                                        </div>

                                                        <div class="col-8">
                                                                <b>Error Message:</b><br>
                                                                {{$error->error}}
                                                        </div>

                                                        <div class="col-2">
                                                                <b>Time:</b><br>
                                                                {{$error->created_at}}
                                                        </div>

                                                </div>
                                        </div>
                                </li>
                                

                                @endforeach 
                        @else
                                <li class="list-group-item">
                                        <div class="container-fluid">
                                        <div class="row">
                                                <div class="col">
                                                        <b>No Errors Found!</b>
                                                        <br> This is where most your error logs will display.
                                                </div>
                                        </div>
                                        </div>
                                </li>
                        @endif
                </li>
        </ul>

        {{ $errors->links() }}

</div>

@endsection



