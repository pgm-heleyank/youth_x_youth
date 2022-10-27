<?php

namespace App\Http\Controllers;

use App\Models\Allergen;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;


class UserController extends Controller
{
    public function editProfile()
    {
        $user = Auth::user();
        $allergies = Allergen::where('pinned', 1)->get();

        return view('firstTimeUser', [
            'allergies' => $allergies,
            'user' => $user

        ]);
    }
    public function saveAllergens(Request $request)
    {
        $user = Auth::user();
        $userAllergens = $request->input('allergies');

        $user->allergens()->sync($userAllergens);

        return redirect('/');
    }
}
