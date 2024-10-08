<?php

use App\Http\Controllers\MedicalInvestigationController;
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
    //User Routes
    Route::get('/user', [UserController::class, 'getUser']);
    Route::post('/logout', [AuthController::class, 'logOut']);
    Route::post('/{id}/save-personal-data', [UserController::class, 'savePersonalData']);
    Route::post('{id}/update-user-address-info', [UserController::class, 'updateAddressInfo']);
    Route::get('/get-user-insurance-info/{lang}', [UserController::class, 'getUserInsuranceInfo']);
    Route::post('/save-user-insurance-info', [UserController::class, 'saveUserInsuranceInfo']);
    Route::post('/user-upload-avatar', [UserController::class, 'uploadAvatar']);
    Route::get('/user-occupation-info/{lang}', [UserController::class, 'getUserOccupationInformation']);
    Route::get('/user-occupation-options/{lang}', [UserController::class, 'getUserOccupationOptions']);
    Route::get('/education-level-options/{lang}', [UserController::class, 'getEducationLevelOptions']);
    Route::post('/user-occupation-info/', [UserController::class, 'saveUserOccupationInformation']);
    Route::get('/get-user-options', [UserController::class, 'getUserOptions']);

    //Medical Insurance Category
    Route::get('/medical-insurance-category/all/{lang}', [MedicalInsuranceController::class, 'getAllMedicalInsuranceCategoryOptions']);
    Route::get('/ensure/all', [MedicalInsuranceController::class, 'getAllEnsureOptions']);

    //Medical Investigation Routes
    Route::get('/medical-investigation/{id}', [MedicalInvestigationController::class, 'getMedicalInvestigation']);
    Route::post('/medical-investigation/saveInterpretation', [MedicalInvestigationController::class, 'saveInterpretation']);
    Route::get('/user-medical-history', [MedicalInvestigationController::class, 'getUserMedicalHistory']);
    Route::get('/medical-investigation-types', [MedicalInvestigationController::class, 'getMedicalInvestigationsTypes']);
    Route::get('/medical-investigations', [MedicalInvestigationController::class, 'getMedicalInvestigations']);
    Route::post('/medical-investigation/save-x-ray-investigation', [MedicalInvestigationController::class, 'saveMedicalInvestigation']);
    Route::get('/get-blood-investigation-options', [MedicalInvestigationController::class, 'getBloodInvestigationOptions']);
    Route::post('/medical-investigation/save-blood-investigation', [MedicalInvestigationController::class, 'saveBloodInvestigation']);
});

/** Public Routes */
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/test', function () {
    \Illuminate\Support\Facades\Log::info('test log');
    return 'success';
});
