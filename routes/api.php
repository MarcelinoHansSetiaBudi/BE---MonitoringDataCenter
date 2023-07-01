<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DataStaffController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReportMonitoringController;
use App\Http\Controllers\ReportMaintenanceController;
use App\Http\Controllers\ShiftController;
use App\Http\Controllers\ShiftStaffController;
use App\Http\Controllers\SupervisorController;
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

Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {

    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::post('me', [AuthController::class, 'me']);

});

// Data Staff
Route::group([
    'middleware' => ['api', 'jwt.auth'],

], function ($router) {

    Route::get('data-staff', [DataStaffController::class, 'index']);
    Route::post('data-staff', [DataStaffController::class, 'store']);
    Route::get('data-staff/{id}', [DataStaffController::class, 'show']);
    Route::put('data-staff/{id}', [DataStaffController::class, 'update']);
    Route::delete('data-staff/{id}', [DataStaffController::class, 'destroy']);

});

// Product
Route::group([
    'middleware' => ['api', 'jwt.auth'],

], function ($router) {

    Route::get('product', [ProductController::class, 'index']);
    Route::post('product', [ProductController::class, 'store']);
    Route::get('product/{id}', [ProductController::class, 'show']);
    Route::get('product-total-aktif', [ProductController::class, 'getTotalActiveServerByStatus']);
    Route::put('product/{id}', [ProductController::class, 'update']);
    Route::delete('product/{id}', [ProductController::class, 'destroy']);

});

// Report Monitoring
Route::group([
    'middleware' => ['api', 'jwt.auth'],

], function ($router) {

    Route::get('report-monitoring', [ReportMonitoringController::class, 'index']);
    Route::post('report-monitoring', [ReportMonitoringController::class, 'store']);
    Route::get('report-monitoring/{id}', [ReportMonitoringController::class, 'show']);
    Route::get('report-monitoring-total', [ReportMonitoringController::class, 'count']);
    Route::put('report-monitoring/{id}', [ReportMonitoringController::class, 'update']);
    Route::delete('report-monitoring/{id}', [ReportMonitoringController::class, 'destroy']);
 
});

// Report Maintenance
Route::group([
    'middleware' => ['api', 'jwt.auth'],

], function ($router) {

    Route::get('report-maintenance', [ReportMaintenanceController::class, 'index']);
    Route::post('report-maintenance', [ReportMaintenanceController::class, 'store']);
    Route::get('report-maintenance/{id}', [ReportMaintenanceController::class, 'show']);
    Route::get('report-maintenance-total', [ReportMaintenanceController::class, 'count']);
    Route::put('report-maintenance/{id}', [ReportMaintenanceController::class, 'update']);
    Route::delete('report-maintenance/{id}', [ReportMaintenanceController::class, 'destroy']);

});

// Shift
Route::group([
    'middleware' => ['api', 'jwt.auth'],

], function ($router) {

    Route::get('shift', [ShiftController::class, 'index']);
    Route::post('shift', [ShiftController::class, 'store']);
    Route::get('shift/{id}', [ShiftController::class, 'show']);
    Route::put('shift/{id}', [ShiftController::class, 'update']);
    Route::delete('shift/{id}', [ShiftController::class, 'destroy']);

});

// Shift Staff
Route::group([
    'middleware' => ['api', 'jwt.auth'],

], function ($router) {

    Route::get('shift-staff', [ShiftStaffController::class, 'index']);
    Route::post('shift-staff', [ShiftStaffController::class, 'store']);
    Route::get('shift-staff/{id}', [ShiftStaffController::class, 'show']);
    Route::put('shift-staff/{id}', [ShiftStaffController::class, 'update']);
    Route::delete('shift-staff/{id}', [ShiftStaffController::class, 'destroy']);

});

// Supervisor
Route::group([
    'middleware' => ['api', 'jwt.auth'],

], function ($router) {

    Route::get('supervisor', [SupervisorController::class, 'index']);
    Route::post('supervisor', [SupervisorController::class, 'store']);
    Route::get('supervisor/{id}', [SupervisorController::class, 'show']);
    Route::put('supervisor/{id}', [SupervisorController::class, 'update']);
    Route::delete('supervisor/{id}', [SupervisorController::class, 'destroy']);
});