@extends('layouts.basic')

@section('hero-image')
    <img class="app_layout__hero__img" src="{{ asset('storage/images/Denise.png') }}" alt="Denise">
@endsection

@section('content-box')
    <div class="container">

        <div class="">
            <form method="POST" action="{{ route('register') }}" class="form">
                @csrf
                <div class="form__item">
                    <label for="school_id" class="form__label--select">{{ __('School') }}</label>
                    <select id="school_id" type="text"
                        class="form-control @error('school') is-invalid @enderror form__input" name="school_id"
                        value="{{ old('school_id') }}" required autofocus>
                        <option value="">Choose school</option>
                        @foreach ($schools as $school)
                            <option value="{{ $school->id }}">{{ $school->name }}</option>
                        @endforeach
                    </select>

                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form__item">


                    <input id="name" type="text"
                        class="form-control @error('name') is-invalid @enderror form__input" name="name"
                        value="{{ old('name') }}" required autocomplete="name" autofocus>

                    <label for="name" class="form__label">{{ __('Name') }}</label>
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form__item">


                    <input id="email" type="email"
                        class="form-control @error('email') is-invalid @enderror form__input" name="email"
                        value="{{ old('email') }}" required autocomplete="email">

                    <label for="email" class="form__label">{{ __('School Email Address') }}</label>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form__item">


                    <input id="password" type="password"
                        class="form-control @error('password') is-invalid @enderror form__input" name="password" required
                        autocomplete="new-password">

                    <label for="password" class="form__label">{{ __('Password') }}</label>
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form__item">


                    <input id="password-confirm" type="password" class="form-control form__input"
                        name="password_confirmation" required autocomplete="new-password">
                    <label for="password-confirm" class="form__label">{{ __('Confirm Password') }}</label>
                </div>

                <div class="form__item">
                    <div class="btn-group">
                        <button type="submit" class="btn-primary">
                            {{ __('Register') }}
                        </button>
                        <a href="{{ route('login') }}" class="btn-secondary">Sign in</a>

                    </div>
                </div>

            </form>

        </div>
    </div>
@endsection
