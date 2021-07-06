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
Route::get('role', [ApiController::class, 'role_list']);
Route::get('home', [ApiController::class, 'home_dashboard']);
Route::post('user/updatepassword/{id}', [ApiController::class, 'update_password']);

// Employee
Route::get('user', [ApiController::class, 'user_list']);
Route::get('user/{id}', [ApiController::class, 'user_list_byID']);
Route::get('user/add', [ApiController::class, 'user_add']);
Route::post('user/add/store', [ApiController::class, 'user_store']);
Route::delete('user/delete/{id}', [ApiController::class, 'user_destroy']);
Route::get('user/update/{id}', [ApiController::class, 'user_update']);
Route::post('user/edit/{id}', [ApiController::class, 'user_edit']);
Route::get('emp_status', [ApiController::class, 'employee_status']);
Route::get('emp_detail/{id}', [ApiController::class, 'employee_detail']);

// Department
Route::get('department', [ApiController::class, 'dept_list']);
Route::post('department/add', [ApiController::class, 'dept_store']);
Route::post('department/edit/{id}', [ApiController::class, 'dept_edit']);
Route::delete('department/delete/{id}', [ApiController::class, 'dept_destroy']);

// Job
Route::get('job', [ApiController::class, 'job_list']);
Route::post('job/add', [ApiController::class, 'job_store']);
Route::post('job/edit/{id}', [ApiController::class, 'job_edit']);
Route::delete('job/delete/{id}', [ApiController::class, 'job_destroy']);

// leave
Route::get('leave', [ApiController::class, 'leave_list']);
Route::get('leave/pending', [ApiController::class, 'pending_leave_list']);
Route::get('leave/user/{id}', [ApiController::class, 'leave_list_user']);
Route::get('leave/pending/{id}', [ApiController::class, 'pending_leave_list_user']);
Route::get('leave/type', [ApiController::class, 'leave_type']);
Route::get('leave/add', [ApiController::class, 'leave_add']);
Route::post('leave/add/store', [ApiController::class, 'leave_store']);
Route::get('leave/approve/{id}', [ApiController::class, 'leave_approve']);
Route::post('leave/reject/{id}', [ApiController::class, 'leave_reject']);
Route::post('leave/add_type', [ApiController::class, 'leave_add_type']);
Route::delete('leave/delete_type/{id}', [ApiController::class, 'leave_destroy_type']);
Route::delete('leave/delete/{id}', [ApiController::class, 'leave_destroy']);
// Route::get('leave/update/{id}', [ApiController::class, 'leave_update']);
Route::post('leave/edit/{id}', [ApiController::class, 'leave_edit']);

// Event
Route::get('event/{month}', [ApiController::class, 'event_list']);
Route::post('event/add', [ApiController::class, 'event_add']);
Route::delete('event/delete/{id}', [ApiController::class, 'event_destroy']);

// Payslip
Route::get('payslip', [ApiController::class, 'payslip_list']);
Route::get('payslip/user/{id}', [ApiController::class, 'payslip_list_user']);
Route::get('payslip/add', [ApiController::class, 'payslip_add']);
Route::post('payslip/add/store', [ApiController::class, 'payslip_store']);
Route::post('payslip/update/{id}', [ApiController::class, 'payslip_edit']);
Route::get('payslip/salary/{user}', [ApiController::class, 'payslip_getSalary']);
Route::get('payslip/basic', [ApiController::class, 'payslip_basic']);
Route::post('payslip/basic/add', [ApiController::class, 'payslip_basic_add']);
Route::delete('payslip/basic/{id}', [ApiController::class, 'payslip_basic_destroy']);
Route::delete('payslip/delete/{id}', [ApiController::class, 'payslip_destroy']);
Route::post('payslip/autogenerate', [ApiController::class, 'payslip_autoGenerate']);
Route::get('payslip/pdf/{id}', [ApiController::class, 'payslip_createPDF']);

// Attendance
// Route::get('attendance', [ApiController::class, 'attend_list']);

// Project
Route::get('project', [ApiController::class, 'project_list']);
Route::get('project/user/{id}', [ApiController::class, 'project_list_user']);
Route::get('project/ongoing', [ApiController::class, 'ongoing_project_list']);
Route::get('project/ongoing/{id}', [ApiController::class, 'ongoing_project_list_user']);
Route::post('project/add/{userId}', [ApiController::class, 'project_store']);
Route::get('project/category', [ApiController::class, 'project_category']);
Route::post('project/category/add', [ApiController::class, 'project_add_cat']);
Route::delete('project/category/delete/{id}', [ApiController::class, 'project_destroy_cat']);
Route::delete('project/delete/{id}', [ApiController::class, 'project_destroy']);
Route::post('project/update/{id}', [ApiController::class, 'project_update']);
Route::get('project/member/{id}', [ApiController::class, 'project_member']);
Route::post('project/member/add', [ApiController::class, 'project_member_add']);
Route::delete('project/member/delete/{id}', [ApiController::class, 'project_member_destroy']);
Route::get('project/activity/{id}', [ApiController::class, 'project_activity_list']);
Route::get('project/activity/download/{id}', [ApiController::class, 'project_activity_download']);
Route::delete('project/activity/delete/{id}', [ApiController::class, 'project_activity_destroy']);
Route::post('project/activity/submit/{id}', [ApiController::class, 'project_activity_submit']);

// Goal
Route::get('goal', [ApiController::class, 'goal_list']);
Route::get('goal/user/{id}', [ApiController::class, 'goal_list_user']);

Route::get('task/{id}', [ApiController::class, 'task_list']);