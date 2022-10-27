<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @vite(['resources/sass/app.scss'])
    @vite(['resources/js/app.js'])
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }}</title>
    <!-- Fonts -->
    <!-- Scripts -->
</head>

<body class="main-layout">

    <main class="main-layout__main">
        <div class="main-layout__intro">
            <p class="main-layout__user">Hey, <span class="main-layout__username">{{ $user->name }}</span></p>
            @yield('intro')
        </div>
        <div class="card card--white">
            @yield('content')
        </div>
    </main>
</body>

</html>
