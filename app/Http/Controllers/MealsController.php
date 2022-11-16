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
            'user' => $user,
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
            $meal->claimed = 0;
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
            $meal->orders()->save($order);
            $meal->allergens()->sync($mealAllergens);

            // update meal
            $mealUp = Meal::find($meal->id);
            $mealUp->order_id = $order->id;
            $mealUp->save();
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

        if ($firstCampus) {
            $requests = Order::where('user_id', '!=', $user->id)
                ->where('user_id', '!=', 0)
                ->where('date', $date)
                ->where('meal_id', 0)
                ->where('campuse_id', $firstCampus->id)
                ->get();

            $donations = DB::table('orders')
                ->join('meals', 'orders.id', 'meals.order_id')
                ->leftJoin('allergen_meal', 'allergen_meal.meal_id', 'meals.id')
                ->join('allergens', 'allergens.id', 'allergen_meal.allergen_id')
                ->where('orders.user_id',  0)
                ->where('orders.date', $date)
                ->where('orders.meal_id', '!=', 0)
                ->where('orders.campuse_id', $firstCampus->id)
                ->where('meals.claimed', 0)
                ->where('meals.user_id', '!=', $user->id)
                ->select(DB::raw('meals.*,orders.*, group_concat(allergens.icon) as allergen_icons, group_concat(allergens.name) as allergen_names, group_concat(allergens.icon) as allergen_icons'))
                ->groupBy('orders.id', 'meals.id', 'meals.name', 'meals.description', 'meals.date', 'meals.image', 'meals.created_at', 'meals.updated_at', 'meals.user_id', 'meals.campuse_id', 'meals.claimed', 'meals.order_id', 'orders.created_at', 'orders.updated_at', 'orders.status_id', 'orders.mealbox_id', 'orders.campuse_id', 'orders.date', 'orders.meal_id', 'orders.user_id')
                ->get();
        } else {
            $requests = Order::where('user_id', '!=', $user->id)
                ->where('user_id', '!=', 0)
                ->where('date', $date)
                ->where('meal_id', 0)
                ->get();

            $donations = DB::table('orders')
                ->join('meals', 'orders.id', 'meals.order_id')
                ->leftJoin('allergen_meal', 'allergen_meal.meal_id', 'meals.id')
                ->join('allergens', 'allergens.id', 'allergen_meal.allergen_id')
                ->where('orders.user_id',  0)
                ->where('orders.date', $date)
                ->where('orders.meal_id', '!=', 0)
                ->where('meals.claimed', 0)
                ->where('meals.user_id', '!=', $user->id)
                ->select(DB::raw('meals.*,orders.*, group_concat(allergens.icon) as allergen_icons, group_concat(allergens.name) as allergen_names, group_concat(allergens.icon) as allergen_icons'))
                ->groupBy('orders.id', 'meals.id', 'meals.name', 'meals.description', 'meals.date', 'meals.image', 'meals.created_at', 'meals.updated_at', 'meals.user_id', 'meals.campuse_id', 'meals.claimed', 'meals.order_id', 'orders.created_at', 'orders.updated_at', 'orders.status_id', 'orders.mealbox_id', 'orders.campuse_id', 'orders.date', 'orders.meal_id', 'orders.user_id')
                ->get();
        }



        return view('communityPage', [
            'campuses' => $campuses,
            'firstCampus' => $firstCampus,
            'requests' => $requests,
            'donations' => $donations
        ]);
    }
    public function donateMeal(Request $request)
    {

        if ($request->file('image')) {
            $uploaded_path = $request->file('image')->store('public/meals');

            $filename = basename($uploaded_path);
        }

        $meal = new Meal();
        $user = Auth::user();
        $meal->user_id = $user->id;
        $meal->claimed = 0;
        $meal->order_id = $request->input('order_id');
        $meal->campuse_id = $request->input('campus_id');
        $meal->date = $request->input('date');
        $meal->name = $request->input('name');
        $meal->description = $request->input('description');
        $mealAllergens = $request->input('allergies');
        if (isset($filename)) {
            $meal->image = $filename;
        }

        $success = $meal->save();
        $meal->allergens()->sync($mealAllergens);

        // update order
        $changeOrder = Order::find($request->input('order_id'));
        $changeOrder->meal_id = $meal->id;
        $changeOrder->save();



        if ($success) {
            return redirect('communityPage');
        }
    }
}
