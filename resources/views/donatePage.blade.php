@extends('layouts.app')

@section('intro')
    <a href="/donatePage" class="btn btn--home">
        <img src="storage/images/icons/bowl.svg" alt="go to donate page" class="btn--home__donate-img">
        <span class="btn--home__text btn--home__text-donate">Donate</span>
    </a>
@endsection



@section('content')
    <div class="donate-page">
        <form action="" method="POST" enctype="multipart/form-data" class="form form--blue">
            @csrf
            <select id="campus_id" type="text" class="form__input" name="campus_id" value="{{ old('campus_id') }}"
                required autofocus>
                <option value="">Choose campus</option>
                @foreach ($campuses as $campus)
                    <option value="{{ $campus->id }}">{{ $campus->name }}</option>
                @endforeach
            </select>
            <div class="form__group">
                <div class="form__item">
                    <div class="form__file">
                        <input type="file" name="image" id="image-input" class="form__file-input">
                        <img src="storage/images/icons/add.svg" alt="add your food picture" class="form__file-icon"
                            id="food-img">
                        <label for="image" class="form__file-label"> add food picture</label>
                    </div>
                </div>
                <div class="form__sub-group">
                    <div class="form__item">
                        <input type="date" name="date" class="form__input">
                        <label for="date"class="form__label">Date</label>
                    </div>
                    <div class="form__item">
                        <input type="text" name="name" class="form__input" required>
                        <label for="name" class="form__label">Dish</label>
                    </div>
                </div>
            </div>

            <div class="form__item form__item--textarea">
                <label for="description"class="form__label">Description</label>
                <textarea name="description" class="form__input" required> </textarea>
            </div>
            <div class="form__item">
                <input type="number" name="portion" class="form__input" required>
                <label for="portions"class="form__label">Portions</label>
            </div>
            <h2 class="label label--blue">Food contains</h2>
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
            <button type="submit" id="submit" class="btn btn-primary btn-primary--blue">Donate</button>
        </form>
    </div>
@endsection
