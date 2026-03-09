<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::view('/admin-login','admin-login');
Route::post('/admin-login',[AdminController::class,'login']);
Route::get('/dashboard',[AdminController::class,'dashboard']);
Route::get('/admin-categories',[AdminController::class,'categories']);
Route::get('/admin-logout',[AdminController::class,'logout']);
Route::post('/add-category',[AdminController::class,'addCategory']);
Route::delete('/delete-category/{id}',[AdminController::class,'deleteCategory']);
Route::get('/add-quiz',[AdminController::class,'showAddQuiz']);
Route::post('/add-quiz',[AdminController::class,'saveQuiz']);
Route::post('/add-question',[AdminController::class,'addQuestion']);
Route::get('/finish-quiz',[AdminController::class,'finishQuiz']);
Route::get('/category/{id}/quizzes',[AdminController::class,'categoryQuizzes']);
Route::get('/quiz/{id}',[AdminController::class,'quizDetail']);