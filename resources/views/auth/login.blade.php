@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card bg-black text-white">
                <div class="card-header h3 text-center">LOGIN</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('login-user') }}">
                        @csrf

                        @if(Session::get('info'))
                        <div class="alert alert-info">
                            {{ Session::get('info') }}
                        </div>
                    @endif
                    @if(Session::get('infoconfirm'))
                        <div class="alert alert-info">
                            {{ Session::get('infoconfirm')}}
                        </div>
                    @endif
                    @if (Session::has('message'))
                        <div class="alert alert-danger" id="alert-message">
                            <ul class="list-unstyled">
                                <li>
                                    {{ Session::get('message') }}
                                </li>
                            </ul>
                        </div>
                    @endif
                    @if (Session::has('success'))
                    <div class="alert alert-danger" id="alert-message">
                        <ul class="list-unstyled">
                            <li>
                                {{ Session::get('success') }}
                            </li>
                        </ul>
                    </div>
                @endif
                        <div class="row mb-3">
                            <label for="email"
                                class="col-md-3 col-form-label text-right">{{ __('E-Mail Address') }}</label>
                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                    name="email" value="{{old('email')}}" required autocomplete="email">
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password"
                                class="col-md-3 col-form-label text-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password"
                                    required autocomplete="current-password">
                                    <span toggle="#password" class="fa fa-fw fa-eye field-icon toggle-password text-dark"
                                    style = " float: right;margin-right : 10px; margin-top: -25px;position: relative;z-index: 2;"></span>
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>


                        <div class="col-md-6 offset-md-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                    {{ old('remember') ? 'checked' : '' }}>

                                <label class="form-check-label" for="remember">
                                    {{ __('Remember Me') }}
                                </label>
                            </div>
                        </div>

                        <div class="col-md-6 offset-md-3 mt-3">
                            <input type="submit" class="btn text-white" style="background-color : #aa0000;"
                                value="LogIn" >
                        </div>
                        <div class="col-md-6 offset-md-3 mt-3 ">
                            @if (Route::has('password.request'))
                            <a class="btn btn-link text-white" href="{{ route('password.request') }}">
                                Forgot Your Password?
                            </a>
                            @endif
                            @if (Route::has('register'))
                            <a class="btn btn-link text-white" href="{{ route('register') }}">
                                Register an Account
                            </a>
                            @endif

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
</script>
@endsection