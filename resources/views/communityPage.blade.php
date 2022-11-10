@extends('layouts.app')

@section('intro')
    <cite>" We do not have to do it alone. We were never meant to "</cite>
@endsection



@section('content')
    <div>
        <div class="card__title">
            <img src="storage/images/icons/love.svg" alt="go to donate page" class="card__title-img">
            <h1 class="card__title-txt">Community</h1>
        </div>
        <section class="form">
            <select id="campus_filter" type="text" class="form__input" name="campus_id" value="{{ old('campus_id') }}"
                required>
                <option id="campus" value="{{ $firstCampus->id }}">{{ $firstCampus->name }}</option>
                @foreach ($campuses as $campus)
                    <option value="{{ $campus->id }}">{{ $campus->name }}</option>
                @endforeach
            </select>
            <input id="date_filter" type="date" value="<?php echo date('Y-m-d'); ?>">
        </section>
        <section>
            <h2 class="sub-title">Requests</h2>
            <ul class="request-card__container" id="filter-requests">
                @if (count($requests) === 0)
                    <p>No requests</p>
                @else
                    @foreach ($requests as $request)
                        <li class="request-card">
                            <div class="request-card__allergies-container">
                                <p>Allergies</p>
                                <ul class="request-card__allergies">
                                    @foreach ($request->user->allergens as $userAllergy)
                                        @if ($userAllergy)
                                            <li class="request-card__icon">
                                                <img src="storage/images/food_allergy_icons/{{ $userAllergy->icon }}"
                                                    alt="{{ $userAllergy->name }}">
                                            </li>
                                        @else
                                            No allergies
                                        @endif
                                    @endforeach
                                </ul>
                            </div>
                            <button class="donate-button request-card__btn" data-id="{{ $request->id }}"
                                data-date="{{ $request->date }}">
                                Donate
                            </button>
                        </li>
                        <form action="/communityPage" method="POST" enctype="multipart/form-data" class="form form--blue">
                            @csrf
                            <div id="{{ $request->id }}-form"></div>

                        </form>
                    @endforeach
                @endif
            </ul>
        </section>
        <section>
            <h2 class="sub-title">Donations</h2>
            <ul class="meal-card__container" id="filter-donations">
                @if (count($donations) === 0)
                    <p>no donations</p>
                @else
                    @foreach ($donations as $donation)
                        <li class="meal-card">
                            <img src="storage/images/icons/delete.svg" alt="delete meal" class="meal-card__delete">
                            <button class="meal-card__btn btn-primary claim" data-id="{{ $donation->id }}">Claim</button>
                            <div class="meal-card__info">
                                <p class="meal-card__info-description">{{ $donation->description }}</p>
                                <div class="meal-card__info-group">
                                    <h3>{{ $donation->name }}</h3>
                                    <ul class="request-card__allergies">
                                        <?php
                                        $icons = explode(',', $donation->allergen_icons);
                                        ?>
                                        @foreach ($icons as $icon)
                                            <li class="request-card__icon">
                                                <img src="storage/images/food_allergy_icons/{{ $icon }}"
                                                    alt="">
                                            </li>
                                        @endforeach

                                    </ul>
                                </div>
                            </div>
                            <img src="storage/meals/{{ $donation->image }}" alt="{{ $donation->name }}"
                                class="meal-card__image">
                        </li>
                    @endforeach
                @endif
            </ul>
        </section>

    </div>
@endsection
