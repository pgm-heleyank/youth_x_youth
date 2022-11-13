@extends('layouts.main')

@section('intro')
    <div class="intro">
        <img class="intro__image" src="{{ asset('storage/images/student_eating.png') }}" alt="Denise">
        <div class="intro__text">
            <p class="intro__user">Hey, <span class="main-layout__username">{{ $user->name }}</span></p>
            <p>Welcome to our app. Please tell us what you don't eat and we will try to take it in account. We can't
                guarantee
                anything
                so do be carefull when you are allergic. We love you.</p>
        </div>
    </div>
@endsection



@section('content')
    <div class="card__title">
        <img src="storage/images/icons/bowl.svg" alt="go to donate page" class="card__title-img">
        <h1 class="card__title-txt">Food allergies?</h1>
    </div>
    <form method="POST" id="form-allergy" class="form form--blue">
        @csrf
        <div>
            <ul class="tile__container">
                @foreach ($allergies as $allergy)
                    <div class="tile">
                        <img src="storage/images/food_allergy_icons/{{ $allergy->icon }}" alt="{{ $allergy->name }}"
                            class="tile__image">
                        <label class="tile__text" for="{{ $allergy->name }}">{{ $allergy->name }}
                            <input type="checkbox" id="{{ $allergy->name }}" name="allergies[]" value="{{ $allergy->id }}"
                                selected>
                            <div class="tile__custom_checkbox"></div>
                        </label>



                    </div>
                @endforeach
            </ul>
            <ul class="tile__container" id="more-container">
                <button type="button" class="more" id="more"><span>more</span>
                    <img src="storage/images/icons/more.svg" alt="more" class="">
                </button>

            </ul>
        </div>
        <div class="btn-group form__extra-info">
            <div id="reset">
                <button type="reset" id="reset-btn" class="btn btn-secondary btn-secondary--blue form__btn">no
                    allergies</button>
            </div>
            <button type="submit" id="submit" class="btn btn-primary btn-primary--blue form__btn">continue</button>
        </div>
    </form>
@endsection
