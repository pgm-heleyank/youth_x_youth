@extends('layouts.basic')
@section('head')
    @vite(['resources/js/app.js'])
@endsection



@section('introduction')
    <div class="main-layout__intro">
        @yield('intro')
    </div>
    </div>
@endsection
@section('content-box')
    <div class="main-layout__main">
        <div class="card card--white">
            @yield('content')
        </div>
    </div>
@endsection
