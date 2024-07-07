<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\MedicalInsuranceController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

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

/** Private Routes */
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/user', [UserController::class, 'getUser']);
    Route::post('/logout', [AuthController::class, 'logOut']);
    Route::post('/{id}/save-personal-data', [UserController::class, 'savePersonalData']);
    Route::post('{id}/update-user-address-info', [UserController::class, 'updateAddressInfo']);
    Route::get('/get-user-insurance-info', [UserController::class, 'getUserInsuranceInfo']);
    Route::post('/save-user-insurance-info', [UserController::class, 'saveUserInsuranceInfo']);
    Route::post('/user-upload-avatar', [UserController::class, 'uploadAvatar']);

    //Medical Insurance Category
    Route::get('/medical-insurance-category/all', [MedicalInsuranceController::class, 'getAllMedicalInsuranceCategoryOptions']);
    Route::get('/ensure/all', [MedicalInsuranceController::class, 'getAllEnsureOptions']);
});

/** Public Routes */
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/test', function () {
    \Illuminate\Support\Facades\Log::info('test log');
    return 'success';
});
