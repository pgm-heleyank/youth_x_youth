<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @vite(['resources/sass/app.scss'])
    @yield('head')
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }}</title>
    <!-- Fonts -->
    <!-- Scripts -->
</head>

<body class="app_layout">
    <div class="app_layout__container">
        <header>
            @yield('menu')
            <div class="app_layout__hero">
                <div class="app_layout__hero">
                    <h1 class="logo title-typography"><span class="logo__first_word">You(th)</span><span
                            class="logo__second_word">x</span><span class="logo__third_word">You(th)</span>
                    </h1>
                </div>
            </div>
            @yield('introduction')
        </header>
        <main class="">
            @yield('content-box')
        </main>
    </div>
</body>

</html>
