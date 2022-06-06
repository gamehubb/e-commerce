@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card bg-black text-white">
                <div class="card-header h3 text-center">Change Passowrd</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('login-user') }}">
                        @csrf

                        @if(Session::get('info'))
                        <div class="alert alert-danger">
                            {{ Session::get('fail') }}
                        </div>
                    @endif
                    @if(Session::get('infoconfirm'))
                        <div class="alert alert-info">
                            {{ Session::get('success')}}
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
                 

                        <div class="row mb-3">
                            <label for="oldpassword"
                                class="col-md-3 col-form-label text-right">{{ __('Old Password') }}</label>

                            <div class="col-md-6">
                                <input id="oldpassword" type="password"
                                    class="form-control @error('oldpassword') is-invalid @enderror" name="oldpassword"
                                    required >
                                    <span toggle="#oldpassword" class="fa fa-fw fa-eye field-icon toggle-password text-dark"
                                             style = " float: right;margin-right : 10px; margin-top: -25px;position: relative;z-index: 2;"></span>
                                @error('oldpassword')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="newpassword"
                                class="col-md-3 col-form-label text-right">{{ __('New Password') }}</label>

                            <div class="col-md-6">
                                <input id="newpassword" type="password"
                                    class="form-control @error('newpassword') is-invalid @enderror" name="newpassword"
                                    required>
                                    <span toggle="#newpassword" class="fa fa-fw fa-eye field-icon toggle-password text-dark"
                                    style = " float: right;margin-right : 10px; margin-top: -25px;position: relative;z-index: 2;"></span>
                                @error('newpassword')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="confpasowrd"
                                class="col-md-3 col-form-label text-right">{{ __('Confirm Password') }}</label>
                            <div class="col-md-6">
                                <input id="confpasowrd" type="password"
                                    class="form-control @error('confpasowrd') is-invalid @enderror" name="confpasowrd"
                                    required >
                                       <span toggle="#confpasowrd" class="fa fa-fw fa-eye field-icon toggle-password text-dark"
                                             style = " float: right;margin-right : 10px; margin-top: -25px;position: relative;z-index: 2;"></span>
                                @error('confpasowrd')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6 offset-md-3 mt-3">
                            <input type="submit" class="btn text-white" style="background-color : #aa0000;"
                                value="Change Password" >
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