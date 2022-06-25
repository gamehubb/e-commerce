<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'GameHub Myanmar') }}</title>

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
	<header class="header-box">
		<div class="container">
			<div class="col-md-12 text-left site-icon m-3">              
					<a href="/" style="color: #aa0000;">
						<span class="firstletter h1">Gamehub</span> <sub class="secondletter h2">Myanmar<sub style="font-size:9px;">Shop</sub></sub>
					</a>
			   
			</div>
		</div>
	</header>

		<div class="text-center mt-2" style=" background:  #d8d8d8;" >
			<img src="{{asset('images/gift.jpeg')}}"     style="width: 370px;height: 300px; margin: auto;" alt="gift"/>
			<h1 class="display-1"> <b>THANK YOU </b></h1>
			<p  class="h3" >FOR SHOPPING WITH US!</p>
			<img src="{{asset('images/gift2.jpeg')}}" style=" " alt="gift"/>
		</div>
	
		<div style="background: #aa0000; padding-top: 36px; padding-bottom: 100px;" class="text-center">
			<a href="{{route('order')}}">
				<button type="button" class="btn btn-sm mx-auto  btn-outline-light mt-3" style="border-radius : 20px;">Check your order List</button>
			</a> 
	</div>
 
</body>
</html>