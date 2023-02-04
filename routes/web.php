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

Auth::routes();

// Route::middleware('auth')->group(function () {
Route::get('/', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth');
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
    Route::post('/{user}/delete', [UserController::class, 'destroy']);
});

//Customers
Route::prefix('customers')->group(function () {
    Route::post('export-csv',  [CustomerController::class, 'exportCSV']);

    Route::get('/select',  [CustomerController::class, 'select']);
    Route::get('/',  [CustomerController::class, 'index']);
    Route::post('upload-file',  [CustomerController::class, 'uploadFile']);
    Route::get('/{customer}',  [CustomerController::class, 'show']);
    Route::post('/create',  [CustomerController::class, 'store']);
    Route::post('/update/{customer}',  [CustomerController::class, 'update']);
    Route::post('/delete/{customer}',  [CustomerController::class, 'destroy']);
    Route::get('/{customer}/payments',  [PaymentController::class, 'customerPayments']);
    Route::get('/{customer}/assistances',  [AssistanceController::class, 'customerAsistances']);

    // Route::prefix('/{customer}')->group(function () {
    // });
});

Route::prefix('memberships')->group(function () {
    Route::get('select',  [MembershipController::class, 'select']);
    Route::get('/',  [MembershipController::class, 'index']);
    Route::post('/',  [MembershipController::class, 'store']);
    Route::post('/{id}',  [MembershipController::class, 'update']);
    Route::post('/{id}/delete',  [MembershipController::class, 'destroy']);
});



Route::prefix('payments')->group(function () {
    Route::get('/',  [PaymentController::class, 'index']);
    Route::post('/create',  [PaymentController::class, 'store']);
    Route::post('/update/{id}',  [PaymentController::class, 'update']);
    Route::post('/delete/{id}',  [PaymentController::class, 'destroy']);
});


Route::prefix('assistances')->group(function () {
    Route::get('/',  [AssistanceController::class, 'index']);
    Route::post('/',  [AssistanceController::class, 'store']);
    Route::post('/{id}/delete',  [AssistanceController::class, 'destroy']);
});
Route::prefix('sales')->group(function () {
    Route::get('/', [SaleController::class, 'index']);
    Route::post('/create', [SaleController::class, 'store']);
    Route::post('update/{id}', [SaleController::class, 'update']);
    Route::post('delete/{id}', [SaleController::class, 'delete']);
});
Route::prefix('purchases')->group(function () {
    Route::get('/', [PurchaseController::class, 'index']);
    Route::post('create', [PurchaseController::class, 'store']);
    Route::post('update/{id}', [PurchaseController::class, 'update']);
    Route::post('delete/{id}', [PurchaseController::class, 'delete']);
});

Route::prefix('products')->group(function () {
    Route::get('/', [ProductController::class, 'index']);
    Route::post('/', [ProductController::class, 'store']);
    Route::post('/{id}', [ProductController::class, 'update']);
    Route::get('/select', [ProductController::class, 'select']);
    Route::post('/{id}/delete', [ProductController::class, 'destroy']);
});

// Route::get('select-branches',  [BranchController::class, 'select']);
Route::prefix('branches')->group(function () {
    Route::get('/', [BranchController::class, 'index']);
    Route::post('/', [BranchController::class, 'store']);
    Route::post('/{id}', [BranchController::class, 'update']);
    Route::get('/select', [BranchController::class, 'select']);
    Route::post('/{id}/delete', [BranchController::class, 'destroy']);
    Route::get('/select',  [BranchController::class, 'select']);
});


Route::any('{any}', function () {
    abort(404);
})->where('any', '.*');
// });
