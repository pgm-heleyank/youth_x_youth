<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Providers\RouteServiceProvider;

class LandingController extends Controller
{


    public function landing()
    {
        return view(
            'landingPage'
        );
    }
}
