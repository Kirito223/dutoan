<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\EvaluationCriterionController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\NoticeController;
use App\Http\Controllers\TemplateController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\EstimateController;
use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Route;
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

Route::get('/', [LoginController::class, 'index']);
Route::group(['middleware' => 'auth'], function () {

    Route::get('/home', [LoginController::class, 'home']);

    Route::get('/sendNotce', [NoticeController::class, 'index']);
    Route::get('/viewNotice/{id}/{detail}', [NoticeController::class, 'viewNotice']);

    Route::get('/department', [DepartmentController::class, 'index']);

    Route::get('/noticeReciver/dowload/{file}', [NoticeController::class, 'downloadFile']);

    Route::get('/evaluation', [EvaluationCriterionController::class, 'index']);

    Route::get('/unit', [UnitController::class, 'index']);

    Route::get('/template', [TemplateController::class, 'index']);
    Route::get('/template/detail', [TemplateController::class, 'detailView']);
    Route::get('/template/edit/{id}', [TemplateController::class, 'editTemplate']);

    Route::get('/estimates', [EstimateController::class, 'index']);
    Route::get('/estimates/list', [EstimateController::class, 'viewListEstimate']);
    Route::get('/estimates/approval', [EstimateController::class, 'viewApproval']);
    Route::get('/estimates/viewDetail/{id}', [EstimateController::class, 'viewDetail']);
    Route::get('/estimates/edit/{id}', [EstimateController::class, 'viewEdit']);

    Route::get('/account/index/{id}', [AccountController::class, "index"]);

    Route::get('/report', [ReportController::class, 'index']);
    Route::get('/report/add', [ReportController::class, 'viewAddNew']);
    Route::get('/report/edit/{id}', [ReportController::class, 'editView']);
});
