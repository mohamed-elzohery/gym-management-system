<?php

use App\Http\Controllers\CityController;
use App\Http\Controllers\LogoutController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NotfoundController;
use App\Http\Controllers\TrainingPackagesController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WelcomeController;


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

Route::get('/', [WelcomeController::class, 'index'])->name('welcome')->middleware('auth');


// ################################# City ########################################
Route::get('/cities', [CityController::class, 'list'])->name('city.list')->middleware('auth')->middleware('logs-out-banned-user')->middleware('role:admin');

//GET, 	/city/create, 	create, 	city.create
Route::get('/cities/create', [CityController::class, 'create'])->name('city.create')->middleware('auth')->middleware('logs-out-banned-user')->middleware('role:admin');
//POST, 	/city, 	store,       	city.store
Route::post('/cities', [CityController::class, 'store'])->name('city.store')->middleware('auth')->middleware('logs-out-banned-user')->middleware('role:admin');

//GET, 	/city/{photo}, 	show,    	city.show
Route::get('/cities/{cityID}', [CityController::class, 'show'])->name('city.show')->middleware('auth')->middleware('logs-out-banned-user')->middleware('role:admin');

//GET 	/city/{cityID}/edit 	edit 	city.edit
Route::get('/cities/{cityID}/edit', [CityController::class, 'edit'])->name('city.edit')->middleware('auth')->middleware('logs-out-banned-user')->middleware('role:admin');
//PUT/PATCH, 	/city/{cityID}, 	update, 	city.update
Route::put('/cities/{cityID}', [CityController::class, 'update'])->name('city.update')->middleware('auth')->middleware('logs-out-banned-user')->middleware('role:admin');

//DELETE 	/city/{cityID} 	destroy 	city.destroy
Route::delete('/cities/{cityID}', [CityController::class, 'destroy'])->name('city.destroy')->middleware('auth')->middleware('logs-out-banned-user')->middleware('role:admin');
Route::get('/restoredCities', [CityController::class, 'showDeleted'])->name('city.showDeleted')->middleware('auth')->middleware('role:admin');
Route::get('/restoredCities/{postID}', [CityController::class, 'restore'])->name('city.restored')->middleware('auth')->middleware('role:admin');



// ################################# Auth ########################################
Auth::routes();
#=======================================================================================#
#			                          Admin Routes                                  	#
#=======================================================================================#
Route::group(['middleware' => ['auth', 'logs-out-banned-user']], function () {
    Route::get('/user/show-profile', [UserController::class, 'show_profile'])->name('user.admin_profile')->middleware('logs-out-banned-user')->middleware('role:admin');
    Route::get('/user/edit-profile', [UserController::class, 'edit_profile'])->name('user.edit_admin_profile')->middleware('logs-out-banned-user')->middleware('role:admin');
    Route::get('/gym/training_session', [TrainingController::class, 'create'])->name('gym.training_session')->middleware('logs-out-banned-user')->middleware('role:admin');
});


// ######################################Packages###########################################
Route::get('/trainingPackeges/index', [TrainingPackagesController::class, 'index'])->name('trainingPackeges.listPackeges')->middleware('auth')->middleware('logs-out-banned-user')->middleware('role:admin|cityManager|gymManager');
Route::get('/trainingPackeges/create_package', [TrainingPackagesController::class, 'create'])->name('trainingPackeges.creatPackege')->middleware('auth')->middleware('logs-out-banned-user')->middleware('role:admin');
Route::post('/trainingPackeges/package', [TrainingPackagesController::class, 'store'])->name('trainingPackeges.store')->middleware('auth')->middleware('logs-out-banned-user')->middleware('role:admin');
Route::get('/trainingPackeges/package/{id}', [TrainingPackagesController::class, 'show'])->name('trainingPackeges.show_training_package')->middleware('auth')->middleware('logs-out-banned-user')->middleware('role:admin');
Route::get('/trainingPackeges/{package}/edit', [TrainingPackagesController::class, 'edit'])->name('trainingPackeges.editPackege')->middleware('auth')->middleware('logs-out-banned-user')->middleware('role:admin');
Route::delete('/trainingPackeges/{package}  ', [TrainingPackagesController::class, 'deletePackage'])->name('trainingPackeges.delete_package')->middleware('auth')->middleware('logs-out-banned-user')->middleware('role:admin');
Route::put('/trainingPackeges/{package}', [TrainingPackagesController::class, 'update'])->name('trainingPackeges.update_package')->middleware('auth')->middleware('logs-out-banned-user')->middleware('role:admin');
