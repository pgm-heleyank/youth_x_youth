@extends('layouts.basic')


@section('content')
    <div class="container">
        <div class="">

            <div class="">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('password.email') }}" class="form">
                    @csrf

                    <div class="form__item">


                        <input id="email" type="email"
                            class="form-control @error('email') is-invalid @enderror form__input" name="email"
                            value="{{ old('email') }}" required autocomplete="email" autofocus>
                        <label for="email" class="form__label">{{ __('Email Address') }}</label>

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                    </div>


                    <div class="form-item">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Send reset link') }}
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection
