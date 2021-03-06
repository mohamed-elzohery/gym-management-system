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
use App\Http\Controllers\GymManagerController;
use App\Http\Controllers\TrainingController;
use App\Http\Controllers\CoachController;
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
Route::get('/lol', function () {
    return "Hi";
});

Auth::routes();

//##################################coach########################################
Route::controller(CoachController::class)->group(function () {
    Route::get('/coach/create', 'create')->name('coach.create')->middleware('auth')->middleware('logs-out-banned-user')->middleware('role:admin|cityManager|gymManager');
    Route::post('/coach/store', 'store')->name('coach.store')->middleware('auth')->middleware('logs-out-banned-user')->middleware('role:admin|cityManager|gymManager');
    Route::get('/coach/edit/{coach}', 'edit')->name('coach.edit')->middleware('auth')->middleware('logs-out-banned-user')->middleware('role:admin|cityManager|gymManager');
    Route::put('/coach/update/{coach}', 'update')->name('coach.update')->middleware('auth')->middleware('logs-out-banned-user')->middleware('role:admin|cityManager|gymManager');
    Route::delete('/coach/{id}', 'deleteCoach')->name('coach.delete')->middleware('auth')->middleware('logs-out-banned-user')->middleware('role:admin|cityManager|gymManager');
    Route::get('/coach/list', 'list')->name('coach.list')->middleware('auth')->middleware('logs-out-banned-user')->middleware('role:admin|cityManager|gymManager');
    Route::get('/coach/show/{coach}', 'show')->name('coach.show')->middleware('auth')->middleware('logs-out-banned-user')->middleware('role:admin|cityManager|gymManager');
});
// ################################# City ########################################

Route::group(['middleware' => ['auth', 'logs-out-banned-user', 'role:admin|cityManager|gymManager']], function () {
    Route::prefix('/cities')->group(function () {
        Route::get('/', [CityController::class, 'index'])->name('cities.index');
    });
    Route::group(['prefix' => '/city-managers', 'middleware' => ['role:admin']], function () {
        Route::get('/', [CityManagerController::class, 'index'])->name('city-managers.index');
        Route::get('/create', [CityManagerController::class, 'create'])->name('city-managers.create');
        Route::get('/{id}', [CityManagerController::class, 'show'])->name('city-managers.show');
        Route::get('/{id}/edit', [CityManagerController::class, 'edit'])->name('city-managers.edit');
    });
});

// ################################# Auth ##################################################
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
    Route::get('/gym/create', 'create')->name('gym.create')->middleware('auth')->middleware('logs-out-banned-user')->middleware('role:admin|cityManager');
    Route::post('/gym/store', 'store')->name('gym.store')->middleware('auth')->middleware('logs-out-banned-user')->middleware('role:admin|cityManager');
    Route::get('/gym/edit/{gym}', 'edit')->name('gym.edit')->middleware('auth')->middleware('logs-out-banned-user')->middleware('role:admin|cityManager');
    Route::put('/gym/update/{gym}', 'update')->name('gym.update')->middleware('auth')->middleware('logs-out-banned-user')->middleware('role:admin|cityManager');
    Route::delete('/gym/{id}', 'deleteGym')->name('gym.delete')->middleware('auth')->middleware('logs-out-banned-user')->middleware('role:admin|cityManager');
    Route::get('/gym/list', 'list')->name('gym.list')->middleware('auth')->middleware('logs-out-banned-user')->middleware('role:admin|cityManager');
    Route::get('/gym/show/{id}', 'show')->name('gym.show')->middleware('auth')->middleware('logs-out-banned-user')->middleware('role:admin|cityManager');
});

Route::get('/gym/training', function () {
    return view('gym.training_session')->name('gym.session');
})->middleware('auth')->middleware('logs-out-banned-user')->middleware('role:admin|cityManager|gymManager');

#=======================================================================================#
#			                           Gym Managers Routes                          	#
#=======================================================================================#
Route::controller(GymManagerController::class)->group(function () {
    Route::get('/gymManager/create', 'create')->name('gymManager.create')->middleware('auth')->middleware('logs-out-banned-user')->middleware('role:admin|cityManager');
    Route::post('/gymManager/store', 'store')->name('gymManager.store')->middleware('auth')->middleware('logs-out-banned-user')->middleware('role:admin|cityManager');
    Route::get('/gymManager/list', 'list')->name('gymManager.list')->middleware('auth')->middleware('logs-out-banned-user')->middleware('role:admin|cityManager');
    Route::get('/gymManager/edit/{gym}', 'edit')->name('gymManager.edit')->middleware('auth')->middleware('logs-out-banned-user')->middleware('role:admin|cityManager');
    Route::put('/gymManager/update/{gym}', 'update')->name('gymManager.update')->middleware('auth')->middleware('logs-out-banned-user')->middleware('role:admin|cityManager');
    Route::delete('/gymManager/{id}', 'deletegymManager')->name('gymManager.delete')->middleware('auth')->middleware('logs-out-banned-user')->middleware('role:admin|cityManager');
    Route::get('/gymManager/show/{id}', 'show')->name('gymManager.show')->middleware('auth')->middleware('logs-out-banned-user')->middleware('role:admin|cityManager');
});
#=======================================================================================#
#
#                                   Ban users                                           #
#=======================================================================================#
Route::get('/banUser/{userID}', [UserController::class, 'banUser'])->name('user.banUser')->middleware('auth')->middleware('logs-out-banned-user')->middleware('role:admin|cityManager|gymManager');
Route::get('/listBanned', [UserController::class, 'listBanned'])->name('user.listBanned')->middleware('auth')->middleware('logs-out-banned-user')->middleware('role:admin|cityManager|gymManager');
Route::PATCH('/banUser/{userID}', [UserController::class, 'unban'])->name('user.unban')->middleware('auth')->middleware('logs-out-banned-user')->middleware('role:admin|cityManager|gymManager');
