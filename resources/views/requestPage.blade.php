@extends('layouts.app')

@section('intro')
    <a href="/requestPage" class="btn btn--home">
        <img src="storage/images/icons/love.svg" alt="go to request a meal page" class="btn--home__request-img">
        <span class="btn--home__text btn--home__text-request">Request meal</span>
    </a>
@endsection

@section('content')
    <div class="request-page">
        <form action="" method="POST" enctype="multipart/form-data" class="form form--blue">
            @csrf
            <div class="form__item">
                <select id="campus_id" type="text" class="form__input" name="campus_id" value="{{ old('campus_id') }}"
                    required autofocus>
                    <option value="">Choose campus</option>
                    @foreach ($campuses as $campus)
                        <option value="{{ $campus->id }}">{{ $campus->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form__item">
                <input type="date" name="date" class="form__input">
                <label for="date"class="form__label">Date</label>
            </div>
            <div class="request-page__user-message">
                <p class="main-layout__user">Hey, <span class="main-layout__username">{{ $user->name }}</span></p>
                <p>Lorem ipsum dolor sit amet,
                    consectetur adipiscing elit.</p>
            </div>

            <button type="submit" id="submit" class="btn btn-primary btn-primary--blue">Request</button>
        </form>
    </div>
@endsection
