<?php

use App\Http\Controllers\AssistanceController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\CustomerController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FactorController;
use App\Http\Controllers\MembershipController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\SaleController;
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

    Route::prefix('users')->group(function () {
        Route::get('/', [UserController::class, 'index']);
        Route::post('/', [UserController::class, 'newUser']);
        Route::post('/{user}', [UserController::class, 'updateUser']);
        Route::delete('/{user}', [UserController::class, 'destroy']);
    });

    //Customers
    Route::prefix('customers')->group(function () {
        Route::get('select',  [CustomerController::class, 'select']);
        Route::post('/',  [CustomerController::class, 'store']);
        Route::post('/',  [CustomerController::class, 'update']);
        Route::get('/',  [CustomerController::class, 'index']);
        Route::prefix('/{customer}')->group(function () {
            Route::delete('/',  [CustomerController::class, 'destroy']);
            Route::get('/',  [CustomerController::class, 'show']);
            Route::get('payments',  [PaymentController::class, 'customerPayments']);
            Route::get('assistances',  [AssistanceController::class, 'customerAsistances']);
        });
    });

    Route::prefix('memberships')->group(function () {
        Route::get('select',  [MembershipController::class, 'select']);
        Route::get('/',  [MembershipController::class, 'index']);
        Route::post('/',  [MembershipController::class, 'store']);
        Route::post('/{id}',  [MembershipController::class, 'update']);
        Route::delete('/{id}',  [MembershipController::class, 'destroy']);
    });

    Route::get('select-branches',  [BranchController::class, 'select']);

    Route::prefix('payments')->group(function () {
        Route::get('/',  [PaymentController::class, 'index']);
        Route::post('/',  [PaymentController::class, 'store']);
        Route::post('/{payment}',  [PaymentController::class, 'updateUser']);
        Route::delete('/{id}',  [PaymentController::class, 'destroy']);
    });


    Route::prefix('assistances')->group(function () {
        Route::get('/',  [AssistanceController::class, 'index']);
        Route::post('/',  [AssistanceController::class, 'store']);
        Route::delete('/{id}/delete',  [AssistanceController::class, 'destroy']);
    });
    Route::prefix('sales')->group(function () {
        Route::get('/', [SaleController::class, 'index']);
        Route::post('/', [SaleController::class, 'store']);
        Route::post('/{id}', [SaleController::class, 'update']);
        Route::delete('/{id}', [SaleController::class, 'delete']);
    });
    Route::prefix('purchases')->group(function () {
        Route::get('/', [PurchaseController::class, 'index']);
        Route::post('/', [PurchaseController::class, 'store']);
        Route::post('/{id}', [PurchaseController::class, 'update']);
        Route::delete('/{id}', [PurchaseController::class, 'delete']);
    });

    Route::prefix('products')->group(function () {
        Route::get('/', [ProductController::class, 'index']);
        Route::post('/', [ProductController::class, 'store']);
        Route::post('/{id}', [ProductController::class, 'update']);
        Route::get('/select', [ProductController::class, 'select']);
        Route::delete('/{id}', [ProductController::class, 'destroy']);
    });


    Route::any('{any}', function () {
        abort(404);
    })->where('any', '.*');
});
