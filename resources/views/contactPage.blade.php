@extends('layouts.app')

@section('intro')
    <p class="main-layout__user">Hey, <span class="main-layout__username">{{ $user->name }}</span></p>
    <p>Let's talk, we would love to hear what is on your mind about our app. We are here for you.</p>
@endsection



@section('content')
    <div class="">
        <div class="card__title">
            <img src="storage/images/icons/love.svg" alt="go to donate page" class="card__title-img">
            <h1 class="card__title-txt">Contact</h1>
        </div>
        <form action="" method="POST" enctype="multipart/form-data" class="form form--blue">
            @csrf


            <div class="form__item">
                <input type="text" name="reason" class="form__input" required>
                <label for="reason" class="form__label">Reason contact</label>
            </div>
            <div class="form__item">
                <input type="text" name="meal" class="form__input" required>
                <label for="meal" class="form__label">mealnumber</label>
            </div>
            <div class="form__item form__item--textarea form__extra-info">
                <label for="message"class="form__label">Message</label>
                <textarea name="message" class="form__input" required></textarea>
            </div>
            <div class="form__item form__extra-info">
                <button type="submit" id="submit" class="btn btn-primary btn-primary--blue form__btn">send</button>
            </div>
        </form>
    </div>
@endsection
