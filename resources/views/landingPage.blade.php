<!DOCTYPE html>
<html lang="en">


<head>
    @vite(['resources/sass/app.scss'])
    @vite(['resources/js/app.js'])
    @vite(['resources/js/landing.js'])
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body class="landing-page">
    <h1 class="landing-page__logo-text"><span>You(th)</span><span>x</span> <span>You(th)</span></h1>
    <img class="landing-page__img" src="{{ asset('storage/images/test.png') }}" alt="Denise">
</body>

</html>
