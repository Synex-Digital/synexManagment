<?php

use App\Models\Customer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\SocialController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ExpensesController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\DesignationController;
use App\Http\Controllers\ServiceProjectController;
use App\Http\Controllers\CustomerSupportController;
use App\Http\Controllers\InvoiceGenerateController;
use App\Http\Controllers\ServiceCategoryController;

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
    Route::get('/get-project-members/{id}',[ProjectController::class, 'getMemebers'])->name('project_members');
//project file delete and downoad
    Route::get('project/file/delete/{id}/{key}', [ProjectController::class, 'fileDelete'])->name('projectFile.delete');
    Route::get('/download/{filename}', [ProjectController::class, 'downloadFile'])->name('download');
    Route::get('/project_overview/{id}',[ProjectController::class, 'employeeProjectShow'])->name('employee.project.overview');
    Route::post('/project-member-update',[ProjectController::class, 'employee_udpate'])->name('project_member_update');
    Route::post('/project-member-delete/{id}',[ProjectController::class, 'employee_delete'])->name('member_delete');
    Route::get('/my-project-lists',[ProjectController::class, 'employee_project'])->name('my_project.index');

//user
    Route::get('/user/delete/{id}', [HomeController::class, 'userDelete'])->name('user.delete');
    Route::get('/users', [HomeController::class, 'users'])->name('users');
    Route::post('/user/store', [HomeController::class, 'userStore'])->name('user.store');
//customer
    Route::get('web/customer', [CustomerSupportController::class, 'customer'])->name('web.customer');
    Route::get('web/supports/{id}', [CustomerSupportController::class, 'support'])->name('web.support');
    Route::post('web/supports/merge', [CustomerSupportController::class, 'merge'])->name('web.customer.merge');
    Route::post('web/supports/update', [CustomerSupportController::class, 'update'])->name('web.customer.update');
//dashboard
    Route::get('/index', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/app/setting',[DashboardController::class, 'showAppSetting'])->name('dashboard.showSetting');
    Route::post('/app/setting/logoicon/store',[DashboardController::class, 'logoIcon_store'])->name('dashboard.logoIcon.store');
//invoice generate
    Route::get('/invoice/generate', [InvoiceGenerateController::class, 'index'])->name('invoice.generate');
    Route::post('/invoice/store', [InvoiceGenerateController::class, 'store'])->name('invoice.store');
    Route::get('/invoice/list', [InvoiceGenerateController::class, 'list'])->name('invoice.list');
    Route::get('/invoice/edit/{id}', [InvoiceGenerateController::class, 'edit'])->name('invoice.edit');
    Route::post('/invoice/update', [InvoiceGenerateController::class, 'update'])->name('invoice.update');
    Route::post('/invoice/mail/send', [InvoiceGenerateController::class, 'send_mail'])->name('invoice.mail');
    Route::get('/invoice/download/{id}', [InvoiceGenerateController::class, 'download'])->name('invoice.download');
    Route::post('/invoice/status/update/',[InvoiceGenerateController::class, 'status_update'])->name('invoice.status_update');
    Route::get('/mail/demo', [InvoiceGenerateController::class, 'demo'])->name('invoice.demo');
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
