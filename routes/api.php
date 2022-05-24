<?php

use App\Http\Controllers\AssistanceController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\FactorController;
use App\Http\Controllers\MembershipController;
use App\Http\Controllers\PaymentController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserTokenController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


/* Route::get('/hash_pass/{pass}', function ($pass) {
    return response()->json(['password' => $pass, "Hashed" => password_hash($pass, PASSWORD_DEFAULT)]);
}); */

Route::apiResource('companies', CompanyController::class);
Route::apiResource('assistances', AssistanceController::class);
Route::apiResource('branches', BranchController::class);

Route::get('branch/customers', [CustomerController::class, 'getCustomersOfBranch']);//
Route::apiResource('customers', CustomerController::class);
Route::apiResource('memberships', MembershipController::class);
Route::apiResource('payments', PaymentController::class);

Route::post('sanctum/token', UserTokenController::class);

///Devuelve factores y escenarios de usuario autenticado

Route::middleware(['auth:sanctum'])->group(function () {
    Route::any('{any}', function () {
        abort(404);
    })->where('any', '.*');
});
