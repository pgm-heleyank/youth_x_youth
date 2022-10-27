<?php

use App\Models\Allergen;
use Illuminate\Http\Request;
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

// API for allergens search via: /api/allergens/{search term}
Route::get('/allergens/{q}', function ($q) {
    $allergens = Allergen::select('id', 'name')->where('name', 'LIKE', '%' . $q . '%')->where('pinned', '!=', 1)->get();
    return response(json_encode($allergens))
        ->header('Content-Type', 'text/plain');
});
