@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card bg-black text-white">
                <div class="card-header h3 text-center">Change User Info</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('user.changeAccountInfoPost') }}">
                        @csrf
 
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
                            <label for="name"
                                class="col-md-3 col-form-label">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text"
                                    class="form-control @error('name') is-invalid @enderror" name="name"
                                    value="{{auth()->user()->name}}"
                                    required >
                                    
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="email"
                                class="col-md-3 col-form-label">{{ __('Email') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="text"
                                    class="form-control @error('email') is-invalid @enderror" name="email"
                                    value={{auth()->user()->email}}
                                    required>
                                   
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="phone"
                                class="col-md-3 col-form-label">{{ __('Phone Number') }}</label>
                            <div class="col-md-6">
                                <input id="phone" type="text"
                                    class="form-control @error('phone') is-invalid @enderror" name="phone"
                                    value="{{auth()->user()->phone_number}}"
                                    required >
                                @error('phone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2 offset-md-3 mt-3">
                                <input type="submit" class="btn text-white" style="background-color : #aa0000;"
                                    value="Change Info" >
                            </div>
                            <div class="col-md-2 offset-md-3 mt-3">
                                <a href="{{route('user.accountInfo')}}" class="btn text-white" style="background-color : #aa0000;">Back</a>
                            </div>
                        </div>
                    
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection