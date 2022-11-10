@extends('layouts.main')
@section('menu')
    <div class="hamburger-menu closed" id="hamburger-menu">

        <a href="/homePage" class="app_layout__hero">
            <img src="storage/images/icons/close.svg" alt="menu" class="hamburger-menu__close" id="close-btn">
            <div class="logo title-typography"><span class="logo__first_word">You(th)</span><span
                    class="logo__second_word">x</span><span class="logo__third_word">You(th)</span>
            </div>
        </a>
        <ul class="hamburger-menu__links">
            <li><a href="/homePage">Home</a></li>
            <li><a href="/profilePage">Profile</a></li>
            <li><a href="/userPage">User information</a></li>
            <li>Tips</li>
            <li><a href="/contactPage">Report a problem</a></li>
        </ul>
        <div class="hamburger-menu__logout">
            <a href="/logout" class="btn-primary hamburger-menu__logout-btn">log out</a>
        </div>
    </div>
    <div class="app-layout__menu-container">
        <button id="menu-btn" class="hamburger-menu__menu">
            <img src="storage/images/icons/menu.svg" alt="menu" class="app-layout__menu">
        </button>

        <button class="hamburger-menu__menu">
            <a href="/communityPage">
                <img src="storage/images/icons/community.svg" alt="go to meals page" class="app-layout__burger">
            </a>
        </button>
    </div>
@endsection
