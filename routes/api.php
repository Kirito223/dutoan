<?php

use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\LocationController;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

# Location Route

Route::get('commune/{district}', [LocationController::class, "communeList"]);
Route::get('district/{province}', [LocationController::class, "districtList"]);
Route::get('province', [LocationController::class, "provinceList"]);


# Department Route
Route::get('/department/all', [DepartmentController::class, 'all']);
Route::post('/department/store', [DepartmentController::class, 'store']);
Route::put('/department/update/{id}', [DepartmentController::class, 'update']);
Route::delete('/department/destroy/{id}', [DepartmentController::class, 'destroy']);
