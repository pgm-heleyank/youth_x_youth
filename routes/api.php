<?php

use App\Models\Allergen;
use App\Models\Meal;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// API for allergens that are not highlighted
Route::get('/allergens', function () {
    $allergens = Allergen::where('pinned', '!=', 1)->get();
    return response(json_encode($allergens))
        ->header('Content-Type', 'text/plain');
});



Route::get('userOrder/delete/{orderId}', function ($mealId) {
    $orderIdData = DB::table('meals')
        ->where('meals.id', $mealId)
        ->select('meals.order_id')
        ->get();
    $orderId = $orderIdData[0]->order_id;
    $order = Order::find($orderId);
    $order->user_id = 0;
    $order->save();

    $meal = Meal::find($mealId);
    $meal->claimed = 0;
    $meal->save();


    return response(json_encode([$meal, $order]))
        ->header('Content-Type', 'text/plain');
});
Route::get('userDonation/delete/{orderId}', function ($mealId) {
    $orderIdData = DB::table('meals')
        ->where('meals.id', $mealId)
        ->select('meals.order_id')
        ->get();
    $orderId = $orderIdData[0]->order_id;
    Meal::find($mealId)->delete();
    Order::find($orderId)->delete();


    return response(json_encode('ok'))
        ->header('Content-Type', 'text/plain');
});


Route::get('userMatch/delete/{mealId}', function ($mealId) {
    $orderIdData = DB::table('meals')
        ->where('meals.id', $mealId)
        ->select('meals.order_id')
        ->get();
    $orderId = $orderIdData[0]->order_id;

    Order::find($orderId)->delete();


    return response(json_encode('ok'))
        ->header('Content-Type', 'text/plain');
});


Route::get('userRequest/delete/{orderId}', function ($orderId) {

    Order::find($orderId)->delete();


    return response(json_encode('ok'))
        ->header('Content-Type', 'text/plain');
});


Route::get('drop/{dropId}', function ($dropId) {

    $meal = Meal::find($dropId);
    $order = Order::find($meal->order_id);
    $order->status_id = 3;
    $order->save();

    return response(json_encode('ok'))
        ->header('Content-Type', 'text/plain');
});
Route::get('collect/{collectId}', function ($collectId) {

    $meal = Meal::find($collectId);
    $order = Order::find($meal->order_id);
    $order->status_id = 5;
    $order->save();
    return response(json_encode('ok'))
        ->header('Content-Type', 'text/plain');
});
