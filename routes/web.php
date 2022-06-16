<?php

use App\Http\Controllers\AssistanceController;
use App\Http\Controllers\CustomerController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FactorController;
use App\Http\Controllers\MembershipController;
use App\Http\Controllers\PaymentController;
use App\Mail\TestingMail;
use Illuminate\Support\Facades\Mail;

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


Route::get('/send_mail', function () { //test function only
    try {
        Mail::to('heriberto.h@gercanada.com')->send(new TestingMail());
        return "Sent";
    } catch (Exception $e) {
        return $e->getMessage();
    }
});


Auth::routes();

if (env('APP_ENV') === 'local') {
    Route::get('/tempdata', [FactorController::class, 'dataFile']); //returns a json response
    Route::get('/factors-table/{subfactor}', [FactorController::class, 'factorsTable']); //returns ajson response
    Route::get('/factor/{subFactor}', [FactorController::class, 'getFactor']);
    Route::get('/subfactors', [FactorController::class, 'listSubfactors']); //List subfactors for create seeders
}

/*data for views*/
Route::get('/factors', [FactorController::class, 'factors']);

Route::middleware(['auth'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    //user
    Route::get('/profile',  [UserController::class, 'profile'])->name('profile');
    Route::get('/account',  [UserController::class, 'account']);
    Route::post('/account', [UserController::class, 'update']);
    Route::post('/new_password', [UserController::class, 'newPassword']);
    //User themme
    Route::get('/user_themme',  [UserController::class, 'getThemme']);
    Route::post('/user_themme', [UserController::class, 'setThemme']);
    // Route::get('/user_themme', [UserController::class, 'changeThemme']);

    //Customers
    // Route::get('customers',  [CustomerController::class, 'view']);
    Route::get('customers',  [CustomerController::class, 'index']);
    Route::get('customers-select',  [CustomerController::class, 'select']);
    Route::post('customers/store',  [CustomerController::class, 'store']);
    Route::put('customers/update',  [CustomerController::class, 'update']);
    Route::post('customers/{id}/delete',  [CustomerController::class, 'destroy']);

    Route::get('memberships',  [MembershipController::class, 'index']);
    Route::get('select-memberships',  [MembershipController::class, 'select']);
    Route::post('memberships',  [MembershipController::class, 'store']);
    Route::post('memberships/{id}/delete',  [MembershipController::class, 'destroy']);

    Route::get('payments',  [PaymentController::class, 'index']);
    Route::post('payments',  [PaymentController::class, 'store']);
    Route::post('payments/{id}/delete',  [PaymentController::class, 'destroy']);

    Route::get('assistances',  [AssistanceController::class, 'index']);
    Route::post('assistances',  [AssistanceController::class, 'store']);
    Route::post('assistances/{id}/delete',  [AssistanceController::class, 'destroy']);

    Route::any('{any}', function () {
        abort(404);
    })->where('any', '.*');
});
