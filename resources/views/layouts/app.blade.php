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
        margin: auto;
        padding: 4px;
        position: relative;
        top: 5px;
        left: 1px;
    }

    #trash:hover{
        background-color: #aa00aa;
    }

    #c_trash:hover{
        text-decoration:underline;
    }

    #nav_hover:hover {
        border-bottom:2px solid #aa0000;
    }
</style>

<div id="preloader">
    <div id="loader"></div>
</div>

<body style="background:black;" class="d-flex flex-column min-vh-100">
           
    <div id="app">
        <header class="header-box">
            <div class="container">
                <div class="col-md-6 col-sm-6 col-xs-12 text-left site-icon ml-3" style="">              
                        <a href="/" style="color: #aa0000;">
                            <span class="firstletter h1" style="font-variant:petite-caps;font-style:italic;">Gamehub</span> <sub class="secondletter h5" style="font-style:italic;">Myanmar<sub style="font-size:9px;font-style:italic;">Shop</sub></sub>
                        </a>
                   
                </div>
                {{-- <div class="col-md-6 col-sm-6 col-xs-12 text-left">
                    <a href="/" style="color: #aa0000;">
                        <i class="firstletter h1">Gamehub</span> <i class="secondletter h2">Myanmar</span></h1>
                    </a>
                </div> --}}
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
                <ul class="navbar-nav" style="float:left;flex-direction:inherit !important;">
                    <!-- Authentication Links -->

                    @guest
                        <li class="nav-item dropdown" id="nav_hover">
                            <i class="nav-item fa fa-user text-white m-2"   onclick="this.classList.toggle('open')" style="font-size:20px;cursor:pointer;" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre></i>
                            <div class="dropdown-menu dropdown-menu" aria-labelledby="navbarDropdown" style="position: absolute !important;">
                                @if (Route::has('login'))
                                    <a class="dropdown-item" href="{{ route('login') }}">{{ __('Login') }}</a>
                                @endif

                                @if (Route::has('register'))
                                    <a class="dropdown-item" href="{{ route('register') }}">{{ __('Register') }}</a>
                                @endif
    
                            </div>
                        </li>

                    @else

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

                                    <i class="fa fa-shopping-cart text-whit m-2" style="font-size: 20px;
                                    position: absolute;
  bottom: 0;
  width: 100%;
  border-radius: 0 0 var(--radius) var(--radius);
  box-shadow: 0 -2px 20px rgba(#000, .15);
  background: var(--cd-color-3);" id="cart">
                                        <sup id="cartcount" style="background: #AA2B25;
                                        border-radius: 77px;
                                        border: 4px solid #AA2B25;"> {{ session()->has('cart') ? session()->get('cart')->totalQty : '' }}</sup>
                                    </i>
                                </a>
                                @else
                                    <i class="fas fa-shopping-cart text-white m-2" style="font-size:20px;">
                                    </i>
                                @endif
                                

                            </li>
                        @else

                            <li class="nav-item" onclick="openModel()" style="cursor:pointer" id="nav_hover">
                                @if(session()->has('cart'))
                                    @if(session()->get('cart')->totalQty != 0)
                                        <i class="fas fa-shopping-cart text-white m-2"  style="font-size:20px;">
                                            <sup id="cartcount" style="background: #AA2B25;
                                            border-radius: 77px;
                                            border: 4px solid #AA2B25;"> {{ session()->get('cart')->totalQty }}</sup>
                                        </i>
                                    @else
                                        <i class="fas fa-shopping-cart text-white m-2"  style="font-size:20px;">
                                            
                                        </i>
                                    @endif

                                @else
                                    <i class="fas fa-shopping-cart text-white m-2"  style="font-size:20px;">
                                    </i>
                                @endif

                                <!-- </a> -->
                            </li>

                        @endif

                        <li class="nav-item dropdown" id="nav_hover">
                            <i class="nav-item fa fa-user text-white m-2" onclick="this.classList.toggle('open')" style="font-size:20px;cursor:pointer;" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre></i>
                            <div class="dropdown-menu dropdown-menu-left" aria-labelledby="navbarDropdown" style="position: absolute !important;">
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
                    @endguest
                    &nbsp;&nbsp;&nbsp;
                    <li class="nav-item float-right" id="nav_hover">
                        <a class="link-light" href="https://gamehubmyanmar.com">
                            <i class=" fa fa-gamepad text-white mt-2"  style="font-size:20px;" data-toggle="tooltip" data-placement="left" title="Checkout out available games"></i>
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
                            {{-- <div class="p-1" style="background-color: #aa0000;">
                                <p class="text-center h3">Gamehub Myanmar</p>&nbsp;&nbsp;&nbsp;&nbsp;
                                <button type="button" class="close" data-dismiss="modal"
                                    style="position: absolute; top:3px; right:10px;font-size:22px;" onclick="closeModel()">&times;</button>
                            </div> --}}
                            <div class="modal-body" id="cartData">
                                
                                    <div class="p-1">
                                        <p class="text-left h2">Your cart</p>
                                        <button type="button" class="close" data-dismiss="modal"
                                            style="position: absolute; top:3px; right:10px;font-size:22px;" onclick="closeModel()">&times;</button>
                                    </div>

                                    @if(session()->has('cart') && session()->get('cart')->totalPrice != 0)
                                        <hr class="mx-auto mb-3" style="width:95%; color: #ec0606;height: 3px;">
                                    @endif


                                    @if(session()->has('cart'))

                                        @foreach(session()->get('cart')->items as $key => $value)
                                            <div class="m-1 p-1 mb-2 row" style=" border: 1px solid #3e3c3c;">
                                                <div class="col-md-4 col-xs-4">
                                                        <img src="{{Storage::url($value['image'])}}" style="width:100%;  height:100%;">
                                                </div>
                                                <div class="col-md-8 col-xs-8">
                                                    <p>{{$value['name']}} </p>
                                                    <p><span id="price_{{$value['id']}}" data-price="{{$value['price']}}">{{number_format($value['price'])}}</span></p>
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
                        @if(session()->has('cart') && session()->get('cart')->totalPrice != 0)
                            <div class="row m-3">
                                <p class="col-md-6"><b>Total Price:</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>MMK <span id="total_price">{{session()->has('cart')? number_format(session()->get('cart')->totalPrice):'0'}}<span></b> </p>
                            </div>
                        @endif
                        <div class="text-center m-3">
                            @if(session()->has('cart') && session()->get('cart')->totalPrice != 0)
                             
                                <a href="{{route('cart.checkout' , Auth::getUser()->name)}}">
                                    <button type="button" class="btn btn-sm mx-auto mt-3 text-white" id="checkout-btn"
                                        style="border-radius : 20px; width:40%; background-color : #aa0000;">Check out</button>
                                </a>
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
        <main class="py-4">
            <div class="container">
                <p class="float-end">
                    <a href="#"> <i class="fa fa-chevron-circle-up fa-2x " style="color: #aa0000;"></i></a>
                </p>
            </div>
            <div class="container">
                <footer class="py-4 mt-5 text-white" style="background-color : #202020; border-radius: 10px">
                    <div class="row">
                        <div class="col-md-7">
                            <div class="container ">
                                <span class="h1" style="color: #aa0000;">GM <label class="h6 text-white">GAMEHUB
                                        MYANMAR</label></span> <br />
                                <label>A place where you can shop and download free games </label>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="container text-white">
                                <div class="row">
                                    <div class="col-md-4 mt-2">
                                        <p><b>Category</b></p>
                                        @foreach ($allCategory as $category )
                                        <a href="{{ route('productCategory',[$category->slug]) }}">
                                        <p>{{$category->name}}</p> 
                                        </a>
                                        @endforeach
                                    
                                    </div>
                                    <div class="col-md-4  mt-2">
                                        <p><b>Brand</b></p>
                                        @foreach ($allBrand as $brand )
                                        <a href="{{ route('productBrand',[$brand->slug]) }}">
                                            <p> {{$brand->name}}  </p> 
                                        </a>
                                        @endforeach
                                    </div>
                                    <div class="col-md-4  mt-2">
                                        <p><b>Company</b></p>
                                        <p> Terms & Condition </p>
                                        <p> Privacy Policy </p>
                                        <p> Supplier Relations </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class=" container row mt-10">
                        <div class="col-md-4">
                            <p><i class="fa fa-clock"></i> Office Hour : 9AM to 5PM </p>
                        </div>
                        <div class="col-md-4 text-center ">
                            <p><i class="fa fa-phone"></i> Call Us: 09963325033,09403113003 </p>
                        </div>
                        <div class="col-md-4 text-right">
                            <p><i class="fa fa-envelope"></i> Mail Us: info@gamehubmyanmar.shop </p>
                        </div>
                    </div>
                </footer><br>
                <p class="text-center text-light">Copyright © 2022. All Rights Reserved by Gamehub Myanmar</p>

            </div>
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

    $(window).on("scroll", function() {
        if($(window).scrollTop() > 50) {
            $("#cart").css("top","right",$(window).scrollTop());
        }
    });

    $('form').submit(function() {
        $("#preloader").css('display','block');
        $("body").css('opacity','0.3');    
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