@extends('layouts.app')

@section('intro')
@endsection



@section('content')
    <div>
        <h1>Community</h1>
        <section class="form">
            <select id="campus_filter" type="text" class="form__input" name="campus_id" value="{{ old('campus_id') }}"
                required>
                <option value="{{ $firstCampus->id }}">{{ $firstCampus->name }}</option>
                @foreach ($campuses as $campus)
                    <option value="{{ $campus->id }}">{{ $campus->name }}</option>
                @endforeach
            </select>
            <input id="date_filter" type="date" value="<?php echo date('Y-m-d'); ?>">
        </section>
        <section>
            <h2>Requests</h2>
            <ul class="request-card__container" id="filter-requests">
                @if (count($requests) === 0)
                    <p>No requests</p>
                @else
                    @foreach ($requests as $request)
                        <li class="request-card">
                            <img src="storage/images/icons/delete.svg" alt="delete meal" class="request-card__delete">
                            <div class="request-card__allergies-container">
                                <p>Allergies</p>
                                <ul class="request-card__allergies">
                                    @foreach ($request->user->allergens as $userAllergy)
                                        <li class="request-card__icon">
                                            <img src="storage/images/food_allergy_icons/{{ $userAllergy->icon }}"
                                                alt="{{ $userAllergy->name }}">
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            <p>Donate</p>
                        </li>
                    @endforeach
                @endif
            </ul>
        </section>
        <section>
            <h2 class="">Donations</h2>
            <ul class="meal-card__container" id="filter-donations">
                @if (count($donations) === 0)
                    <p>no donations</p>
                @else
                    @foreach ($donations as $donation)
                        <li class="meal-card">
                            <img src="storage/images/icons/delete.svg" alt="delete meal" class="meal-card__delete">
                            <button class="meal-card__btn btn-primary">Claim</button>
                            <div class="meal-card__info">
                                <p class="meal-card__info-description">{{ $donation->description }}</p>
                                <div class="meal-card__info-group">
                                    <h3>{{ $donation->name }}</h3>
                                    <ul>
                                        <li>food contains</li>
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
