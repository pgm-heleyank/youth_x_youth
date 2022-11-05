@extends('layouts.basic')


@section('content-box')
    <div class="container">
        <div class="">
            <form method="POST" action="{{ route('login') }}" class="form">
                @csrf

                <div class="form__item">


                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror form__input"
                        name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                    <label for="email" class="form__label">{{ __('Email Address') }}</label>
                    @error('email')
                        <span class="" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>


                <div class="form__item">


                    <input id="password" type="password"
                        class="form-control @error('password') is-invalid @enderror form__input" name="password" required
                        autocomplete="current-password">
                    <label for="password" class="form__label">{{ __('Password') }}</label>

                    @error('password')
                        <span class="" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                </div>

                @if (Route::has('password.request'))
                    <a class="form__forget" href="{{ route('password.request') }}">
                        {{ __('Forgot Your Password?') }}
                    </a>
                @endif

                <div class="">
                    <input class="form-input" type="checkbox" name="remember" id="remember"
                        {{ old('remember') ? 'checked' : '' }}>
                    <label class="label" for="remember">
                        {{ __('Remember Me') }}
                    </label>
                </div>



                <div class="form__item">
                    <div class="btn-group">
                        <button type="submit" class="btn-primary">
                            {{ __('Sign in') }}
                        </button>
                        <a href="{{ route('register') }}" class="btn-secondary">Register</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
