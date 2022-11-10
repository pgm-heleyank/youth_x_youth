@extends('layouts.basic')

<?php
header('Refresh: 2; URL=/homePage');
?>

<div class="succes-page">
    @section('content-box')
        <div class="succes-page__content">
            <h1>IT WORKED</h1>
            <p>Thank you for using our app</p>
        </div>
    @endsection
</div>
