<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use Illuminate\Auth\Events\Login;

Route::get('/', function () {
    return view('welcome');
});

Route::view('admin-login','admin-login');

Route::post('admin-login',[AdminController::class, 'login']);

Route::get('dashboard',[AdminController::class, 'dashboard']);

Route::get('admin-categories',[AdminController::class, 'categories']);

Route::get('admin-logout',[AdminController::class, 'logout']);

Route::post('admin-categories',[AdminController::class, 'addCategory']);

Route::get('category/delete/{id}',[AdminController::class, 'categoryDelete']);

Route::get('addQuiz',[AdminController::class, 'addQuiz']);

Route::post('addMcq',[AdminController::class, 'addMcqs']);

