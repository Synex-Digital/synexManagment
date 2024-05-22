<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\DesignationController;
use App\Http\Controllers\ExpensesController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskController;

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth'])->group(function () {
    Route::get('/', function () {
        return redirect()->action([DashboardController::class, 'index']);
    });



//search
    Route::get('/search/employee', [EmployeeController::class, 'searchEmployee'])->name('searchEmployee');
    Route::get('/search/client', [ClientController::class, 'searchClient'])->name('searchClient');
 //jquery
    Route::get('/get-designations/{departmentId}', [EmployeeController::class, 'getDesignations']);
//project file delete and downoad
    Route::get('project/file/delete/{id}/{key}', [ProjectController::class, 'fileDelete'])->name('projectFile.delete');
    Route::get('/download/{filename}', [ProjectController::class, 'downloadFile'])->name('download');
//
    Route::get('/users', [HomeController::class, 'users'])->name('users');
    Route::get('/index', [DashboardController::class, 'index'])->name('dashboard');
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

    ]);
});
