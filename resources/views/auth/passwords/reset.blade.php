@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card  bg-black text-white">
                <div class="card-header  h3 text-center">Reset Password</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf
                        
                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="row mb-3">
                            <label for="email" class="col-md-3 col-form-label text-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="newpassword" class="col-md-3 col-form-label text-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="newpassword" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                <span toggle="#newpassword" class="fa fa-fw fa-eye field-icon toggle-password text-dark"
                                style = " float: right;margin-right : 10px; margin-top: -25px;position: relative;z-index: 2;"></span>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="confpasowrd" class="col-md-3 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="confpasowrd" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                <span toggle="#confpasowrd" class="fa fa-fw fa-eye field-icon toggle-password text-dark"
                                style = " float: right;margin-right : 10px; margin-top: -25px;position: relative;z-index: 2;"></span>
                            </div>
                        </div>
                        
                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Reset Password') }}
                                </button>
                            </div>
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
