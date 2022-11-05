@extends('layouts.basic')
@section('head')
    @vite(['resources/js/app.js'])
    @vite(['resources/js/landing.js'])
@endsection


<div class="landing-page">
    @section('content-box')
        <img class="landing-page__img" src="{{ asset('storage/images/test.png') }}" alt="Denise">
    @endsection
</div>
