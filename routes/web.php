<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\SocialController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ExpensesController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\DesignationController;
use App\Http\Controllers\ServiceCategoryController;
use App\Http\Controllers\ServiceProjectController;


Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth'])->group(function () {
    Route::get('/', function () {
        return redirect()->action([DashboardController::class, 'index']);
    });


//role
    Route::post('/role/assign/store', [RoleController::class, 'roleAssign_store'])->name('roleAssign.store');
    Route::get('/role/user/delete/{id}', [RoleController::class, 'userRole_delete'])->name('userRole.delete');
//taskindex
    Route::get('/task/status/update/{id}', [TaskController::class, 'taskStatus'])->name('task.status.update');
//search
    Route::get('/search/employee', [EmployeeController::class, 'searchEmployee'])->name('searchEmployee');
    Route::get('/search/client', [ClientController::class, 'searchClient'])->name('searchClient');
 //jquery
    Route::get('/get-designations/{departmentId}', [EmployeeController::class, 'getDesignations']);
//project file delete and downoad
    Route::get('project/file/delete/{id}/{key}', [ProjectController::class, 'fileDelete'])->name('projectFile.delete');
    Route::get('/download/{filename}', [ProjectController::class, 'downloadFile'])->name('download');
    Route::get('/project_overview/{id}',[ProjectController::class, 'employeeProjectShow'])->name('employee.project.overview');
//
    Route::get('/user/delete/{id}', [HomeController::class, 'userDelete'])->name('user.delete');
    Route::get('/users', [HomeController::class, 'users'])->name('users');
    Route::post('/user/store', [HomeController::class, 'userStore'])->name('user.store');

//dashboard
    Route::get('/index', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/app/setting',[DashboardController::class, 'showAppSetting'])->name('dashboard.showSetting');
    Route::post('/app/setting/logoicon/store',[DashboardController::class, 'logoIcon_store'])->name('dashboard.logoIcon.store');
//resource routes
    Route::resources([
        'project' => ProjectController::class,
        'employee' => EmployeeController::class,
        'profile' => ProfileController::class,
        'client' => ClientController::class,
        'department' => DepartmentController::class,
        'designation' => DesignationController::class,
        'expenses' => ExpensesController::class,
        'task' => TaskController::class,
        'role' => RoleController::class,
        'social' => SocialController::class,
        'blog'=>BlogController::class,
        'category'=>CategoryController::class,
        'service-projects' =>ServiceProjectController::class,
        'service-categories'=> ServiceCategoryController::class
    ]);
});
Route::post('/service-category/toggle-status/{id}', [ServiceCategoryController::class, 'toggleStatus'])->name('service-category.toggleStatus');
Route::post('/service-project/toggle-status/{id}', [ServiceProjectController::class, 'toggleStatus'])->name('service-project.toggleStatus');