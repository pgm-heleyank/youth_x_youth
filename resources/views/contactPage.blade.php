@extends('layouts.app')

@section('intro')
    <p class="main-layout__user">Hey, <span class="main-layout__username">{{ $user->name }}</span></p>
    <p>test tekstje</p>
@endsection



@section('content')
    <div class="btn--home__container">
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
            <div class="form__item form__item--textarea">
                <label for="message"class="form__label">Message</label>
                <textarea name="message" class="form__input" required></textarea>
            </div>
            <button type="submit" id="submit" class="btn btn-primary btn-primary--blue">send</button>
        </form>
    </div>
@endsection
