@extends('layouts.main')

@section('intro')
    <p>Lorem ipsum dolor sit amet,
        consectetur adipiscing elit.</p>
@endsection



@section('content')
    <form method="POST">
        @csrf
        <h1>Food allergies</h1>
        <ul>
            @foreach ($allergies as $allergy)
                <div class="form-tile">
                    <input type="checkbox" id="{{ $allergy->name }}" name="allergies[]" value="{{ $allergy->id }}" selected>
                    <label for="{{ $allergy->name }}">{{ $allergy->name }}</label>
                    <img src="storage/images/food_allergy_icons/{{ $allergy->icon }}" alt="{{ $allergy->name }}">
                </div>
            @endforeach
        </ul>
        <p>
            other allergies?
            <input type="text" id="search_allergy">
        <div id="checkboxes">
        </div>
        </p>
        <button type="submit" class="btn btn-primary">continue</button>
    </form>
@endsection
