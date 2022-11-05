<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Campuse;
use App\Models\Allergen;
use App\Models\Meal;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class MealsController extends Controller
{
    /**
     *
     *
     * @return \Illuminate\Routing\Redirector
     */
    public function index()
    {
        $user = Auth::user();
        $school = $user->school->id;
        $campuses = Campuse::where('school_id', $school)->get();
        $allergies = Allergen::all();
        return view('donatePage', [
            'campuses' => $campuses,
            'allergies' => $allergies,
        ]);
    }
    public function saveDonation(Request $request)
    {

        $portions = $request->input('portion');
        for ($counter = 1; $counter <= $portions; $counter++) {
            if ($request->file('image')) {
                $uploaded_path = $request->file('image')->store('public/meals');

                $filename = basename($uploaded_path);
            }



            $meal = new Meal();
            $user = Auth::user();
            $meal->user_id = $user->id;
            $meal->campuse_id = $request->input('campus_id');
            $meal->date = $request->input('date');
            $meal->name = $request->input('name');
            $meal->description = $request->input('description');
            $mealAllergens = $request->input('allergies');
            if (isset($filename)) {
                $meal->image = $filename;
            }


            // create order
            $order = new Order();
            $order->status_id = 4;
            $order->mealbox_id = 1;
            $order->campuse_id = $request->input('campus_id');
            $order->date = $request->input('date');
            $order->user_id = 0;


            $success = $meal->save();
            $meal->allergens()->sync($mealAllergens);
            $meal->orders()->save($order);
        }

        if ($success) {
            return view('successPage');
        }
    }

    public function order()
    {
        $user = Auth::user();
        $school = $user->school->id;
        $campuses = Campuse::where('school_id', $school)->get();
        return view('requestPage', [
            'campuses' => $campuses,
            'user' => $user,
        ]);
    }
    public function saveOrder(Request $request)
    {


        $order = new Order();
        $user = Auth::user();
        $order->user_id = $user->id;
        $order->campuse_id = $request->input('campus_id');
        $order->date = $request->input('date');
        $order->status_id = 1;
        $order->meal_id = 0;
        $order->mealbox_id = 1;

        $success = $order->save();



        if ($success) {
            return view('successPage');
        }
    }
    public function communityPage()
    {
        $user = Auth::user();
        $school = $user->school->id;
        $firstCampus = Campuse::where('school_id', $school)->first();
        $date = Carbon::now()->format('Y-m-d');

        $campuses = Campuse::where('school_id', $school)->get();

        $requests = Order::where('user_id', '!=', $user->id)
            ->where('user_id', '!=', 0)
            ->where('date', $date)
            ->where('meal_id', 0)
            //->where('campuse_id', $firstCampus)
            ->get();

        $donations = DB::table('orders')
            ->where('orders.user_id',  0)
            ->where('orders.date', $date)
            ->where('orders.meal_id', '!=', 0)
            //->where('orders.campuse_id', $firstCampus)
            ->join('meals', 'orders.id', 'meals.order_id')
            ->where('meals.claimed', 0)
            ->get();

        return view('communityPage', [
            'campuses' => $campuses,
            'firstCampus' => $firstCampus,
            'requests' => $requests,
            'donations' => $donations
        ]);
    }
}
