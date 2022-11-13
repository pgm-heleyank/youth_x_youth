<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Models\Meal;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Auth::routes();

Route::middleware('auth')->group(function () {
    Route::get('/', [App\Http\Controllers\LandingController::class, 'landing']);
    Route::get('/start', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/firstTimeUser', [App\Http\Controllers\UserController::class, 'editProfile']);
    Route::post('/firstTimeUser', [App\Http\Controllers\UserController::class, 'saveAllergens']);
    Route::get('/homePage', [UserController::class, 'homePage']);
    Route::get('/logout', [App\Http\Controllers\LogoutController::class, 'index']);
    Route::get('/donatePage', [App\Http\Controllers\MealsController::class, 'index']);
    Route::post('/donatePage', [App\Http\Controllers\MealsController::class, 'saveDonation']);
    Route::get('/requestPage', [App\Http\Controllers\MealsController::class, 'order']);
    Route::post('/requestPage', [App\Http\Controllers\MealsController::class, 'saveOrder']);
    Route::get('/userPage', [App\Http\Controllers\UserController::class, 'userPage']);
    Route::post('/userPage', [App\Http\Controllers\UserController::class, 'saveProfile']);
    Route::get('/contactPage', [App\Http\Controllers\UserController::class, 'contactPage']);
    Route::get('/communityPage', [App\Http\Controllers\MealsController::class, 'communityPage']);
    Route::post('/communityPage', [App\Http\Controllers\MealsController::class, 'donateMeal']);
    Route::get('/profilePage', [App\Http\Controllers\UserController::class, 'profilePage']);

    // API Routes
    // API for community page filter
    Route::get('api/campus/{c}/{d}', function ($c, $d) {
        $user = Auth::user();
        if ($c) {
            # code...
            $requests = DB::table('orders')
                ->leftJoin('allergen_user', 'allergen_user.user_id', 'orders.user_id')
                ->join('allergens', 'allergens.id', 'allergen_user.allergen_id')
                ->where('orders.user_id', '!=', 0)
                ->where('orders.user_id', '!=', $user->id)
                ->where('orders.meal_id', 0)
                ->where('orders.date', $d)
                ->where('orders.campuse_id', $c)
                ->select(DB::raw('orders.*, group_concat(allergen_id) as allergen_ids, group_concat(allergens.name) as allergen_names, group_concat(allergens.icon) as allergen_icons'))
                ->groupBy('orders.id')
                ->get();
        } else {
            $requests = DB::table('orders')
                ->leftJoin('allergen_user', 'allergen_user.user_id', 'orders.user_id')
                ->join('allergens', 'allergens.id', 'allergen_user.allergen_id')
                ->where('orders.user_id', '!=', 0)
                ->where('orders.user_id', '!=', $user->id)
                ->where('orders.meal_id', 0)
                ->where('orders.date', $d)
                ->select(DB::raw('orders.*, group_concat(allergen_id) as allergen_ids, group_concat(allergens.name) as allergen_names, group_concat(allergens.icon) as allergen_icons'))
                ->groupBy('orders.id')
                ->get();
        }

        $donations = DB::table('orders')
            ->join('meals', 'orders.id', 'meals.order_id')
            ->leftJoin('allergen_meal', 'allergen_meal.meal_id', 'meals.id')
            ->join('allergens', 'allergens.id', 'allergen_meal.allergen_id')
            ->where('orders.user_id', 0)
            ->where('orders.meal_id', '!=', 0)
            ->where('orders.date', $d)
            ->where('meals.claimed', 0)
            ->where('meals.user_id', '!=', $user->id)
            ->select(DB::raw('meals.*,orders.*, group_concat(allergens.icon) as allergen_icons, group_concat(allergens.name) as allergen_names, group_concat(allergens.icon) as allergen_icons'))
            ->groupBy('orders.id', 'meals.id')
            ->get();
        return response(json_encode([$requests, $donations]))
            ->header('Content-Type', 'text/plain');
    });
    Route::get('api/claim/{claimId}', function ($claimId) {
        $user = Auth::user();



        $order = Order::find($claimId);
        if ($order) {
            $order->user_id = $user->id;
            $meal = Meal::find($order->meal_id);
            $meal->claimed = 1;
            $meal->save();
            $order->save();
        }

        return response(json_encode($order))
            ->header('Content-Type', 'text/plain');
    });
});
