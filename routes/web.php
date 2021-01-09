<?php

use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\Employee\HolidayController as EmployeeHolidayController;
use App\Http\Controllers\Employee\LeaveController as EmployeeLeaveController;
use App\Http\Controllers\{Controller, EmployeeController, GoalController, HolidayController, HomeController, JobController, LeaveController, ProjectController, TaskController};
use App\Http\Controllers\Employee\ContactController;
use App\Http\Controllers\Employee\GoalController as EmployeeGoalController;
use App\Http\Controllers\Employee\ProjectController as EmployeeProjectController;
use App\Http\Controllers\Employee\TaskController as EmployeeTaskController;
use App\Http\Livewire\Departments;
use App\Models\Department;
use Illuminate\Support\Facades\Route;

//employee
Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/', function () {
        return view('home');
    });
    
    // dashboard
    Route::get('/dashboard', [HomeController::class, 'index'])->name('dash.home');
    
    // projects
    Route::get('/projects', [EmployeeProjectController::class, 'index'])->name('dash.projects');
    Route::get('/projects/detail/{id}', [EmployeeProjectController::class, 'details'])->name('dash.projects.details');
    Route::post('/projects/update', [EmployeeProjectController::class, 'submit_update'])->name('dash.projects.update');
    Route::get('/projects/delete/{id}', [EmployeeProjectController::class, 'destroy'])->name('dash.projects.delete');
    Route::get('/projects/{id}/edit', [EmployeeProjectController::class, 'update'])->name('dash.projects.editupdate');
    Route::post('/projects/{id}', [EmployeeProjectController::class, 'edit'])->name('dash.projects.edit');

    // goals
    Route::get('/goals', [EmployeeGoalController::class, 'index'])->name('dash.goals');
    Route::post('/goals/add', [EmployeeGoalController::class, 'store'])->name('dash.goals.add');
    Route::get('/goals/{id}/edit', [EmployeeGoalController::class, 'update'])->name('dash.goals.update');
    Route::post('/goals/{id}', [EmployeeGoalController::class, 'edit'])->name('dash.goals.edit');

    //leave
    Route::get('/leave', [EmployeeLeaveController::class, 'index'])->name('dash.leave');
    Route::post('/leave/assign', [EmployeeLeaveController::class, 'store'])->name('dash.leave.assign');
    Route::get('/leave/{id}/edit', [EmployeeLeaveController::class, 'update'])->name('dash.leave.update');
    Route::post('/leave/{id}', [EmployeeLeaveController::class, 'edit'])->name('dash.leave.edit');
    Route::get('/leave/delete/{id}', [EmployeeLeaveController::class, 'destroy'])->name('dash.leave.delete');

    //holiday
    Route::get('/holiday', [EmployeeHolidayController::class, 'index'])->name('dash.holiday');
    
    // contacts
    Route::get('/contacts', [ContactController::class, 'index'])->name('dash.contacts');
    Route::get('/contacts/{id}/edit', [ContactController::class, 'update'])->name('dash.contacts.update');
    Route::post('/contacts/{id}', [ContactController::class, 'edit'])->name('dash.contacts.edit');
    
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
    Route::get('/admin/employee/status/delete/{id}', [EmployeeController::class, 'destroy_status'])->name('admin.employee.delete.status');
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
    Route::get('/admin/leaves/type/delete/{id}', [LeaveController::class, 'destroy_type'])->name('admin.leaves.delete.type');
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

    // goals
    Route::get('/admin/goals', [GoalController::class, 'index'])->name('admin.goals');
    Route::get('/admin/goals/add', [GoalController::class, 'add'])->name('admin.goals.add');
    Route::post('/admin/goals/add/store', [GoalController::class, 'store'])->name('admin.goals.store');
    Route::get('/admin/goals/delete/{id}', [GoalController::class, 'destroy'])->name('admin.goals.delete');
    Route::get('/admin/goals/update/{id}', [GoalController::class, 'edit'])->name('admin.goals.edit');
    Route::post('/admin/goals/update', [GoalController::class, 'update'])->name('admin.goals.update');
});