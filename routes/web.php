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
