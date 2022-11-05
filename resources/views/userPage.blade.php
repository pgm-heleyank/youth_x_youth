@extends('layouts.app')
@section('content')
    <div class="donate-page">
        <h1>Your information</h1>
        <form action="" method="POST" enctype="multipart/form-data" class="form form--blue">
            @csrf
            <select id="campus_id" type="text" class="form__input" name="school_id" value="{{ old('campus_id') }}" required>
                <option value="{{ $user->school->id }}">{{ $user->school->name }}</option>
                @foreach ($schools as $school)
                    <option value="{{ $school->id }}">{{ $school->name }}</option>
                @endforeach
            </select>

            <div class="form__item">
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror form__input"
                    name="email" value="{{ $user->email }}" autocomplete="email">

                <label for="email" class="form__label"> studentmail</label>
            </div>

            <h2 class="label label--blue">Food allergies</h2>

            <ul class="tile__container">
                @foreach ($userAllergies as $userAll)
                    <div class="tile">
                        <img src="storage/images/food_allergy_icons/{{ $userAll->icon }}" alt="{{ $userAll->name }}"
                            class="tile__image">
                        <label class="tile__text" for="{{ $userAll->name }}">{{ $userAll->name }}
                            <input type="checkbox" id="{{ $userAll->name }}" name="allergies[]"
                                value="{{ $userAll->id }}" selected checked>
                            <div class="tile__custom_checkbox"></div>
                        </label>
                    </div>
                @endforeach
                @foreach ($otherAllergies as $allergies)
                    @foreach ($allergies as $allergy)
                        <div class="tile">
                            <img src="storage/images/food_allergy_icons/{{ $allergy->icon }}" alt="{{ $allergy->name }}"
                                class="tile__image">
                            <label class="tile__text" for="{{ $allergy->name }}">{{ $allergy->name }}
                                <input type="checkbox" id="{{ $allergy->name }}" name="allergies[]"
                                    value="{{ $allergy->id }}" selected>
                                <div class="tile__custom_checkbox"></div>
                            </label>
                        </div>
                    @endforeach
                @endforeach
            </ul>
            <ul class="tile__container" id="more-container">

            </ul>
            <button type="submit" id="submit" class="btn btn-primary btn-primary--blue">change information</button>
        </form>
    </div>
@endsection
