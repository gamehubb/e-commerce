@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card  bg-black text-white">
                <div class="card-header h3 text-center">REGISTER</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @if(Session::get('fail'))
                        <div class="alert alert-danger">
                            {{ Session::get('fail') }}
                        </div>
                    @endif
                    @if(Session::get('success'))
                        <div class="alert alert-info">
                            {{ Session::get('success')}}
                        </div>
                    @endif
                        @csrf
                        <div class="row mb-3">
                            <label for="name" class="col-md-3 col-form-label text-right">Name</label>
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
                            <label for="email" class="col-md-3 col-form-label text-right"> E-Mail Address </label>
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
                            <label for="password" class="col-md-3 col-form-label text-right">Password</label>
                            <div class="col-md-6">
                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password"
                                    required autocomplete="new-password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-3 col-form-label text-right"> Confirm
                                Password </label>
                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control"
                                    name="password_confirmation" required autocomplete="new-password">
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
@endsection