<?php

use App\Http\Controllers\CityController;
use App\Http\Controllers\LogoutController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NotfoundController;
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

Route::get('/home', function () {
    return view('home');
})->name('home')->middleware('auth');

Route::get('/', function () {
    return view('home');
})->name('home')->middleware('auth');


// ################################# City ########################################
Route::get('/cities', [CityController::class, 'index'])->name('city.index')->middleware('auth');
Route::get('/cities/create', [CityController::class, 'create'])->name('city.create')->middleware('auth')->middleware('logs-out-banned-user')->middleware('role:admin');
Route::post('/cities', [CityController::class, 'store'])->name('city.store');
Route::get('/cities/{city}', [CityController::class, 'show'])->name('city.show');
Route::get('/cities/{city}/edit', [CityController::class, 'edit'])->name('city.edit');
Route::put('/cities/{city}', [CityController::class, 'update'])->name('city.update');
Route::delete('/cities/{city}', [CityController::class, 'destroy'])->name('city.destroy');



// ################################# Auth ########################################
Auth::routes();
Route::get('/register', [NotfoundController::class, 'unAuth'])->name('500')->middleware('auth');
Route::get('/logout', [LogoutController::class, 'logout'])->name('logout')->middleware('auth');
Route::get('/users', [UserController::class, 'index'])->name('users.index')->middleware('auth');;
// #########################################################################

// ######################################Packages###########################################
Route::get('/trainingPackeges/index', [TrainingPackagesController::class, 'index'])->name('trainingPackeges.listPackeges')->middleware('auth')->middleware('logs-out-banned-user')->middleware('role:admin|cityManager|gymManager');
Route::get('/trainingPackeges/create_package', [TrainingPackagesController::class, 'create'])->name('trainingPackeges.creatPackege')->middleware('auth')->middleware('logs-out-banned-user')->middleware('role:admin');
Route::post('/trainingPackeges/package', [TrainingPackagesController::class, 'store'])->name('trainingPackeges.store')->middleware('auth')->middleware('logs-out-banned-user')->middleware('role:admin');
Route::get('/trainingPackeges/package/{session}', [TrainingPackagesController::class, 'show'])->name('trainingPackeges.show_training_package')->middleware('auth')->middleware('logs-out-banned-user')->middleware('role:admin');
Route::get('/trainingPackeges/{package}/edit', [TrainingPackagesController::class, 'edit'])->name('trainingPackeges.editPackege')->middleware('auth')->middleware('logs-out-banned-user')->middleware('role:admin');
Route::delete('/trainingPackeges/{package}  ', [TrainingPackagesController::class, 'deletePackage'])->name('trainingPackeges.delete_package')->middleware('auth')->middleware('logs-out-banned-user')->middleware('role:admin');
Route::put('/trainingPackeges/{package}', [TrainingPackagesController::class, 'update'])->name('trainingPackeges.update_package')->middleware('auth')->middleware('logs-out-banned-user')->middleware('role:admin');
