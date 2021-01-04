<?php

use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\Employee\HolidayController as EmployeeHolidayController;
use App\Http\Controllers\Employee\LeaveController as EmployeeLeaveController;
use App\Http\Controllers\{EmployeeController, HolidayController, JobController, LeaveController, ProjectController, TaskController};
use App\Http\Livewire\Departments;
use App\Models\Department;
use Illuminate\Support\Facades\Route;

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

    //holiday
    Route::get('/holiday', [EmployeeHolidayController::class, 'index'])->name('dash.holiday');
    
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
    Route::post('/admin/employee/add/status', [EmployeeController::class, 'add_status'])->name('admin.employee.add.status');
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
    Route::post('/admin/leaves/reject/{id}', [LeaveController::class, 'reject'])->name('admin.leaves.reject');
    Route::post('/admin/leaves/add/type', [LeaveController::class, 'add_type'])->name('admin.leaves.add.type');
    Route::get('/admin/leaves/delete/{id}', [LeaveController::class, 'destroy'])->name('admin.leaves.delete');

    //holiday
    Route::get('/admin/holiday', [HolidayController::class, 'index'])->name('admin.holiday');
    Route::post('/admin/holiday/ajax', [HolidayController::class, 'ajax'])->name('admin.holiday.ajax');

    // project
    Route::get('/admin/projects', [ProjectController::class, 'index'])->name('admin.projects');
    Route::get('/admin/projects/add', [ProjectController::class, 'add'])->name('admin.projects.add');
    Route::post('/admin/projects/add/store', [ProjectController::class, 'store'])->name('admin.projects.store');
    Route::post('/admin/projects/add/category', [ProjectController::class, 'addCat'])->name('admin.projects.category.add');
    Route::get('/admin/projects/category/delete/{id}', [ProjectController::class, 'destroyCat'])->name('admin.projects.category.delete');
    Route::get('/admin/projects/delete/{id}', [ProjectController::class, 'destroy'])->name('admin.projects.delete');
    Route::get('/admin/projects/update/{id}', [ProjectController::class, 'edit'])->name('admin.projects.edit');
    Route::post('/admin/projects/update', [ProjectController::class, 'update'])->name('admin.projects.update');
    Route::get('/admin/projects/detail/{id}', [ProjectController::class, 'details'])->name('admin.projects.details');
    Route::post('/admin/projects/member/add', [ProjectController::class, 'member_add'])->name('admin.projects.member.add');
    Route::get('/admin/projects/member/delete/{id}', [ProjectController::class, 'member_destroy'])->name('admin.projects.member.delete');
    
    //task
    Route::get('/admin/tasks', [TaskController::class, 'index'])->name('admin.tasks');
    Route::get('/admin/tasks/add', [TaskController::class, 'add'])->name('admin.tasks.add');
    Route::post('/admin/tasks/add/store', [TaskController::class, 'store'])->name('admin.tasks.store');
    Route::get('/admin/tasks/delete/{id}', [TaskController::class, 'destroy'])->name('admin.tasks.delete');
    Route::get('/admin/tasks/update/{id}', [TaskController::class, 'edit'])->name('admin.tasks.edit');
    Route::post('/admin/tasks/add/category', [TaskController::class, 'addCat'])->name('admin.tasks.category.add');
    Route::get('/admin/tasks/category/delete/{id}', [TaskController::class, 'destroyCat'])->name('admin.tasks.category.delete');
    Route::get('/admin/tasks/add/ajax-getuser', [TaskController::class, 'ajax']);
});