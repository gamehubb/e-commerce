<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @notifyCss
    @include('notify::messages')
    @notifyJs
</head>
<body style="background:black;">
    <div id="app">
        <header class="header-box">
            <div class="container">
                <div class="col-md-12 col-sm-12 col-xs-12 text-left site-icon">
                    <h1>
                        <a href="/"> 
                        <span class="firstletter">Gamehub</span> <sub class="secondletter">Myanmar</sub>
                        </a>
                    </h1>
                </div>
            </div>
        </header>

        <nav class="navbar navbar-dark navbar-expand-md shadow-sm text-black" style="background-color:black;">
            <div class="container">
                
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                        <li class="nav-item">
                            <a class="nav-link text-white dropdown-toggle">Category</a>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link text-white dropdown-toggle">Brand</a>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link text-white dropdown-toggle">More</a>
                        </li>

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            {{-- <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a> 

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    @if(Auth::check())
                                    <a class="dropdown-item" href="{{route('order')}}">My Orders</a>
                                    @endif
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>  
                            </li> --}}
                            <li class="nav-item">
                                <div class="container">
                                    <div class="input-group col-sm-7">
                                        <div class="input-group-append">
                                        </div> 
                                        <input type="text" class="form-control"  >
                                     
                                            <span class="input-group-text microphone bg-white" >
                                                <i class="fa fa-search fa-2x"></i>
                                            </span>  
                                    </div>
                                </div>
                            </li>
                            <li class="nav-item">
                                <i class="nav-item fa fa-gamepad text-white m-2"  style="font-size:20px;"></i>
                            </li>
                            <li class="nav-item">
                                <i class="nav-item fa fa-user text-white m-2" style="font-size:20px;"></i>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('cart.show')}}"  >
                                    <i class="fa fa-shopping-cart text-white  m-2" style="font-size:20px;">
                                      <sup>  ({{session()->has('cart')?session()->get('cart')->totalQty:'0'}})</sup>
                                    </i>
                                </a>
                            </li>
                            <li class="nav-item">
                                <i class="nav-item fa fa-game"></i>
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
</body>
</html>
