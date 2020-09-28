<nav class="navbar navbar-expand-md navbar-dark bg-dark shadow-sm">
    <div class="container">

        

        <a class="navbar-brand" href="{{ url('/') }}">
            {{ config('app.name', 'PiratePay') }}
        </a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">

            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav ml-auto">

                
                <li class="nav-item">
                    <a class="nav-link" href="/dashboard">@lang('dashboard.navbar_transactions')</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/dashboard/api_token">@lang('dashboard.navbar_apikeys')</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/dashboard/logs">@lang('dashboard.navbar_logs')</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/dashboard/settings">@lang('dashboard.navbar_settings')</a>
                </li>

            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                
                @guest
                
                @else
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        @lang('dashboard.navbar_logout')
                    </a>
                    
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </li>
                @endguest

            </ul>

        </div>
    </div>
</nav>