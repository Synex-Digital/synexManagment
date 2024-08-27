<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ServiceProjectController;
use App\Http\Controllers\Api\BlogController;
use App\Http\Controllers\Api\CategoryController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


//Route::apiResource('service-projects', ServiceProjectController::class);
Route::get('/projects', [ServiceProjectController::class, 'index']);
Route::get('/projects/item', [ServiceProjectController::class, 'homeitem']);
Route::get('/blogs', [BlogController::class, 'index']);
Route::get('/blogs/item', [BlogController::class, 'homeitem']);
Route::get('/blogs/{slug}', [BlogController::class, 'view']);
Route::get('/category/{slug}', [CategoryController::class, 'index']);
Route::get('/sitemap/blog', [BlogController::class, 'sitemap']);
