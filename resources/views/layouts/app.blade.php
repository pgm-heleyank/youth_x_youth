<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @vite(['resources/sass/app.scss'])
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
            <div class="app_layout__hero">
                <h1 class="logo title-typography"><span class="logo__first_word">You(th)</span><span
                        class="logo__second_word">x</span><span class="logo__third_word">You(th)</span>
                </h1>
            </div>
        </header>
        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>

</html>
