<?php

use App\Models\Allergen;
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

// API for profile page filter
Route::get('/campus/{c}/{d}', function ($c, $d) {
    $requests = DB::table('orders')
        ->where('orders.user_id', '!=', 0)
        ->where('orders.meal_id', 0)
        ->where('orders.date', $d)
        ->where('orders.campuse_id', $c)
        ->get();

    $donations = DB::table('orders')
        ->where('orders.user_id', 0)
        ->where('orders.meal_id', '!=', 0)
        ->where('orders.date', $d)
        ->join('meals', 'orders.id', 'meals.order_id')
        ->where('meals.claimed', 0)
        ->get();
    return response(json_encode([$requests, $donations]))
        ->header('Content-Type', 'text/plain');
});
