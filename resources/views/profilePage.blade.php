@extends('layouts.app')

@section('intro')
@endsection



@section('content')
    <div>

        <section>
            <h2>Yours</h2>
            <ul class="order-card__container">
                @foreach ($userOrders as $userOrder)
                    <li class="order-card">
                        <img src="storage/images/icons/delete.svg" alt="delete meal" class="order-card__delete">
                        <div class="order-card__title">
                            <div class="order-card__id">ID: <span class="order-card__id-nr">{{ $userOrder->meal_id }}</span>
                            </div>
                            <p class="order-card__name">{{ $userOrder->name }}</p>
                        </div>
                        <img src="storage/meals/{{ $userOrder->image }}" alt="{{ $userOrder->name }}"
                            class="order-card__image">
                        <button class="order-card__btn btn-primary">Pick up</button>
                    </li>
                @endforeach
                @foreach ($userDonations as $userDonation)
                    <li class="order-card">
                        <img src="storage/images/icons/delete.svg" alt="delete meal" class="order-card__delete">
                        <div class="order-card__title">
                            <div class="order-card__id">ID: <span class="order-card__id-nr">{{ $userDonation->id }}</span>
                            </div>
                            <p class="order-card__name">{{ $userDonation->name }}</p>
                        </div>
                        <img src="storage/meals/{{ $userDonation->image }}" alt="{{ $userDonation->name }}"
                            class="order-card__image">
                        <button class="order-card__btn btn-primary btn-primary--blue">Drop</button>
                    </li>
                @endforeach
            </ul>
        </section>
        <section>
            <h2 class="">Match</h2>
            <ul class="meal-card__container">
                @foreach ($userMatches as $userMatch)
                    <li class="meal-card">
                        <img src="storage/images/icons/delete.svg" alt="delete meal" class="meal-card__delete">
                        <button class="meal-card__btn btn-primary">Claim</button>
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
            <h2 class="">Pending Requests</h2>
            <ul class="request-card__container">
                @foreach ($userRequests as $userRequest)
                    <li class="request-card">
                        <img src="storage/images/icons/delete.svg" alt="delete meal" class="request-card__delete">
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
                @endforeach
            </ul>

        </section>
    </div>
@endsection
