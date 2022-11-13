@extends('layouts.app')
@section('intro')
    <p class="main-layout__user">Hey, <span class="main-layout__username">{{ $user->name }}</span></p>
    <p>Thank you for caring, you are awesome!</p>
@endsection


@section('content')
    <div class="donate-page">
        <div class="card__title">
            <img src="storage/images/icons/bowl.svg" alt="go to donate page" class="card__title-img">
            <h1 class="card__title-txt">Donate</h1>
        </div>
        <form action="" method="POST" enctype="multipart/form-data" class="form form--blue">
            @csrf
            <div>

                @if (count($campuses) > 0)
                    <select id="campus_id" type="text" class="form__input" name="campus_id"
                        value="{{ old('campus_id') }}" required autofocus>
                        <option value="">Choose campus</option>
                        @foreach ($campuses as $campus)
                            <option value="{{ $campus->id }}">{{ $campus->name }}</option>
                        @endforeach
                    </select>
                @else
                    <select id="campus_id" type="text" class="form__input" name="campus_id"
                        value="{{ old('campus_id') }}" hidden>
                        <option value="0">Choose campus</option>
                    </select>
                @endif
                <div class="form__group">
                    <div class="form__item">
                        <div class="form__file">
                            <input type="file" name="image" id="image-input" class="form__file-input" required>
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
            </div>

            <div>
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
                                <input type="checkbox" id="{{ $allergy->name }}" name="allergies[]"
                                    value="{{ $allergy->id }}" selected>
                                <div class="tile__custom_checkbox"></div>
                            </label>
                        </div>
                    @endforeach
                </ul>
            </div>
            <button type="submit" id="submit" class="btn btn-primary btn-primary--blue form__btn">Donate</button>

        </form>
    </div>
@endsection
