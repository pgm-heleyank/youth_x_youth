@extends('layouts.main')

@section('intro')
    <p class="main-layout__user">Hey, <span class="main-layout__username">{{ $user->name }}</span></p>
    <p>Lorem ipsum dolor sit amet,
        consectetur adipiscing elit.</p>
@endsection



@section('content')
    <form method="POST" id="form-allergy">
        @csrf
        <h1 class="label label--blue">Food allergies</h1>
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
        <div class="btn-group">
            <div id="reset">
                <button type="reset" id="reset-btn" class="btn btn-secondary btn-secondary--blue">no allergies</button>
            </div>
            <button type="submit" id="submit" class="btn btn-primary btn-primary--blue">continue</button>
        </div>
    </form>
@endsection
