<?php

use App\Http\Controllers\EventController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\PackageController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\admin\AdminLoginController;
use App\Http\Controllers\admin\HomeController;
use App\Http\Controllers\BookmarkController;
use App\Http\Controllers\admin\AdminContactController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\PromoCodeController;

Route::get('/',[MainController::class,'index']);
Route::get('/events',[MainController::class,'events']);
Route::get('/packages',[MainController::class,'packages']);
Route::get('/about',[MainController::class,'about']);
Route::get('/contact',[MainController::class,'contact']);
Route::get('/login',[MainController::class,'login']);
Route::get('/signup',[MainController::class,'signup']);
Route::get('/event/{id}', [EventController::class, 'show'])->name('event.show');
Route::get('/eventdetails/{id}', [MainController::class, 'eventdetails'])->name('eventdetails.show');

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

// Bookmark routes
Route::post('/bookmarks/toggle', [BookmarkController::class, 'toggle'])->name('bookmarks.toggle');

// Cart routes
Route::post('/cart/toggle', [CartController::class, 'toggle'])->name('cart.toggle');
Route::get('/cart', [CartController::class, 'index'])->name('cart');
Route::delete('/cart/{id}', [CartController::class, 'delete'])->name('cart.delete');

// Promo code route
Route::post('/promo-code/apply', [PromoCodeController::class, 'apply'])->name('promo.apply');

// Show packages
Route::get('/packages', [PackageController::class, 'index'])->name('packages.index');
Route::get('/packagedetails/{package}', [PackageController::class, 'show'])->name('packagedetails');

// Show events
Route::get('/events', [EventController::class, 'index'])->name('events');
Route::get('/events/category/{categoryId}', [EventController::class, 'getEventsByCategory']);

// contact event
Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

Route::get('/admin/contacts', [AdminContactController::class, 'index'])->middleware('auth');

Route::middleware(['auth'])->group(function () {
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
});
