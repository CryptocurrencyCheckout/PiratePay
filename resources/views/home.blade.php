@extends('layouts.app')

@section('content')
<div class="container">

    @include('inc.messages')

            <div class="container justify-content-center text-center d-flex align-items-center vh-100">

                <div class="row">
                    <div class="col">
                        
                        <div class="row">
                            <img class="img-fluid" src="/img/PiratePayShipLogo.png" alt="PiratePay" />
                        </div>
                        <div class="row h3 pt-3">
                            
                            <div class="col">
                                <button type="button" class="btn btn-dark btn-lg">Pirate</button>
                                {{-- <a href="https://pirate.black/">Pirate</a> --}}
                            </div>
                            <div class="col">
                                <button type="button" class="btn btn-dark btn-lg">Guides</button>
                                {{-- <a href="https://laravel.com/docs">Guide</a> --}}
                            </div>

                            <div class="col">
                                <button type="button" class="btn btn-dark btn-lg">Github</button>
                                {{-- <a href="https://laravel.com/docs">Github</a> --}}
                            </div>
                        </div>
                                    
                    </div>
                </div>


            </div>
                















            {{-- <div class="container text-center d-flex h-100">
                <img class="img-fluid" src="/img/Pirate_Logo.png" alt="" />
                
                <div class="container pt-4 h4 justify-content-center align-self-center">

                    <div class="container pt-4 h4">
                        <div class="row">
                            <div class="col-sm">
                                <a href="https://laravel.com/docs">Pirate</a>
                            </div>
                            <div class="col-sm">
                                <a href="https://laravel.com/docs">Guides</a>
                            </div>
                            <div class="col-sm">
                                <a href="https://github.com/laravel/laravel">GitHub</a>
                            </div>
                        </div>
                    </div>

                </div>



            </div> --}}


            {{-- <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    {{ __('You are logged in!') }}
                </div>
            </div> --}}

            {{-- <div class="container">
                <div class="row">
                    <div class="col-sm">
                        <a href="https://laravel.com/docs">Docs</a>
                    </div>
                    <div class="col-sm">
                    One of three columns
                    </div>
                    <div class="col-sm">
                        <a href="https://github.com/laravel/laravel">GitHub</a>
                    </div>
                </div>
            </div> --}}
{{-- 
            <div class="links">
                <a href="https://laravel.com/docs">Docs</a>
                <a href="https://laracasts.com">Laracasts</a>
                <a href="https://laravel-news.com">News</a>
                <a href="https://blog.laravel.com">Blog</a>
                <a href="https://nova.laravel.com">Nova</a>
                <a href="https://forge.laravel.com">Forge</a>
                <a href="https://vapor.laravel.com">Vapor</a>
                <a href="https://github.com/laravel/laravel">GitHub</a>
            </div> --}}




</div>
@endsection
