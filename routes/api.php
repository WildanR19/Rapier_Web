<?php

use App\Http\Controllers\Api\ApiController;
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

Route::post('login', [ApiController::class, 'login']);

// Employee
Route::get('user', [ApiController::class, 'user_list']);
Route::get('user/add', [ApiController::class, 'user_add']);
Route::post('user/add/store', [ApiController::class, 'user_store']);
Route::delete('user/delete/{id}', [ApiController::class, 'user_destroy']);
Route::get('user/update/{id}', [ApiController::class, 'user_update']);
Route::post('user/edit/{id}', [ApiController::class, 'user_edit']);

// Department
Route::get('department', [ApiController::class, 'dept_list']);
Route::post('department/add', [ApiController::class, 'dept_store']);
Route::get('department/update/{id}', [ApiController::class, 'dept_update']);
Route::post('department/edit/{id}', [ApiController::class, 'dept_edit']);
Route::delete('department/delete/{id}', [ApiController::class, 'dept_destroy']);

// Job
Route::get('job', [ApiController::class, 'job_list']);
Route::post('job/add', [ApiController::class, 'job_store']);
Route::get('job/update/{id}', [ApiController::class, 'job_update']);
Route::post('job/edit/{id}', [ApiController::class, 'job_edit']);
Route::delete('job/delete/{id}', [ApiController::class, 'job_destroy']);

// leave
Route::get('leave', [ApiController::class, 'leave_list']);
Route::get('leave/add', [ApiController::class, 'leave_add']);
Route::post('leave/add/store', [ApiController::class, 'leave_store']);
Route::get('leave/approve/{id}', [ApiController::class, 'leave_approve']);
Route::post('leave/reject/{id}', [ApiController::class, 'leave_reject']);
Route::post('leave/add_type', [ApiController::class, 'leave_add_type']);
Route::delete('leave/delete_type/{id}', [ApiController::class, 'leave_destroy_type']);
Route::delete('leave/delete/{id}', [ApiController::class, 'leave_destroy']);
// Route::get('leave/update/{id}', [ApiController::class, 'leave_update']);
// Route::post('leave/edit/{id}', [ApiController::class, 'leave_edit']);

// Holiday
Route::get('holiday', [ApiController::class, 'holiday_list']);

// Payslip
Route::get('payslip', [ApiController::class, 'payslip_list']);
Route::get('payslip/add', [ApiController::class, 'payslip_add']);
Route::post('payslip/add/store', [ApiController::class, 'payslip_store']);
Route::get('payslip/salary/{user}', [ApiController::class, 'payslip_getSalary']);
Route::get('payslip/basic', [ApiController::class, 'payslip_basic']);
Route::post('payslip/basic/add', [ApiController::class, 'payslip_basic_add']);
Route::delete('payslip/basic/{id}', [ApiController::class, 'payslip_basic_destroy']);
Route::delete('payslip/delete/{id}', [ApiController::class, 'payslip_destroy']);
Route::post('payslip/autogenerate', [ApiController::class, 'payslip_autoGenerate']);

// Attendance
// Route::get('attendance', [ApiController::class, 'attend_list']);

// Project
Route::get('project', [ApiController::class, 'project_list']);
Route::get('project/add', [ApiController::class, 'project_add']);
Route::post('project/add/store', [ApiController::class, 'project_store']);
Route::post('project/category/add', [ApiController::class, 'project_addCat']);
Route::delete('project/category/delete/{id}', [ApiController::class, 'project_destroyCat']);
Route::delete('project/delete/{id}', [ApiController::class, 'project_destroy']);
Route::get('project/update/{id}', [ApiController::class, 'project_update']);
Route::post('project/edit/{id}', [ApiController::class, 'project_edit']);
Route::post('project/member/add', [ApiController::class, 'project_member_add']);
Route::delete('project/member/delete/{id}', [ApiController::class, 'project_member_destroy']);