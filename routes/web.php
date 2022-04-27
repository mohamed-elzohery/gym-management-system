<?php

use App\Http\Controllers\LogoutController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NotfoundController;


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

Route::get('/home', function () {
    return view('welcome');
})->name('home')->middleware('auth');

Route::get('/city', function () {
    return view('city.city');
})->name('city')->middleware('auth');

Auth::routes();
Route::get('/register', [NotfoundController::class, 'unAuth'])->name('500');
Route::get('/logout', [LogoutController::class, 'logout'])->name('logout');
