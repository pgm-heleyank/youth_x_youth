@extends('layouts.app')



@section('content')
    <div class="request-page">
        <div class="card__title">
            <img src="storage/images/icons/love.svg" alt="go to donate page" class="card__title-img">
            <h1 class="card__title-txt">Request meal</h1>
        </div>
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
            <div class="request-page__user-message form__extra-info">
                <p class="main-layout__user">Hey, <span class="main-layout__username">{{ $user->name }}</span></p>
                <p>"Sometimes asking for help is the bravest thing you can do"</p>
            </div>

            <button type="submit" id="submit" class="btn btn-primary btn-primary--blue form__btn">Request</button>
        </form>
    </div>
@endsection
