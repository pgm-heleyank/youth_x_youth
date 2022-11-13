@extends('layouts.basic')
@section('head')
    @vite(['resources/js/app.js'])
    @vite(['resources/js/landing.js'])
@endsection


@section('content-box')
    <div class="landing-page">
        <img class="landing-page__img" src="{{ asset('storage/images/student_by_student.png') }}" alt="artwork Denise">
    </div>
@endsection
