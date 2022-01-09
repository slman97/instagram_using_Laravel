<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" xmlns:livewire="">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>
    <link rel="icon" href="/svg/12.svg"/>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">

    <link href="https://fonts.googleapis.com/css2?family=Libre+Baskerville:ital@1&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <livewire:styles>
</head>
<body>
<div id="app">
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand d-flex" href="{{ url('/home') }}">
                <div><img src="/svg/dzone.svg" style="height: 20px ; border-right: 1px solid #333333" class="pr-2"></div>
                <div class="pl-3 pr-3">HTMA Pics</div>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <!-- Authentication Links -->
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @if (Route::has('register'))
                            <li class="nav-item ">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @endif
                    @else
                        <li class="pr-80 m-2">
                               <livewire:search-drop>
                        </li>

                        <div>

                        
                            <a class="navbar-brand d-flex" href="#" data-toggle="dropdown" aria-label="Open Menu">
                                <img src="{{Auth::user()->profile->ProfileImage() }}"
                                     class="w-100 rounded-circle" style="max-width: 50px">
                            </a>
                            <ul class="dropdown-menu settings-menu dropdown-menu-right ">

                                <li class="dropdown-item">
                                    <a class="text-dark" href="/profile/{{ Auth::user()->id }}">
                                        <img src="/svg/user.svg" class="pr-2">
                                        personal page
                                    </a>
                                   
                                </li>
                                <hr>
                                <li class="dropdown-item">
                                    <a class="text-dark" href="/messinger">
                                        <img src="/svg/icons8-new-message-64.png" style=" height:20px ; width: 36px;" class="pr-2">
                                        messinger
                                    </a>
                                    
                                </li>
                                  <hr>
                                @if (Auth::user()->usertype == 'admin')
                                    <li class="dropdown-item">
                                    <a class="text-dark" href="/dashboard" >

                                            <img src="/svg/inbox.svg" class="pr-2">
                                        dashboard
                                        </a>

                                    </li>
<hr>
                                @endif
                             @can('update',Auth::user()->profile)
                              <li class="dropdown-item">
                          <a href="/profile/{{Auth::user()->id}}/edit" class="text-dark">
                              <img src="/svg/sync.svg" >
                          Edit profile</a>
                                </li>
                         <hr>
                             @endcan
                                <li>

                                    <a  class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();">
                                       <img src="/svg/lnr-exit.svg" >
                                        Logout
                                    </a>

                                </li>
                            </ul>


                        </div>

                            <div>

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
        @yield('content')
    </main>
</div>
 <livewire:scripts>
</body>
</html>
