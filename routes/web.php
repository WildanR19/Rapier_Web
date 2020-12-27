<?php

use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\Employee\LeaveController as EmployeeLeaveController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\HolidayController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\LeaveController;
use App\Http\Livewire\Departments;
use App\Models\Department;
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

//employee
Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/', function () {
        return view('home');
    });
    
    Route::get('/dashboard', function () {
        return view('home');
    })->name('dash.home');
    
    Route::get('/projects', function () {
        return view('employee.projects.index');
    })->name('dash.projects');
    
    Route::get('/projects/detail', function () {
        return view('employee.projects.detail');
    })->name('dash.projects.detail');
    
    Route::get('/goals', function () {
        return view('employee.goals.index');
    })->name('dash.goals');
    Route::get('/admin/employee', [EmployeeController::class, 'index'])->name('admin.employee');
    
    //leave
    Route::get('/leave', [EmployeeLeaveController::class, 'index'])->name('dash.leave');
    Route::post('/leave/assign', [EmployeeLeaveController::class, 'store'])->name('dash.leave.assign');
    Route::get('/leave/{id}/edit', [EmployeeLeaveController::class, 'update'])->name('dash.leave.update');
    Route::post('/leave/{id}', [EmployeeLeaveController::class, 'edit'])->name('dash.leave.edit');
    Route::get('/leave/delete/{id}', [EmployeeLeaveController::class, 'destroy'])->name('dash.leave.delete');
    
    Route::get('/teams', function () {
        return view('employee.teams.index');
    })->name('dash.teams');
    
    Route::get('/payslip', function () {
        return view('employee.payslip.index');
    })->name('dash.payslip');
    
    Route::get('/payslip/content', function () {
        return view('employee.payslip.content');
    })->name('dash.payslip.content');
    
    Route::get('/settings', function () {
        return view('settings.index');
    })->name('dash.settings');
    
    Route::get('/notifications', function () {
        return view('notifications.index');
    })->name('dash.notifications');
});

//admin
Route::middleware(['auth:sanctum', 'verified'])->group(function () 
{
    //employee
    //Read
    Route::get('/admin/employee', [EmployeeController::class, 'index'])->name('admin.employee');
    //Create
    Route::get('/admin/employee/add', [EmployeeController::class, 'add'])->name('admin.employee.add');
    Route::post('/admin/employee/add/store', [EmployeeController::class, 'store'])->name('admin.employee.store');
    //delete
    Route::get('/admin/employee/delete/{id}', [EmployeeController::class, 'destroy'])->name('admin.employee.delete');
    //update
    Route::get('/admin/employee/update/{id}', [EmployeeController::class, 'edit'])->name('admin.employee.edit');
    Route::post('/admin/employee/update', [EmployeeController::class, 'update'])->name('admin.employee.update');
    //detail
    Route::get('/admin/employee/detail/{id}', [EmployeeController::class, 'details'])->name('admin.employee.details');

    //department
    //read
    Route::get('/admin/department', [DepartmentController::class, 'index'])->name('admin.department');
    //create
    Route::post('/admin/department/add/store', [DepartmentController::class, 'store'])->name('admin.department.store');
    //delete
    Route::get('/admin/department/delete/{id}', [DepartmentController::class, 'destroy'])->name('admin.department.delete');
    //update
    Route::get('/admin/department/{id}/edit', [DepartmentController::class, 'update'])->name('admin.department.update');
    Route::post('/admin/department/{id}', [DepartmentController::class, 'edit'])->name('admin.department.edit');

    //job
    //read
    Route::get('/admin/job', [JobController::class, 'index'])->name('admin.job');
    //create
    Route::post('/admin/job/add/store', [JobController::class, 'store'])->name('admin.job.store');
    //delete
    Route::get('/admin/job/delete/{id}', [JobController::class, 'destroy'])->name('admin.job.delete');
    //update
    Route::get('/admin/job/{id}/edit', [JobController::class, 'update'])->name('admin.job.update');
    Route::post('/admin/job/{id}', [JobController::class, 'edit'])->name('admin.job.edit');

    //leaves
    Route::get('/admin/leaves', [LeaveController::class, 'index'])->name('admin.leaves');
    Route::get('/admin/leaves/add', [LeaveController::class, 'add'])->name('admin.leaves.add');
    Route::post('/admin/leaves/add/store', [LeaveController::class, 'store'])->name('admin.leaves.store');
    Route::post('/admin/leaves/{id}/approve', [LeaveController::class, 'approve'])->name('admin.leaves.approve');
    Route::post('/admin/leaves/{id}/reject', [LeaveController::class, 'reject'])->name('admin.leaves.reject');
    Route::post('/admin/leaves/add/type', [LeaveController::class, 'add_type'])->name('admin.leaves.add.type');
    Route::get('/admin/leaves/delete/{id}', [LeaveController::class, 'destroy'])->name('admin.leaves.delete');

    //holiday
    Route::get('/admin/holiday', [HolidayController::class, 'index'])->name('admin.holiday');

    // project
    Route::view('/admin/projects', 'admin.project.index')->name('admin.projects');

    //task
    Route::view('/admin/tasks', 'admin.task.index')->name('admin.tasks');
});