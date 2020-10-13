<?php

use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\EvaluationCriterionController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\NoticeController;
use App\Http\Controllers\TemplateController;
use App\Http\Controllers\UnitController;
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

// Route::group(['middleware' => 'auth'], function () {
// });
# Login
Route::post('/login', [LoginController::class, "login"]);
Route::get('/logout', [LoginController::class, "logout"]);
Route::get('/resetPassword', [LoginController::class, "resetPassword"]);

# Location Route

Route::get('commune/{district}', [LocationController::class, "communeList"]);
Route::get('district/{province}', [LocationController::class, "districtList"]);
Route::get('province', [LocationController::class, "provinceList"]);


# Department Route
Route::get('/department/all', [DepartmentController::class, 'all']);
Route::get('/department/getAccount/{id}', [DepartmentController::class, 'getInfoAccount']);
Route::post('/department/store', [DepartmentController::class, 'store']);
Route::post('/department/changePassword', [DepartmentController::class, 'changePassword']);
Route::put('/department/update/{id}', [DepartmentController::class, 'update']);
Route::delete('/department/destroy/{id}', [DepartmentController::class, 'destroy']);

# Notice
Route::get('/notice/all', [NoticeController::class, 'all']);
Route::post('/notice/store', [NoticeController::class, 'store']);
Route::post('/notice/update/{id}', [NoticeController::class, 'update']);
Route::delete('/notice/destroy/{id}', [NoticeController::class, 'destroy']);

# Notice Reciver

Route::get('/noticeReciver', [NoticeController::class, 'listNoticeReciver']);

#Evaluation
Route::get('/evaluation/all', [EvaluationCriterionController::class, 'all']);
Route::post('/evaluation/store', [EvaluationCriterionController::class, 'store']);
Route::put('/evaluation/update/{id}', [EvaluationCriterionController::class, 'update']);
Route::delete('/evaluation/destroy/{id}', [EvaluationCriterionController::class, 'destroy']);
# Unit 

Route::get('/unit/all', [UnitController::class, 'all']);
Route::post('/unit/store', [UnitController::class, 'store']);
Route::put('/unit/update/{id}', [UnitController::class, 'update']);
Route::delete('/unit/destroy/{id}', [UnitController::class, 'destroy']);

#Template
Route::get('/template/all', [TemplateController::class, 'all']);
Route::post('/template/store', [TemplateController::class, 'store']);
Route::put('/template/update/{id}', [TemplateController::class, 'update']);
Route::delete('/template/destroy/{id}', [TemplateController::class, 'destroy']);
Route::get('/template/edit/{id}', [TemplateController::class, 'edit']);
