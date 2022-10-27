<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Providers\RouteServiceProvider;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function landing()
    {
        return view(
            'landingPage'
        );
    }
    public function index()
    {

        $user = Auth::user();
        if ($user->registrationStep === 0) {
            return redirect('/firstTimeUser');
        } else {
            return 'Nay';
        }
    }
}
