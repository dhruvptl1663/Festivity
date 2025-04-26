<?php

use App\Http\Controllers\EventController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\PackageController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AdminLoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BookmarkController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\PromoCodeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminDecoratorController;
use App\Http\Controllers\AdminNotificationController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\AdminContactController;
use App\Http\Controllers\DecoratorController;


Route::get('/decorator', [DecoratorController::class, 'index']);

// Admin Panel
Route::get('/admin', [AdminController::class, 'index']);

// Public Routes
Route::get('/', [MainController::class, 'index']);
Route::get('/events', [MainController::class, 'events']);
Route::get('/packages', [MainController::class, 'packages']);
Route::get('/about', [MainController::class, 'about']);
Route::get('/profile', [MainController::class, 'profile']);
Route::get('/contactus', [MainController::class, 'contactus'])->name('contactus');
Route::post('/contactus', [MainController::class, 'storeContact'])->name('contactus.store');
Route::get('/login', [MainController::class, 'login']);
Route::get('/signup', [MainController::class, 'signup']);
Route::get('/event/{id}', [EventController::class, 'show'])->name('event.show');
Route::get('/eventdetails/{id}', [MainController::class, 'eventdetails'])->name('eventdetails.show');

// Auth Routes
Auth::routes();
Route::get('/login', function () {
    return view('login');
})->name('login');

Route::get('/signup', function () {
    return view('signup');
})->name('signup');

Route::middleware(['auth'])->group(function () {
    Route::get('/index', [MainController::class, 'index'])->name('home');
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.update-password');
});

// Protected Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/index', [MainController::class, 'index'])->name('home');
    
    // Profile routes
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
    
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

     // Payment routes
     Route::post('/payment/initiate', [PaymentController::class, 'initiatePayment'])->name('payment.initiate');
     Route::post('/payment/verify', [PaymentController::class, 'verifyPayment'])->name('payment.verify');

    
    // Show events
    Route::get('/events', [EventController::class, 'index'])->name('events');
    Route::get('/events/category/{categoryId}', [EventController::class, 'getEventsByCategory']);
    

      // Contact routes
      Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');
      Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
      
// Admin routes
Route::prefix('admin')->group(function () {
    // Admin Contacts Routes
    Route::get('/contacts', [AdminContactController::class, 'index'])->name('admin.contacts.index');
    Route::get('/contacts/{contact}', [AdminContactController::class, 'show'])->name('admin.contacts.show');
});

        // Admin Users Routes
        Route::get('/users', [AdminUserController::class, 'index'])->name('admin.users.index');
        Route::get('/users/create', [AdminUserController::class, 'create'])->name('admin.users.create');
        Route::post('/users', [AdminUserController::class, 'store'])->name('admin.users.store');
        Route::get('/users/{user}/edit', [AdminUserController::class, 'edit'])->name('admin.users.edit');
        Route::put('/users/{user}', [AdminUserController::class, 'update'])->name('admin.users.update');
        Route::delete('/users/{user}', [AdminUserController::class, 'destroy'])->name('admin.users.destroy');
        Route::get('/users/{user}', [AdminUserController::class, 'show'])->name('admin.users.show');
        
        // Admin Decorator Routes
        Route::get('/decorators', [AdminDecoratorController::class, 'index'])->name('admin.decorators.index');
        Route::get('/decorators/create', [AdminDecoratorController::class, 'create'])->name('admin.decorators.create');
        Route::post('/decorators', [AdminDecoratorController::class, 'store'])->name('admin.decorators.store');
        Route::get('/decorators/{decorator}/edit', [AdminDecoratorController::class, 'edit'])->name('admin.decorators.edit');
        Route::put('/decorators/{decorator}', [AdminDecoratorController::class, 'update'])->name('admin.decorators.update');
        Route::delete('/decorators/{decorator}', [AdminDecoratorController::class, 'destroy'])->name('admin.decorators.destroy');
        Route::get('/decorators/{decorator}', [AdminDecoratorController::class, 'show'])->name('admin.decorators.show');
        
    // Admin Events and Packages Routes under /admin prefix
    Route::prefix('admin')->group(function () {
        // Admin Events Routes
        Route::get('/events', [EventController::class, 'adminIndex'])->name('admin.events.index');
        Route::get('/events/create', [EventController::class, 'adminCreate'])->name('admin.events.create');
        Route::post('/events', [EventController::class, 'adminStore'])->name('admin.events.store');
        Route::get('/events/{event}/edit', [EventController::class, 'adminEdit'])->name('admin.events.edit');
        Route::put('/events/{event}', [EventController::class, 'adminUpdate'])->name('admin.events.update');
        Route::delete('/events/{event}', [EventController::class, 'adminDestroy'])->name('admin.events.destroy');
        Route::post('/events/{event}/approve', [EventController::class, 'approve'])->name('admin.events.approve');
        Route::post('/events/{event}/decline', [EventController::class, 'decline'])->name('admin.events.decline');
        // Admin Package Routes
        Route::get('/packages', [PackageController::class, 'adminIndex'])->name('admin.packages.index');
        Route::get('/packages/create', [PackageController::class, 'adminCreate'])->name('admin.packages.create');
        Route::post('/packages', [PackageController::class, 'adminStore'])->name('admin.packages.store');
        Route::get('/packages/{package}/edit', [PackageController::class, 'adminEdit'])->name('admin.packages.edit');
        Route::put('/packages/{package}', [PackageController::class, 'adminUpdate'])->name('admin.packages.update');
        Route::delete('/packages/{package}', [PackageController::class, 'adminDestroy'])->name('admin.packages.destroy');
    });



        // Admin routes
        Route::prefix('admin')->group(function () {
            // Admin Notifications Routes
            Route::get('/notifications', [AdminNotificationController::class, 'index'])->name('admin.notifications.index');
            Route::get('/notifications/create', [AdminNotificationController::class, 'create'])->name('admin.notifications.create');
            Route::post('/notifications', [AdminNotificationController::class, 'store'])->name('admin.notifications.store');
            Route::get('/notifications/{notification}', [AdminNotificationController::class, 'show'])->name('admin.notifications.show');
            Route::delete('/notifications/{notification}', [AdminNotificationController::class, 'destroy'])->name('admin.notifications.destroy');
        });
      
    });

Route::middleware(['auth'])->prefix('admin')->group(function () {
    // Admin Dashboard
    Route::get('/', [AdminController::class, 'index'])->name('admin.dashboard');
    
    // Admin Packages Routes
    Route::get('/packages', [PackageController::class, 'adminIndex'])->name('admin.packages.index');
    Route::post('/packages/{package}/approve', [PackageController::class, 'approve'])->name('admin.packages.approve');
    Route::post('/packages/{package}/decline', [PackageController::class, 'decline'])->name('admin.packages.decline');
});
