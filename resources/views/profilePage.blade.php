@extends('layouts.app')

@section('intro')
@endsection



@section('content')
    <div>
        <div class="card__title">
            <img src="storage/images/icons/profile.svg" alt="go to donate page" class="card__title-img">
            <h1 class="card__title-txt">Profile</h1>
        </div>
        <section>
            <h2 class="sub-title">Yours</h2>
            <ul class="order-card__container">
                @foreach ($userOrders as $userOrder)
                    <div class="order-card__wrapper">
                        <img src="storage/images/icons/delete.svg" alt="delete meal"
                            class="order-card__delete delete-userOrder" data-id="{{ $userOrder->id }}">
                        <li class="order-card">
                            <div class="order-card__title">
                                <div class="order-card__id">ID: <span
                                        class="order-card__id-nr">{{ $userOrder->meal_id }}</span>
                                </div>
                                <p class="order-card__name">{{ $userOrder->name }}</p>
                            </div>
                            <img src="storage/meals/{{ $userOrder->image }}" alt="{{ $userOrder->name }}"
                                class="order-card__image">
                        </li>
                        <button class="order-card__btn btn-primary <?php if ($userOrder->status_id === 3) {
                            echo 'collect-btn';
                        } ?>"
                            data-id="{{ $userOrder->id }}"><?php if ($userOrder->status_id === 3) {
                                echo 'Pick up';
                            } ?><?php if ($userOrder->status_id !== 3) {
                                echo 'Pending';
                            } ?></button>
                    </div>
                @endforeach
                @foreach ($userDonations as $userDonation)
                    <div class="order-card__wrapper">
                        <img src="storage/images/icons/delete.svg" alt="delete meal"
                            class="order-card__delete delete-userDonation" data-id="{{ $userDonation->id }}">
                        <li class="order-card">
                            <div class="order-card__title">
                                <div class="order-card__id">ID: <span
                                        class="order-card__id-nr">{{ $userDonation->id }}</span>
                                </div>
                                <p class="order-card__name">{{ $userDonation->name }}</p>
                            </div>
                            <img src="storage/meals/{{ $userDonation->image }}" alt="{{ $userDonation->name }}"
                                class="order-card__image">
                        </li>
                        <button class="order-card__btn btn-primary btn-primary--blue drop-btn"
                            data-id="{{ $userDonation->id }}">Drop</button>
                    </div>
                @endforeach
            </ul>
        </section>
        <section>
            <h2 class="sub-title">Match</h2>
            <ul class="meal-card__container">
                @foreach ($userMatches as $userMatch)
                    <li class="meal-card">
                        <img src="storage/images/icons/delete.svg" alt="delete meal"
                            class="meal-card__delete delete-userMatch" data-id="{{ $userMatch->id }}">
                        <button class="meal-card__btn btn-primary claim" data-id="{{ $userMatch->id }}">Claim</button>
                        <div class="meal-card__info">
                            <p class="meal-card__info-description">{{ $userMatch->description }}</p>
                            <div class="meal-card__info-group">
                                <h3>{{ $userMatch->name }}</h3>
                                <ul>
                                    <li>food contains</li>
                                </ul>
                            </div>
                        </div>
                        <img src="storage/meals/{{ $userMatch->image }}" alt="{{ $userMatch->name }}"
                            class="meal-card__image">
                    </li>
                @endforeach
            </ul>
        </section>
        <section>
            <h2 class="sub-title">Pending Requests</h2>
            <ul class="request-card__container">
                @foreach ($userRequests as $userRequest)
                    <div class="request-card__item-container">

                        <img src="storage/images/icons/delete.svg" alt="delete meal"
                            class="request-card__delete delete-userRequest" data-id="{{ $userRequest->id }}">
                        <li class="request-card">
                            <div class="request-card__allergies-container">
                                <p>Allergies</p>
                                <ul class="request-card__allergies">
                                    @foreach ($userRequest->user->allergens as $userAllergy)
                                        <li class="request-card__icon"><img
                                                src="storage/images/food_allergy_icons/{{ $userAllergy->icon }}"
                                                alt="{{ $userAllergy->name }}"></li>
                                    @endforeach
                                </ul>
                            </div>
                            <p>{{ $userRequest->date }}</p>
                        </li>
                    </div>
                @endforeach
            </ul>

        </section>
    </div>
@endsection
