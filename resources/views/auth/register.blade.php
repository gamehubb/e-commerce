@extends('layouts.app')
@if(Auth::check())
   <script>
        location.href="/";
   </script>
@endif
@section('content')    
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card  bg-black text-white">
                <div class="card-header h3 text-center">REGISTER</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('register-user') }}">
                        @if(Session::get('fail'))
                        <div class="alert alert-danger" id="alert-message">
                            {{ Session::get('fail') }}
                        </div>
                    @endif
                    @if(Session::get('success'))
                        <div class="alert alert-info" id="alert-message">
                            {{ Session::get('success')}}
                        </div>
                    @endif
                    
                        @csrf
                        <div class="row mb-3">
                            <label for="name" class="col-md-3 col-form-label">Name</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                    name="name" value="{{ old('name') }}" required autofocus>
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="phone" class="col-md-3 col-form-label"> Phone Number ( +95 )</label>
                            <div class="col-md-6">
                                <input id="phone" type="tel" class="form-control @error('phone') is-invalid @enderror"
                                    name="phone" value="{{ old('phone') }}" required placeholder="09xxxxxxxxx">
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-3 col-form-label"> E-mail </label>
                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                    name="email" value="{{ old('email') }}" required>
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-3 col-form-label">Password</label>
                            <div class="col-md-6">
                                
                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password"
                                    required autocomplete="new-password">
                                    <span toggle="#password" class="fa fa-fw fa-eye field-icon toggle-password text-dark"
                                    style = " float: right;margin-right : 10px; margin-top: -25px;position: relative;z-index: 2;"></span>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-3 col-form-label"> Confirm
                                Password </label>
                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control @error('password_confirmation') is-invalid @enderror"
                                    name="password_confirmation" required autocomplete="new-password">
                                @error('password_confirmation')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{$message}}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6 offset-md-3 mt-3">
                            <button type="submit" class="btn text-white" style="background-color : #aa0000;">
                                Register
                            </button>
                        </div>
                        <div class="col-md-6 offset-md-3 mt-3 ">
                            Already Have an account?
                            <a class="btn btn-link text-white" href="{{ route('login') }}">
                                Login
                            </a>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{asset('js/jquery/jquery.min.js')}}"></script>

<script type="text/javascript">
$(".toggle-password").click(function() {
$(this).toggleClass("fa-eye fa-eye-slash");
  var input = $($(this).attr("toggle"));
  if (input.attr("type") == "password") {
    input.attr("type", "text");
  } else {
    input.attr("type", "password");
  }
});

$("#alert-message").fadeTo(2000, 500).slideUp(10000, function(){
    $("#alert-message").slideUp(10000);
});
</script>
@endsection