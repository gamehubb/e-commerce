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

        <nav class="navbar k navbar-expand-md shadow-sm  bg-dark">
            <div class="container">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
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
                            <a class="nav-link text-white" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @endif

                        @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{ route('register') }}">{{ __('Register') }}</a>
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
                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
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
                                    <input type="text" class="form-control">

                                    <span class="input-group-text microphone bg-white">
                                        <i class="fa fa-search fa-2x"></i>
                                    </span>
                                </div>
                            </div>
                        </li>
                        <li class="nav-item">
                            <i class="nav-item fa fa-gamepad text-white m-2" style="font-size:20px;"></i>
                        </li>
                        <li class="nav-item">
                            <i class="nav-item fa fa-user text-white m-2" style="font-size:20px;"></i>
                        </li>
                        <li class="nav-item" onclick="openModel()" style="cursor:pointer">
                            {{-- <a href="{{route('cart.show')}}" > --}}
                            <!-- <a href="{{route('cart.checkout' , 2)}}"> -->
                            <i class="fa fa-shopping-cart text-white  m-2" style="font-size:20px;">
                                <sup> ({{session()->has('cart')?session()->get('cart')->totalQty:'0'}})</sup>

                            </i>
                            <!-- </a> -->
                        </li>
                        <li class="nav-item">
                            <i class="nav-item fa fa-game"></i>
                        </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        <!-- Modal HTML -->
        <div id="myModal" class="modal fade text-white" tabindex="-1">
            <div class="modal-dialog bg-dark"
                style="width: 20%;height: 100%;position: absolute;right: 0;margin: 0rem;height: 100vh;">
                <div class="modal-content bg-dark ">
                    <div class=" p-1" style="background-color: #aa0000;">
                        <p class="text-center h3">Gamehub Myanmar</p>
                        <button type="button" class="close" data-dismiss="modal"
                            style="position: absolute; top:5px; right:10px;">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <p class="col-md-8 h4"><b>YOUR CART</b></p>
                            <p class="col-md-4  h4"> ({{session()->has('cart')?session()->get('cart')->totalQty:'0'}}
                                items) </p>
                            <p>
                                @foreach( session()->get('cart') as $drug => $d)



                                @endforeach


                            </p>

                        </div>
                        <hr class="mx-auto" style="width:95%; color: #aa0000; height: 3px; ">
                    </div>
                    <hr class="mx-auto" style="width:100%; color: #ffffff; height: 2px; ">
                    <div class="row m-3">

                        <p class="col-md-6"><b>Total Price:</b></p>
                        <p class="col-md-6"> <b>MMKs 6000</b> </p>
                    </div>
                    <div class="text-center m-3">
                        <a href="{{route('cart.checkout' , 2)}}">
                            <button type="button" class="btn btn-sm mx-auto mt-3 text-white"
                                style="border-radius : 20px; width:40%; background-color : #aa0000;">Check out</button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <main class="py-4">
            @yield('content')
        </main>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"
        integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
    function openModel() {
        $("#myModal").modal('show');
    }
    </script>
</body>

</html>