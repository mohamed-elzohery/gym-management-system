<?php

use App\Http\Controllers\StripeController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\LogoutController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NotfoundController;
use App\Http\Controllers\TrainingPackagesController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\GymController;
use App\Http\Controllers\TrainingController;

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
Route::get('/lol',function(){
return "Hi";
});



// ################################# City ########################################
Route::get('/cities', [CityController::class, 'list'])->name('city.list')->middleware('auth')->middleware('logs-out-banned-user')->middleware('role:admin');
Route::get('/cities/create', [CityController::class, 'create'])->name('city.create')->middleware('auth')->middleware('logs-out-banned-user')->middleware('role:admin');
Route::post('/cities', [CityController::class, 'store'])->name('city.store')->middleware('auth')->middleware('logs-out-banned-user')->middleware('role:admin');
Route::get('/cities/{cityID}', [CityController::class, 'show'])->name('city.show')->middleware('auth')->middleware('logs-out-banned-user')->middleware('role:admin');
Route::get('/cities/{cityID}/edit', [CityController::class, 'edit'])->name('city.edit')->middleware('auth')->middleware('logs-out-banned-user')->middleware('role:admin');
Route::put('/cities/{cityID}', [CityController::class, 'update'])->name('city.update')->middleware('auth')->middleware('logs-out-banned-user')->middleware('role:admin');
Route::delete('/cities/{cityID}', [CityController::class, 'destroy'])->name('city.destroy')->middleware('auth')->middleware('logs-out-banned-user')->middleware('role:admin');
Route::get('/restoredCities', [CityController::class, 'showDeleted'])->name('city.showDeleted')->middleware('auth')->middleware('role:admin');
Route::get('/restoredCities/{postID}', [CityController::class, 'restore'])->name('city.restored')->middleware('auth')->middleware('role:admin');


#=======================================================================================#
#			                           City Managers Routes                          	#
#=======================================================================================#
Route::controller(CityManagerController::class)->group(function () {
    Route::get('/cityManager/create', 'create')->name('cityManager.create')->middleware('auth')->middleware('logs-out-banned-user')->middleware('role:admin');
    Route::post('/cityManager/store', 'store')->name('cityManager.store')->middleware('auth')->middleware('logs-out-banned-user')->middleware('role:admin');
    Route::get('/cityManager/list', 'list')->name('cityManager.list')->middleware('auth')->middleware('logs-out-banned-user')->middleware('role:admin');
    Route::get('/cityManager/edit/{id}', 'edit')->name('cityManager.edit')->middleware('auth')->middleware('logs-out-banned-user')->middleware('role:admin');
    Route::put('/cityManager/update/{id}', 'update')->name('cityManager.update')->middleware('auth')->middleware('logs-out-banned-user')->middleware('role:admin');
    Route::delete('/cityManager/{id}', 'deletecityManager')->name('cityManager.delete')->middleware('auth')->middleware('logs-out-banned-user')->middleware('role:admin');
    Route::get('/cityManager/show/{id}', 'show')->name('cityManager.show')->middleware('auth')->middleware('logs-out-banned-user')->middleware('role:admin');
});

// ################################# Auth ##################################################
Auth::routes();
Route::get('/register', [NotfoundController::class, 'unAuth'])->name('500')->middleware('auth');
Route::get('/logout', [LogoutController::class, 'logout'])->name('logout')->middleware('auth');
Route::get('/users', [UserController::class, 'index'])->name('users.index')->middleware('auth');;
// #########################################################################################

// ############################## Payment ##################################################
Route::get('/PaymentPackage/stripe/{package}', [StripeController::class, 'stripe'])->name('PaymentPackage.stripe')->middleware('auth')->middleware('logs-out-banned-user')->middleware('role:admin|cityManager|gymManager|coach');
Route::post('/PaymentPackage/stripe', [StripeController::class, 'stripePost'])->name('stripe.post')->middleware('auth')->middleware('logs-out-banned-user')->middleware('role:admin|cityManager|gymManager|coach');
Route::get('/PaymentPackage/purchase_history', [StripeController::class, 'index'])->name('PaymentPackage.purchase_history')->middleware('auth')->middleware('logs-out-banned-user')->middleware('role:admin|cityManager|gymManager|coach');
Route::get('/', [WelcomeController::class, 'index'])->name('welcome')->middleware('auth')->middleware('logs-out-banned-user')->middleware('role:admin|cityManager|gymManager|coach');

// ######################################Packages###########################################
Route::get('/trainingPackeges/index', [TrainingPackagesController::class, 'index'])->name('trainingPackeges.listPackeges')->middleware('auth')->middleware('logs-out-banned-user')->middleware('role:admin|cityManager|gymManager');
Route::get('/trainingPackeges/create_package', [TrainingPackagesController::class, 'create'])->name('trainingPackeges.creatPackege')->middleware('auth')->middleware('logs-out-banned-user')->middleware('role:admin');
Route::post('/trainingPackeges/package', [TrainingPackagesController::class, 'store'])->name('trainingPackeges.store')->middleware('auth')->middleware('logs-out-banned-user')->middleware('role:admin');
Route::get('/trainingPackeges/package/{session}', [TrainingPackagesController::class, 'show'])->name('trainingPackeges.show_training_package')->middleware('auth')->middleware('logs-out-banned-user')->middleware('role:admin');
Route::get('/trainingPackeges/{package}/edit', [TrainingPackagesController::class, 'edit'])->name('trainingPackeges.editPackege')->middleware('auth')->middleware('logs-out-banned-user')->middleware('role:admin');
Route::delete('/trainingPackeges/{package}  ', [TrainingPackagesController::class, 'deletePackage'])->name('trainingPackeges.delete_package')->middleware('auth')->middleware('logs-out-banned-user')->middleware('role:admin');
Route::put('/trainingPackeges/{package}', [TrainingPackagesController::class, 'update'])->name('trainingPackeges.update_package')->middleware('auth')->middleware('logs-out-banned-user')->middleware('role:admin');

// ###################################### SESSIONS ####################################
Route::get('/TrainingSessions/index', [TrainingController::class, 'index'])->name('TrainingSessions.listSessions')->middleware('auth')->middleware('logs-out-banned-user')->middleware('role:admin|cityManager|gymManager');
Route::get('/TrainingSessions/create_session', [TrainingController::class, 'create'])->name('TrainingSessions.training_session')->middleware('auth')->middleware('logs-out-banned-user')->middleware('role:admin|cityManager|gymManager');
Route::post('/TrainingSessions/sessions', [TrainingController::class, 'store'])->name('TrainingSessions.store')->middleware('auth')->middleware('logs-out-banned-user')->middleware('role:admin|cityManager|gymManager');
Route::get('/TrainingSessions/sessions/{session}', [TrainingController::class, 'show'])->name('TrainingSessions.show_training_session')->middleware('auth')->middleware('logs-out-banned-user')->middleware('role:admin|cityManager|gymManager');
Route::get('/TrainingSessions/{session}/edit', [TrainingController::class, 'edit'])->name('TrainingSessions.edit_training_session')->middleware('auth')->middleware('logs-out-banned-user')->middleware('role:admin|cityManager|gymManager');
Route::delete('/TrainingSessions/{session}  ', [TrainingController::class, 'deleteSession'])->name('TrainingSessions.delete_session')->middleware('auth')->middleware('logs-out-banned-user')->middleware('role:admin|cityManager|gymManager');
Route::put('/TrainingSessions/{session}', [TrainingController::class, 'update'])->name('TrainingSessions.update_session')->middleware('auth')->middleware('logs-out-banned-user')->middleware('role:admin|cityManager|gymManager');

#=======================================================================================#
#			                        Gym Controller Routes                              	#
#=======================================================================================#
Route::controller(GymController::class)->group(function () {
    Route::get('/gym/create', 'create')->name('gym.create')->middleware('auth');
    Route::post('/gym/store', 'store')->name('gym.store')->middleware('auth');
    Route::get('/gym/edit/{gym}', 'edit')->name('gym.edit')->middleware('auth');
    Route::put('/gym/update/{gym}', 'update')->name('gym.update')->middleware('auth');
    Route::delete('/gym/{id}', 'deleteGym')->name('gym.delete')->middleware('auth');
    Route::get('/gym/list', 'list')->name('gym.list')->middleware('auth');
    Route::get('/gym/show/{id}', 'show')->name('gym.show')->middleware('auth');
});

Route::get('/gym/training', function () {
    return view('gym.training_session')->name('gym.session');
})->middleware('auth')->middleware('logs-out-banned-user')->middleware('role:admin|cityManager|gymManager');

#=======================================================================================#
#                                   Ban users                                           #
#=======================================================================================#
Route::get('/banUser/{userID}',[UserController::class,'banUser'])->name('user.banUser')->middleware('auth')->middleware('logs-out-banned-user')->middleware('role:admin|cityManager|gymManager');
Route::get('/listBanned',[UserController::class,'listBanned'])->name('user.listBanned')->middleware('auth')->middleware('logs-out-banned-user')->middleware('role:admin|cityManager|gymManager');
Route::PATCH('/banUser/{userID}',[UserController::class,'unban'])->name('user.unban')->middleware('auth')->middleware('logs-out-banned-user')->middleware('role:admin|cityManager|gymManager');