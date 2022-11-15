@extends('layouts.app')

@section('intro')
    <p class="main-layout__user">Hey, <span class="main-layout__username">{{ $user->name }}</span></p>
    <p>Glad to see you here!</p>
@endsection



@section('content')
    <div class="btn--home__container">
        <a href="/donatePage" class="btn btn--home">
            <img src="./public/storage/images/icons/bowl.svg" alt="go to donate page" class="btn--home__donate-img">
            <span class="btn--home__text btn--home__text-donate">Donate</span>
        </a>
        <a href="/requestPage" class="btn btn--home">
            <img src="storage/images/icons/love.svg" alt="go to request a meal page" class="btn--home__request-img">
            <span class="btn--home__text btn--home__text-request">Request meal</span>
        </a>
    </div>
@endsection
