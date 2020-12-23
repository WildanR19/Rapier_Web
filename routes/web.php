<?php

use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\JobController;
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

    Route::get('/home', function () {
        return view('dashboard');
    })->name('dashboard');
    
    Route::get('/log', function () {
        return view('login');
    });
    
    Route::get('/dashboard', function () {
        return view('home');
    })->name('dash.home');
    
    Route::get('/projects', function () {
        return view('projects.index');
    })->name('dash.projects');
    
    Route::get('/projects/detail', function () {
        return view('projects.detail');
    })->name('dash.projects.detail');
    
    Route::get('/goals', function () {
        return view('goals.index');
    })->name('dash.goals');
    
    Route::get('/leave', function () {
        return view('leave.index');
    })->name('dash.leave');
    
    Route::get('/teams', function () {
        return view('teams.index');
    })->name('dash.teams');
    
    Route::get('/payslip', function () {
        return view('payslip.index');
    })->name('dash.payslip');
    
    Route::get('/payslip/content', function () {
        return view('payslip.content');
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
    Route::get('/admin/employee', [EmployeeController::class, 'index'])->name('dash.employee');
    Route::get('/admin/employee/details', [EmployeeController::class, 'details'])->name('dash.employee.details');
    //Create
    Route::get('/admin/employee/add', [EmployeeController::class, 'add'])->name('dash.employee.add');
    Route::post('/admin/employee/add/store', [EmployeeController::class, 'store'])->name('dash.employee.store');
    //delete
    Route::get('/admin/employee/delete/{id}', [EmployeeController::class, 'destroy']);
    //update
    Route::get('/admin/employee/update/{id}', [EmployeeController::class, 'edit']);
    Route::post('/admin/employee/update', [EmployeeController::class, 'update'])->name('dash.employee.update');

    //department
    //read
    Route::get('/admin/department', [DepartmentController::class, 'index'])->name('dash.department');
    //create
    Route::post('/admin/department/add/store', [DepartmentController::class, 'store'])->name('dash.department.store');
    //delete
    Route::get('/admin/department/delete/{id}', [DepartmentController::class, 'destroy']);

    //job
    //read
    Route::get('/admin/job', [JobController::class, 'index'])->name('dash.job');
    //create
    Route::post('/admin/job/add/store', [JobController::class, 'store'])->name('dash.job.store');
    //delete
    Route::get('/admin/job/delete/{id}', [JobController::class, 'destroy']);
    //update
    Route::get('/admin/job/update/{id}', [JobController::class, 'edit']);

    Route::get('/jobs', function () {
        return view('admin.jobs');
    })->name('dash.jobs');
});