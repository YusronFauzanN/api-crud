<?php

use App\Http\Controllers\api\CampBenefitController;
use App\Http\Controllers\api\CampController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
// Camp
Route::get('/camp', [CampController::class, 'show'])->name('camp.show');
Route::post('/camp', [CampController::class, 'store'])->name('camp.store');

// Camp Benefit
Route::get('/camp-benefit', [CampBenefitController::class, 'show'])->name('camp-benefit.show');
Route::post('/camp-benefit', [CampBenefitController::class, 'store'])->name('camp-benefit.store');