@extends('layouts.master_login')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4 mt-5">
            <div class="card border-0 border-radius shadow">
                <div class="card-body mb-4">
                    <div class="text-center mb-3">
                        <img src="{{asset('img/logo.png')}}" alt="Logo" width="100"> <br><br>
                        <h4 class="khmer_moul">{{__('lb.Worker System')}}</h4>
                        <p class="khmer_battambang">{{__('lb.Version')}} {{env('APP_VERSION')}}</p>
                    </div>
                
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        
                        <div class="row mb-3">
                            <div class="col-sm-12">
                                <label for="username" class="col-form-label khmer_battambang text-md-end">{{ __('lb.Username') }}</label>

                                <input id="username" type="username"
                                    class="form-control @error('username') is-invalid @enderror" name="username"
                                    value="{{ old('username') }}" placeholder="{{__('lb.Please enter your username')}}" required autofocus>

                                @error('username')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-sm-12">
                                <label for="password" class="col-form-label khmer_battambang text-md-end">{{ __('lb.Password') }}</label>
                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password"
                                    placeholder="{{__('lb.Please enter your password')}} "
                                    required autocomplete="current-password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-12">
                                <div class="d-grid gap-2">
                                        <button type="submit" class="btn btn-primary bg-default border-0" style="background: #0187c1;">
                                        <i class="fas fa-sign-out-alt mr-2"></i>
                                        {{ __('lb.Login') }}
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection