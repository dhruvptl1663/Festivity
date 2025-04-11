<?php

use App\Http\Controllers\EventController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\PackageController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\admin\AdminLoginController;
use App\Http\Controllers\admin\HomeController;

Route::get('/',[MainController::class,'index']);
Route::get('/events',[MainController::class,'events']);
Route::get('/packages',[MainController::class,'packages']);
Route::get('/about',[MainController::class,'about']);
Route::get('/contact',[MainController::class,'contact']);
Route::get('/login',[MainController::class,'login']);
Route::get('/signup',[MainController::class,'signup']);
Route::get('/event-details',[MainController::class,'eventShow']);

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

// Show packages
Route::get('/packages', [PackageController::class, 'index'])->name('packages.index');
Route::get('/packages/{package}', [PackageController::class, 'show'])->name('packages.show');

// Show events
Route::get('/events', [EventController::class, 'index'])->name('events');
Route::get('/events/category/{categoryId}', [EventController::class, 'getEventsByCategory']);



// contact event
Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

Route::get('/admin/contacts', [AdminContactController::class, 'index'])->middleware('auth');

