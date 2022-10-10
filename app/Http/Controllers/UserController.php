<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Meal;


class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        $meals = Meal::all();
        return view('exampletest', [
            'users' => $users,
            'meals' => $meals
        ]);
    }
}
