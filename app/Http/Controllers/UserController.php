<?php

namespace App\Http\Controllers;

use App\Models\Allergen;
use App\Models\Campuse;
use App\Models\Meal;
use App\Models\Order;
use App\Models\School;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        if ($user->registrationStep === 0) {
            $user->registrationStep = 1;
        }
        $user->save();
        return redirect('/homePage');
    }
    public function homePage()
    {
        $user = Auth::user();
        return view('homePage', [
            'user' => $user,

        ]);
    }

    public function userPage()
    {
        $user = Auth::user();
        $schools = School::all();
        $allAllergies = Allergen::all();

        return view('userPage', [
            'user' => $user,
            'schools' => $schools,
            'allAllergies' => $allAllergies,
        ]);
    }

    public function saveProfile(Request $request)
    {
        $user = Auth::user();
        $userAllergens = $request->input('allergies');
        $user->allergens()->sync($userAllergens);
        $user->school_id = $request->input('school_id');
        if ($request->input('email')) {
            $user->email = $request->input('email');
        }
        $user->save();
        return redirect('/userPage');
    }

    public function contactPage()
    {
        $user = Auth::user();
        return view('contactPage', [
            'user' => $user,
        ]);
    }
    public function profilePage()
    {
        $user = Auth::user();
        $school = $user->school->id;
        $campuses = Campuse::where('school_id', $school)->get();
        $firstCampus = Campuse::where('school_id', $school)->first();
        $date = Carbon::now()->format('Y-m-d');
        $userOrders = DB::table('orders')
            ->where('orders.user_id', $user->id)
            ->where('orders.date', '>=', $date)
            ->where('orders.meal_id', '!=', 0)
            ->where('orders.status_id', '!=', 5)
            ->join('meals', 'orders.id', 'meals.order_id')
            ->where('meals.claimed', 1)
            ->get();
        $userDonations = DB::table('meals')
            ->where('meals.user_id', $user->id)
            ->where('meals.date', '>=', $date)
            ->select(DB::raw('meals.id,meals.name,meals.image,meals.user_id as requester_id, orders.user_id as donator_id'))
            ->join('orders', 'meals.id', '=', 'orders.meal_id')
            ->where('orders.status_id', '!=', 3)
            ->get();
        $userMatches = DB::table('orders')
            ->where('orders.user_id',  $user->id)
            ->where('orders.date', '>=', $date)
            ->where('orders.meal_id', '!=', 0)
            ->join('meals', 'orders.id', 'meals.order_id')
            ->where('meals.claimed', 0)
            ->get();

        $userRequests = Order::where('user_id',  $user->id)
            ->where('date', '>=', $date)
            ->where('meal_id', 0)
            ->get();
        return view('profilePage', [
            'campuses' => $campuses,
            'firstCampus' => $firstCampus,
            'userOrders' => $userOrders,
            'userDonations' => $userDonations,
            'userMatches' => $userMatches,
            'userRequests' => $userRequests,
        ]);
    }
}
