<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use Illuminate\Auth\Events\Login;

Route::get('/',[UserController::class, 'welcome']);

Route::get('/userLogout',[UserController::class, 'userLogout']);

Route::get('/userQuizList/{id}/{category}',[UserController::class, 'userQuizList']);

Route::view('/userSignup','userSignup');

Route::get('/userSignupQuiz',[UserController::class, 'userSignupQuiz']);

Route::post('/userSignup',[UserController::class, 'userSignup']);

Route::get('startQuiz/{id}/{name}',[UserController::class,'startQuiz']);

Route::view('admin-login','admin-login');

Route::post('admin-login',[AdminController::class, 'login']);

Route::get('dashboard',[AdminController::class, 'dashboard']);

Route::get('admin-categories',[AdminController::class, 'categories']);

Route::get('admin-logout',[AdminController::class, 'logout']);

Route::post('admin-categories',[AdminController::class, 'addCategory']);

Route::get('category/delete/{id}',[AdminController::class, 'categoryDelete']);

Route::get('addQuiz',[AdminController::class, 'addQuiz']);

Route::post('addMcq',[AdminController::class, 'addMcqs']);

Route::get('endQuiz',[AdminController::class, 'endQuiz']);

Route::get('showQuiz/{id}',[AdminController::class, 'showQuiz']);

Route::get('quizList/{id}/{category}',[AdminController::class, 'quizList']);

