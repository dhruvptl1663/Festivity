<?php

use App\Http\Controllers\EventController;
use App\Http\Controllers\MainController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;

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

// Protected Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/index', [MainController::class, 'index'])->name('home');
    Route::get('/profile', [MainController::class, 'profile'])->name('profile');
});


// Show events
Route::get('/events', [EventController::class, 'index'])->name('events');
Route::get('/events/category/{categoryId}', [EventController::class, 'getEventsByCategory'])->name('events.by.category');
