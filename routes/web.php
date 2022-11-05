<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

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


Route::get('/users', [UserController::class, 'index']);

Auth::routes();

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
Route::get('/profilePage', [App\Http\Controllers\UserController::class, 'profilePage']);
