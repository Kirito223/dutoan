<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\EstimateController;
use App\Http\Controllers\EvaluationCriterionController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\NoticeController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\RoleController;
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

Route::get('/commune/{district}', [LocationController::class, "communeList"]);
Route::get('/district/{province}', [LocationController::class, "districtList"]);
Route::get('/province', [LocationController::class, "provinceList"]);


# Department Route
Route::get('/department/all', [DepartmentController::class, 'all']);
Route::post('/department/store', [DepartmentController::class, 'store']);
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
Route::get('/template/get/{template}', [TemplateController::class, 'loadTemplate']);

# Estimate
Route::get('/estimate/all', [EstimateController::class, 'all']);
Route::post('/estimate/store', [EstimateController::class, 'store']);
Route::put('/estimate/update/{id}', [EstimateController::class, 'update']);
Route::delete('/estimate/destroy/{id}', [EstimateController::class, 'destroy']);

Route::post('/estimate/send', [EstimateController::class, 'sendEstimate']);
Route::get('/estimate/listApproval', [EstimateController::class, 'listEstimateApproval']);
Route::get('/estimate/getEstimateDetail/{id}', [EstimateController::class, 'getDetail']);

Route::get('/estimate/approval/{id}', [EstimateController::class, 'estimateApproval']);
Route::get('/estimate/reject/{id}', [EstimateController::class, 'estimateReject']);
Route::post('/estimate/additional/{id}', [EstimateController::class, 'estimateAddtional']);

#Account
Route::get('/account/all/{id}', [AccountController::class, 'all']);
Route::post('/account/store', [AccountController::class, 'store']);
Route::put('/account/update/{id}', [AccountController::class, 'update']);
Route::delete('/account/destroy/{id}', [AccountController::class, 'destroy']);

#Report

Route::get('/report/all', [ReportController::class, 'all']);
Route::post('/report/store', [ReportController::class, 'store']);
Route::put('/report/update/{id}', [ReportController::class, 'update']);
Route::delete('/report/destroy/{id}', [ReportController::class, 'destroy']);
Route::get('/report/show/{id}', [ReportController::class, 'show']);

# Approval Report
Route::get('/report/listApproval', [ReportController::class, 'listApproval']);
Route::get('/report/approvalReport/{id}', [ReportController::class, 'approvalReport']);
Route::get('/report/rejectReport/{id}', [ReportController::class, 'rejectReport']);
Route::post('/report/additionalReport/{id}', [ReportController::class, 'additionalReport']);


#Role

Route::get('/role/all', [RoleController::class, "all"]);
