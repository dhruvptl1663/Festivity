<?php

use App\Http\Controllers\MainController;
use Illuminate\Support\Facades\Route;

Route::get('/',[MainController::class,'index']);
Route::get('/events',[MainController::class,'events']);
Route::get('/packages',[MainController::class,'packages']);
Route::get('/about',[MainController::class,'about']);
Route::get('/contact',[MainController::class,'contact']);
Route::get('/login',[MainController::class,'login']);
Route::get('/signup',[MainController::class,'signup']);
Auth::routes();
Route::get('/login', function () {
    return view('login');
})->name('login');

Route::get('/signup', function () {
    return view('signup');
})->name('signup');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
