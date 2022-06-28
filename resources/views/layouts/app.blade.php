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

    <link rel="icon" href="https://gamehubmyanmar.com/gm-icon.png" type="image/x-icon" />

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    @notifyCss
    @include('notify::messages')
    @notifyJs
   
</head>

<style>
    #plus{
        background: #aa0000;
        border: 1px solid #000;
        border-radius: 1rem;
        cursor: pointer;
    }

    #minus{
        background: #aa0000;
        border: 1px solid #000;
        border-radius: 1rem;
        cursor: pointer;
    }

    #plus:active{
        background: #000;
    }
    #minus:active{
        background: #000;
    }

    #trash{

        border-radius: 5px;
        border: 1px solid black;
        margin: auto;
        padding: 4px;
        position: relative;
        top: 5px;
        left: 1px;

    }

    #trash:hover{
        background-color: #aa00aa;
    }
</style>

<div id="preloader">
    <div id="loader"></div>
</div>

<body style="background:black;">
           
    <div id="app">
        <header class="header-box">
            <div class="container">
                <div class="col-md-12 text-left site-icon m-3">              
                        <a href="/" style="color: #aa0000;">
                            <span class="firstletter h1">Gamehub</span> <sub class="secondletter h2">Myanmar<sub style="font-size:9px;">Shop</sub></sub>
                        </a>
                   
                </div>
            </div>
        </header>

        <nav class="navbar k navbar-expand-md shadow-sm  bg-dark">
            <div class="container">
                <button class="navbar-toggler text-white" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <i class="fa fa-bars  "></i>
                    {{-- <span class="navbar-toggler-icon  text-white"></span> --}}
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item dropdown">   
                                <a class="nav-link dropdown-toggle text-white"  onclick="this.classList.toggle('open')" style="cursor:pointer;" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    Category
                                </a>       
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">    
                                @foreach ($allCategory as $cat)                     
                                    <a class="dropdown-item" href="{{ route('productCategory',[$cat->slug]) }}">{{$cat->name}}</a>      
                                @endforeach              
                            </div>
                        </li>

                        <li class="nav-item dropdown">
                            <a  class="nav-link dropdown-toggle text-white"  onclick="this.classList.toggle('open')" style="cursor:pointer;" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                Brand
                            </a>      
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown"> 
                                 @foreach ($allBrand as $brand)                                
                                <a class="dropdown-item" href="{{ route('productBrand',[$brand->slug]) }}">{{$brand->name}}</a>
                                @endforeach               
                        </div>
                        </li>

                        {{-- <li class="nav-item dropdown">
                            <a class="nav-link text-white dropdown-toggle">More</a>
                        </li> --}}

                    </ul>

                    <!-- Right Side Of Navbar -->
                   
                </div>
                <ul class="navbar-nav" style="float:left;flex-direction:row-reverse !important;">
                    <!-- Authentication Links -->

                    @guest
                        @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>&nbsp;&nbsp;&nbsp;
                        @endif

                        @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                        @endif

                        
                        
                    @else

                   
              
                    <li class="nav-item dropdown">
                        <i class="nav-item fa fa-user text-white m-2"  onclick="this.classList.toggle('open')" style="font-size:20px;cursor:pointer;" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre></i>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown" style="position: absolute !important;">
                            @if(Auth::check())
                                <a class="dropdown-item" href="{{route('user.accountInfo')}}">My Account</a>
                                <a class="dropdown-item" href="{{route('order')}}">My Orders</a>
                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                            @endif

                        </div>
                    </li>
                        <?php 
                        if(Auth::user()){
                        $route = 'checkout/'.Auth::getUser()->name;
                        }else{
                        $route = '';
                        }
                        ?>
                      
                        @if(str_replace('%20',' ',Request::path()) == $route)
                            <li class="nav-item" style="cursor:pointer">
                                @if(session()->has('cart'))
                                <a href="{{route('cart.checkout', Auth::getUser()->name)}}" class="text-white">

                                    <i class="fa fa-shopping-cart text-whit m-2" style="font-size: 20px;">
                                        <sup id="cartcount" style="background: #AA2B25;
                                        border-radius: 77px;
                                        border: 4px solid #AA2B25;"> {{ session()->has('cart') ? session()->get('cart')->totalQty : '0' }}</sup>
                                    </i>
                                </a>
                                @else
                                    <i class="fas fa-shopping-cart text-white m-2" style="font-size:20px;">
                                    </i>
                                @endif
                                

                            </li>
                        @else

                            <li class="nav-item" onclick="openModel()" style="cursor:pointer">
                                @if(session()->has('cart'))
                                    <i class="fas fa-shopping-cart text-white  m-2" style="font-size:20px;">
                                        <sup id="cartcount" style="background: #AA2B25;
                                        border-radius: 77px;
                                        border: 4px solid #AA2B25;"> {{ session()->has('cart') ? session()->get('cart')->totalQty : '0' }}</sup>
                                    </i>
                                @else
                                    <i class="fas fa-shopping-cart text-white m-2" style="font-size:20px;">
                                    </i>
                                @endif

                                <!-- </a> -->
                            </li>

                        @endif
                    @endguest
                    &nbsp;&nbsp;&nbsp;
                    <li class="nav-item">
                        <a class="nav-item" href="https://gamehubmyanmar.com">
                            <i class=" fa fa-gamepad text-white mt-2" style="font-size:20px;"></i>
                        </a>  
                    </li>
                    &nbsp;&nbsp;&nbsp;

                    <li class="nav-item">
                       
                        <form action="{{  route('search') }}" method="get" id= "searchForm" >
                            @csrf
                        <div class="inner-addon left-addon">
                            <i class="fa fa-search " style="position: absolute;padding: 10px;cursor:pointer;"  onclick="search()" ></i>
                            <input type="text" name="name" id="p_name" class="form-control" style="padding-left:30px" placeholder="Search here..." required/>
                        </div>
                        </form>
                    </li>
                    <li class="nav-item">
                        <i class="nav-item fa fa-game"></i>
                    </li>
                </ul>
            </div>
        </nav>
        <!-- Modal HTML -->
        @auth
        @if(str_replace('%20',' ',Request::path()) != $route)
            <div id="myModal" class="modal fade text-white" tabindex="-1">
                <div class="modal-dialog bg-dark"
                    style="width: 60%;height: 100%;position: absolute;right: 0;margin: 0rem;height: 100vh;">
                    <div class="content" style="display: none;" id="cart-loader">
                        <div class="loading">
                            <h3>Updating</h3>
                                <span style="color:#AA2B25;"></span>
                        </div>
                    </div>
                    <div class="modal-content bg-dark"  id="cartModel">
                            <div class="p-1" style="background-color: #aa0000;">
                                <p class="text-center h3">Gamehub Myanmar</p>&nbsp;&nbsp;&nbsp;&nbsp;
                                <button type="button" class="close" data-dismiss="modal"
                                    style="position: absolute; top:3px; right:10px;font-size:22px;" onclick="closeModel()">&times;</button>
                            </div>
                            <div class="modal-body" id="cartData">
                                
                                    <div class="row">
                                        <p class="col-md-8 h4"><b>YOUR CART</b></p>
                                    </div>
                            
                                    @if(session()->has('cart'))
                                    <hr class="mx-auto mb-3" style="width:95%; color: #ec0606; height: 3px; ">

                                        @foreach(session()->get('cart')->items as $key => $value)
                                            <div class="m-1 p-1 mb-2 row" style=" border: 1px solid #3e3c3c;">
                                                <div class="col-md-4 col-xs-4">
                                                        <img src="{{Storage::url($value['image'])}}" style="width:100%;  height:100%;">
                                                </div>
                                                <div class="col-md-8 col-xs-8">
                                                    <p>{{$value['name']}} </p>
                                                    <p><b>MMKS <span id="price_{{$value['id']}}" data-price="{{$value['price']}}">{{number_format($value['price'])}}</span></b></p>
                                                    <div class="row mt-5">
                                                        <i class="fa fa-minus m-1 w-10" id="minus" onclick="updateCart(this)" data-id="{{$value['id']}}"
                                                        ></i>
                                                        <p class="col-lg-1 w-10" id="qty_{{$value['id']}}">{{$value['qty']}}</p>
                                                        <i id="product_id" hidden>{{$value['id']}}</i>
                                                        <i class="fa fa-plus m-1 w-10" id="plus" onclick="updateCart(this)" data-id="{{$value['id']}}"
                                                        ></i> 
                                                        <span class="ml-4 bg-red text-right" style="cursor:pointer;"><i class="fas fa-trash fa-1x" id="trash" onclick="removeCart(this)" data-id="{{$value['id']}}"></i></span>
                                                    </div>
                                                </div> 
                                            </div> 
                                        @endforeach
                                    @endif

                            </div> 
                        <hr class="mx-auto" style="width:100%; color: #ffffff; height: 2px; ">
                        <div class="row m-3">

                            <p class="col-md-6"><b>Total Price:</b></p>
                            <p class="col-md-6"> <b>MMK <span id="total_price">{{session()->has('cart')? number_format(session()->get('cart')->totalPrice):'0'}}<span></b> </p>

                        </div>
                        <div class="text-center m-3">
                            @if(session()->has('cart'))
                                @auth
                                <a href="{{route('cart.checkout' , Auth::getUser()->name)}}">
                                    <button type="button" class="btn btn-sm mx-auto mt-3 text-white" id="checkout-btn"
                                        style="border-radius : 20px; width:40%; background-color : #aa0000;">Check out</button>
                                </a>
                                @endauth
                            @else
                                <a href="{{route('home')}}">
                                    <button type="button" class="btn btn-sm mx-auto mt-3 text-white" id="checkout-btn"
                                        style="border-radius : 20px; width:40%; background-color : #aa0000;">Shop with us</button>
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            {{-- <p class="col-md-6"> <b>MMK <span id="total_price">{{json_encode(session()->get('cart'))}}<span></b> </p> --}}

        @endif
        @endauth
        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>

    <script src="{{asset('js/jquery/jquery.min.js')}}"></script>
    <script>
    
    $("#preloader").css('display','block');
    $("body").css('opacity','0.3');

    $(window).on('load',function(){
        $("#preloader").css('display','none');
        $("body").css('opacity','1');

    });

    function openModel() {
        $("#myModal").modal('show');
    }

    function closeModel(){
        $("#myModal").modal('hide');
    }

    function updateCart(icon)
        {
            if(icon.getAttribute('id') == 'plus'){

                var id = icon.getAttribute('data-id');
                $("#qty_"+id).text(1+parseInt($("#qty_"+id).text()));
                var qty = $("#qty_"+id).text();
                var price = document.getElementById("price_"+id).getAttribute('data-price');

                $.ajax({
                    type: "POST",
                    url: '/products/'+id,
                    data: { qty: qty, price: price },
                beforeSend: function(){
                    $("#cartModel").css("display","none");
                    $("#cart-loader").css("display",'grid');
                },
                success: function( response ) {
                    var value = JSON.parse(response);
                    $("#total_price").text(custom_number_format(value.total_price));
                    $("#cartcount").text(value.total_quantity);
                    $("#cartModel").css("display","block");
                    $("#cart-loader").css("display",'none');
                },

            });

            }else{

                var id = icon.getAttribute('data-id');
                var qty = $("#qty_"+id).text();
                var price = document.getElementById("price_"+id).getAttribute('data-price');

                $("#qty_"+id).text(parseInt(qty)-1);

                var qty_update = $("#qty_"+id).text();
                
                if(qty == 1) {
                    $("#qty_"+id).text('1');
                    alert("Minium amount reached");
                }else{

                    $.ajax({
                        type: "POST",
                        url: '/products/'+id,
                        data: { qty: qty_update, price: price },
                    beforeSend: function(){
                        $("#cartModel").css("display","none");
                        $("#cart-loader").css("display",'grid');
                    },
                    success: function( response ) {
                        var value = JSON.parse(response);
                        $("#total_price").text(custom_number_format(value.total_price));
                        $("#cartcount").text(value.total_quantity);
                        $("#cartModel").css("display","block");
                        $("#cart-loader").css("display",'none');
                    },
                    });
                }   
            }
        }
    
    function custom_number_format( number_input, decimals, dec_point, thousands_sep ) {
        var number = ( number_input + '' ).replace( /[^0-9+\-Ee.]/g, '' );
        var finite_number   = !isFinite( +number ) ? 0 : +number;
        var finite_decimals = !isFinite( +decimals ) ? 0 : Math.abs( decimals );
        var seperater     = ( typeof thousands_sep === 'undefined' ) ? ',' : thousands_sep;
        var decimal_pont   = ( typeof dec_point === 'undefined' ) ? '.' : dec_point;
        var number_output   = '';
        var toFixedFix = function ( n, prec ) {
            if( ( '' + n ).indexOf( 'e' ) === -1 ) {
            return +( Math.round( n + 'e+' + prec ) + 'e-' + prec );
            } else {
            var arr = ( '' + n ).split( 'e' );
            let sig = '';
            if ( +arr[1] + prec > 0 ) {
                sig = '+';
            }
            return ( +(Math.round( +arr[0] + 'e' + sig + ( +arr[1] + prec ) ) + 'e-' + prec ) ).toFixed( prec );
            }
        }
        number_output = ( finite_decimals ? toFixedFix( finite_number, finite_decimals ).toString() : '' + Math.round( finite_number ) ).split( '.' );
        if( number_output[0].length > 3 ) {
            number_output[0] = number_output[0].replace( /\B(?=(?:\d{3})+(?!\d))/g, seperater );
        }
        if( ( number_output[1] || '' ).length < finite_decimals ) {
            number_output[1] = number_output[1] || '';
            number_output[1] += new Array( finite_decimals - number_output[1].length + 1 ).join( '0' );
        }
        return number_output.join( decimal_pont );
    }

    function removeCart(val)
    {
        if (confirm("Are you sure?") == true) {

        var id = val.getAttribute('data-id');

        $.ajax({
                type: "POST",
                url: '/product/'+id,
                data: { id: id }
            }).done(function( response ) {
                location.reload();
            }); 

        }

    }
    function search(){
        if($("#p_name").val() !="" ){
            $("#searchForm").submit();
        }
    }
    $(document).ready(function(){

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $("#del").click(function(){

            var id = document.getElementById('del').getAttribute('data-id');

            $.ajax({
                type: "POST",
                url: '/product/'+id,
                data: { id: id }
            }).done(function( response ) {
                // var value = JSON.parse(response);
                // $("#qty").text(value.qty);
                // $("#total_price").text(value.total_price);

            });        
        })

    })
    </script>

</html>