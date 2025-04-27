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
use App\Http\Controllers\CouponController;
use App\Http\Controllers\AdminAdminController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\DecoratorAuthController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AdminBookingController;

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

Route::get('/admin/login', function () {
    return view('admin-login');
})->name('admin.login');

Route::post('/admin/login', [AdminAuthController::class, 'login'])->name('admin.login.submit');

Route::get('/decorator/login', function () {
    return view('decorator-login');
})->name('decorator.login');

Route::post('/decorator/login', [DecoratorAuthController::class, 'login'])->name('decorator.login.submit');

Route::get('/decorator/register', function () {
    return view('decorator-register');
})->name('decorator.register');

Route::post('/decorator/register', [DecoratorAuthController::class, 'register'])->name('decorator.register.submit');

Route::middleware(['auth'])->group(function () {
    Route::get('/index', [MainController::class, 'index'])->name('home');
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.update-password');
});

Route::prefix('user')->middleware(['auth'])->group(function() {
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile');
    Route::get('/orders', [OrdersController::class, 'index'])->name('orders');
});

// Feedback and booking management routes
Route::post('/feedback/store', [FeedbackController::class, 'store'])->name('feedback.store')->middleware('auth');
Route::post('/bookings/cancel', [BookingController::class, 'cancel'])->name('bookings.cancel')->middleware('auth');

// Protected Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/index', [MainController::class, 'index'])->name('home');
    
    // Profile routes
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
    
    // Bookmarks route
    Route::get('/bookmarks', [App\Http\Controllers\BookmarkController::class, 'index'])->name('bookmarks');
    Route::post('/bookmarks/toggle', [BookmarkController::class, 'toggle'])->name('bookmarks.toggle');
    
    // Notifications routes
    Route::get('/notifications', [App\Http\Controllers\NotificationController::class, 'index'])->name('notifications');
    Route::post('/notifications/{notification}/read', [App\Http\Controllers\NotificationController::class, 'markAsRead'])->name('notifications.read');
    Route::delete('/notifications/{notification}', [App\Http\Controllers\NotificationController::class, 'destroy'])->name('notifications.destroy');
    Route::get('/notifications/{notification}', [App\Http\Controllers\NotificationController::class, 'show'])->name('notifications.show');
    

    // Cart routes
    Route::post('/cart/toggle', [CartController::class, 'toggle'])->name('cart.toggle');
    Route::get('/cart', [CartController::class, 'index'])->name('cart');
    Route::delete('/cart/{id}', [CartController::class, 'delete'])->name('cart.delete');
    
    // Checkout routes
    Route::post('/checkout/submit', [CheckoutController::class, 'submit'])->name('checkout.submit');
    Route::get('/congratulations', function () {
        return view('congratulations');
    })->name('congratulations');
    
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
}); // Closing brace for the auth middleware group starting on line 89
      
// Admin routes
Route::middleware(['web', 'auth:admin'])->prefix('admin')->group(function () {
    // Admin Dashboard
    Route::get('/', function() {
        return view('Admin.index');
    })->name('admin.index');
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');
    
    // Admin Profile Route
    Route::get('/profile', [AdminController::class, 'profile'])->name('admin.profile');
    Route::post('/profile', [AdminController::class, 'updateProfile'])->name('admin.profile.update');
    
    // Admin Management Routes
    Route::get('/admins', [AdminAdminController::class, 'index'])->name('admin.admins.index');
    Route::get('/admins/create', [AdminAdminController::class, 'create'])->name('admin.admins.create');
    Route::post('/admins', [AdminAdminController::class, 'store'])->name('admin.admins.store');
    Route::get('/admins/{admin}/edit', [AdminAdminController::class, 'edit'])->name('admin.admins.edit');
    Route::put('/admins/{admin}', [AdminAdminController::class, 'update'])->name('admin.admins.update');
    Route::delete('/admins/{admin}', [AdminAdminController::class, 'destroy'])->name('admin.admins.destroy');
    Route::get('/admins/{admin}', [AdminAdminController::class, 'show'])->name('admin.admins.show');
    
    // Admin Bookings Routes
    Route::get('/bookings', [AdminBookingController::class, 'index'])->name('admin.bookings.index');
    Route::get('/bookings/{id}', [AdminBookingController::class, 'show'])->name('admin.bookings.show');
    Route::put('/bookings/{id}/update-status', [AdminBookingController::class, 'updateStatus'])->name('admin.bookings.update-status');
    Route::put('/bookings/{id}/cancel', [AdminBookingController::class, 'cancel'])->name('admin.bookings.cancel');
    
    // Admin Packages Routes
    Route::get('/packages', [PackageController::class, 'adminIndex'])->name('admin.packages.index');
    Route::post('/packages/{package}/approve', [PackageController::class, 'approve'])->name('admin.packages.approve');
    Route::post('/packages/{package}/decline', [PackageController::class, 'decline'])->name('admin.packages.decline');

    // Admin Coupon Routes
    Route::get('/coupon/create', [CouponController::class, 'create'])->name('admin.coupon.create');
    Route::get('/coupon', [CouponController::class, 'index'])->name('admin.coupon.index');
    Route::post('/coupon', [CouponController::class, 'store'])->name('admin.coupon.store');
    Route::delete('/coupon/{promo_id}', [CouponController::class, 'destroy'])->name('admin.coupons.destroy');
    
    // Admin Contacts Routes
    Route::get('/contacts', [AdminContactController::class, 'index'])->name('admin.contacts.index');
    Route::get('/contacts/{contact}', [AdminContactController::class, 'show'])->name('admin.contacts.show');
    
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
    
    // Admin Events Routes
    Route::get('/events', [EventController::class, 'adminIndex'])->name('admin.events.index');
    Route::get('/events/create', [EventController::class, 'adminCreate'])->name('admin.events.create');
    Route::post('/events', [EventController::class, 'adminStore'])->name('admin.events.store');
    Route::get('/events/{event}/edit', [EventController::class, 'adminEdit'])->name('admin.events.edit');
    Route::put('/events/{event}', [EventController::class, 'adminUpdate'])->name('admin.events.update');
    Route::delete('/events/{event}', [EventController::class, 'adminDestroy'])->name('admin.events.destroy');
    Route::post('/events/{event}/approve', [EventController::class, 'approve'])->name('admin.events.approve');
    Route::post('/events/{event}/decline', [EventController::class, 'decline'])->name('admin.events.decline');
    
    // Admin Notifications Routes
    Route::get('/notifications', [AdminNotificationController::class, 'index'])->name('admin.notifications.index');
    Route::get('/notifications/create', [AdminNotificationController::class, 'create'])->name('admin.notifications.create');
    Route::post('/notifications', [AdminNotificationController::class, 'store'])->name('admin.notifications.store');
    Route::get('/notifications/{notification}', [AdminNotificationController::class, 'show'])->name('admin.notifications.show');
    Route::delete('/notifications/{notification}', [AdminNotificationController::class, 'destroy'])->name('admin.notifications.destroy');
});

// Decorator routes
Route::middleware(['web', 'auth:decorator'])->prefix('decorator')->group(function () {
    Route::get('/dashboard', [DecoratorController::class, 'dashboard'])->name('decorator.dashboard');
    Route::get('/logout', [DecoratorAuthController::class, 'logout'])->name('decorator.logout');
    
    // Decorator profile management
    Route::get('/profile', [DecoratorController::class, 'profile'])->name('decorator.profile');
    Route::post('/profile', [DecoratorController::class, 'updateProfile'])->name('decorator.profile.update');
    
    // Event management
    Route::get('/events', [DecoratorController::class, 'events'])->name('decorator.events');
    Route::get('/events/create', [DecoratorController::class, 'createEvent'])->name('decorator.events.create');
    Route::post('/events', [DecoratorController::class, 'storeEvent'])->name('decorator.events.store');
    Route::get('/events/{event}/edit', [DecoratorController::class, 'editEvent'])->name('decorator.events.edit');
    Route::put('/events/{event}', [DecoratorController::class, 'updateEvent'])->name('decorator.events.update');
    Route::delete('/events/{event}', [DecoratorController::class, 'destroyEvent'])->name('decorator.events.destroy');
    
    // Package management
    Route::get('/packages', [DecoratorController::class, 'packages'])->name('decorator.packages');
    Route::get('/packages/create', [DecoratorController::class, 'createPackage'])->name('decorator.packages.create');
    Route::post('/packages', [DecoratorController::class, 'storePackage'])->name('decorator.packages.store');
    Route::get('/packages/{package}/edit', [DecoratorController::class, 'editPackage'])->name('decorator.packages.edit');
    Route::put('/packages/{package}', [DecoratorController::class, 'updatePackage'])->name('decorator.packages.update');
    Route::delete('/packages/{package}', [DecoratorController::class, 'destroyPackage'])->name('decorator.packages.destroy');
    
    // Booking management
    Route::get('/bookings', [DecoratorController::class, 'bookings'])->name('decorator.bookings');
    Route::get('/bookings/{booking}', [DecoratorController::class, 'showBooking'])->name('decorator.bookings.show');
    Route::post('/bookings/{booking}/status', [DecoratorController::class, 'updateBookingStatus'])->name('decorator.bookings.status');
});
