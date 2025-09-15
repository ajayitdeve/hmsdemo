@extends('layouts.auth')

@section('content')
    <div class="account-box" style="opacity:.8;">
        <div class="account-wrapper">
            <h3 class="account-title">{{ __('Login') }}</h3>
            {{-- <div class="row pb-2">
            <div class="col-md-12 text-center">
                <img class="text-center" src="{{asset('assets/img/aplexia-logo.png')}}" alt="">
            </div>
        </div> --}}
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="form-group mb-2">
                    <label for="username" class="col-md-4 col-form-label text-md-end">{{ __('Username') }}</label>
                    <input id="username" type="text" class="form-control @error('username') is-invalid @enderror"
                        name="username" value="{{ old('username') }}" required autocomplete="username" autofocus>
                    @error('username')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                        name="password" required autocomplete="current-password">

                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember"
                            {{ old('remember') ? 'checked' : '' }}>

                        <label class="form-check-label" for="remember">
                            {{ __('Remember Me') }}
                        </label>
                    </div>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-block btn-primary">
                        {{ __('Login') }}
                    </button>
                </div>
                <div class="form-group ">
                    @if (Route::has('password.request'))
                        <a class="btn btn-link" href="{{ route('password.request') }}">
                            {{ __('Forgot Your Password?') }}
                        </a>
                    @endif
                </div>
            </form>

        </div>
    </div>
@endsection
