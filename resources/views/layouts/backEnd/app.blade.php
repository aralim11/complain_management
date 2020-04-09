<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="content-type" content="text/html; charset=UTF-8" /> 

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
    

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    {{-- <script src="http://maps.google.com/maps/api/js?sensor=false" type="text/javascript"></script> --}}
    {{-- <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBQBZeKqFIUh5wXufyveLTNEasmQUUHTWg&callback=initMap" type="text/javascript"></script> --}}
    
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="@if(Request::is('admin*')) {{ route('admin.dashboard') }} @elseif(Request::is('user*')){{ route('user.dashboard') }} @elseif (Request::is('supervisor*')){{ route('supervisor.dashboard') }} @elseif (Request::is('client*')){{ route('client.dashboard') }} @endif">
                    {{ 'AppFunBD' }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            @if(Request::is('admin*'))
                            <li class="nav-item">
                                <a class="nav-link {{ Request::is('admin/updateticket') ? 'active' : '' }}" href="{{ route('admin.updateticket.index') }}">{{ __('Update Ticket') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ Request::is('admin/user') ? 'active' : '' }}" href="{{ route('admin.user.index') }}">{{ __('User') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ Request::is('admin/group') ? 'active' : '' }}" href="{{ route('admin.group.index') }}">{{ __('Department') }}</a>
                            </li>
                            @endif

                            @if(Request::is('supervisor*'))
                                <li class="nav-item">
                                    <a class="nav-link {{ Request::is('supervisor/updateticket') ? 'active' : '' }}" href="{{ route('supervisor.updateticket.index') }}">{{ __('Update Ticket') }}</a>
                                </li>
                            @endif

                            @if(Request::is('user*'))
                                <li class="nav-item">
                                    <a class="nav-link {{ Request::is('user/updateticket') ? 'active' : '' }}" href="{{ route('user.updateticket.index') }}">{{ __('Update Ticket') }}</a>
                                </li>
                            @endif

                            @if(Request::is('client*'))
                                <li class="nav-item">
                                    <a class="nav-link {{ Request::is('client/ticketcreate') ? 'active' : '' }}" href="{{ route('client.ticketcreate.index') }}">{{ __('New Ticket') }}</a>
                                </li>
                            @endif


                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    
                                    <a href="@if(Request::is('admin*')) {{ route('admin.profile.edit', Auth::id()) }} @elseif(Request::is('user*')) {{ route('user.profile.edit', Auth::id()) }} @elseif (Request::is('supervisor*')) {{ route('supervisor.profile.edit', Auth::id()) }} @elseif (Request::is('client*')) {{ route('client.profile.edit', Auth::id()) }} @endif" class="dropdown-item"> {{ __('Profile') }} </a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        @yield('content')
                    </div>
                </div>
            </div>
        </main>
    </div>

    @stack('js')

</body>
</html>


