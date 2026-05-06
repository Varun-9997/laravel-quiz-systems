<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use Illuminate\Auth\Events\Login;

Route::get('/',[UserController::class, 'welcome']);

Route::get('/userLogout',[UserController::class, 'userLogout']);

Route::get('/userQuizList/{id}/{category}',[UserController::class, 'userQuizList']);

// Route::view('/userSignup','userSignup');

// Route::view('/userLogin','userLogin');

Route::get('/userSignupQuiz',[UserController::class, 'userSignupQuiz']);

Route::get('/userLoginQuiz',[UserController::class, 'userLoginQuiz']);

Route::post('/userLogin',[UserController::class, 'userLogin']);

Route::post('/userSignup',[UserController::class, 'userSignup']);

Route::get('startQuiz/{id}/{name}',[UserController::class,'startQuiz']);

Route::view('admin-login','admin-login');

Route::post('admin-login',[AdminController::class, 'login']);

Route::get('category-list',[UserController::class,'categories']);

Route::get('certificate',[UserController::class,'certificate']);

Route::get('download-certificate',[UserController::class,'downloadCertificate']);

Route::get('userLogin', function(){
    if(!Session()->has('user')){
        return view('userLogin');
    }else{
        return redirect('/');
    }
});

Route::get('userSignup', function(){
    if(!Session()->has('user')){
        return view('userSignup');
    }else{
        return redirect('/');
    }
});

Route::middleware('checkUserAuth')->group(function(){
    Route::post('submitNext/{id}',[UserController::class, 'submitAndNext']);
    Route::get('userDetails',[UserController::class, 'userDetails']);
    Route::get('mcq/{id}/{name}',[UserController::class, 'mcq']);
});

Route::middleware('checkAdminAuth')->group(function(){
    Route::get('admin-logout',[AdminController::class, 'logout']);
    Route::post('addCategories',[AdminController::class, 'addCategory']);
    Route::get('dashboard',[AdminController::class, 'dashboard']);
    Route::get('category/delete/{id}',[AdminController::class, 'categoryDelete']);
    Route::get('admin-categories',[AdminController::class, 'categories']);
    Route::get('addQuiz',[AdminController::class, 'addQuiz']);
    Route::post('addMcq',[AdminController::class, 'addMcqs']);
    Route::get('endQuiz',[AdminController::class, 'endQuiz']);
    Route::get('showQuiz/{id}',[AdminController::class, 'showQuiz']);
    Route::get('quizList/{id}/{category}',[AdminController::class, 'quizList']);
});

Route::get('quiz-search',[UserController::class,'quizSearch']);

Route::view('user-forgot-password', 'user-forgot-password');

Route::post('user-forgot-password',[UserController::class, 'userForgotPassword']);

Route::post('user-set-forgot-password',[UserController::class, 'userSetForgotPassword']);

Route::get('user-forgot-password/{email}',[UserController::class, 'userResetForgotPassword']);

