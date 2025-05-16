<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ReservationController;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Auth\CustomAuthenticatedSessionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\AboutUsController;
use App\Models\AboutUs;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\OrderItemController;
use App\Http\Controllers\Auth\CustomRegisteredUserController;
use App\Http\Controllers\SpecialController;
use App\Http\Controllers\CartController;



// Public route accessible without authentication
// Route::get('/', function () {


// Route::get('/test', function () {
//     return (new ItemController)->store(request());
// });



   
// });


Route::get('/', [HomeController::class, 'index']);

Route::post('/place-order', [HomeController::class, 'placeOrder'])->name('placeOrder');



// In routes/web.php
Route::get('/getItemsByCategory', [HomeController::class, 'getItemsByCategory'])->name('getItemsByCategory');

// Login and Logout routes
Route::post('/login', [CustomAuthenticatedSessionController::class, 'store'])->name('login');
Route::post('/logout', [CustomAuthenticatedSessionController::class, 'destroy'])->name('logout');

// Register Route
Route::get('register', function () {
    return view('auth.register');  // This is your custom register.blade.php view
})->name('register');

// Handle the form submission for custom registration
Route::post('register', [CustomRegisteredUserController::class, 'register']);
// Handle the registration form submission



// Reservations routes (these routes require authentication)
Route::middleware(['auth:sanctum', 'verified'])->group(function () {

    //Reservations Routes
    Route::get('reservations', [ReservationController::class, 'index'])->name('reservations');
    Route::get('reservations/create', [ReservationController::class, 'create'])->name('reservations.create');
    Route::post('reservations', [ReservationController::class, 'store'])->name('reservations.store');
    Route::get('reservations/{id}/edit', [ReservationController::class, 'edit'])->name('reservations.edit');


    Route::get('/orders', [OrderItemController::class, 'index'])->name('orders');
    Route::get('/create', [OrderItemController::class, 'create'])->name('order_items.create');
    Route::post('/store', [OrderItemController::class, 'store'])->name('orders.store');
    Route::get('/{orderItem}/edit', [OrderItemController::class, 'edit'])->name('edit');
    Route::put('/{orderItem}', [OrderItemController::class, 'update'])->name('update');
    Route::delete('/{orderItem}', [OrderItemController::class, 'destroy'])->name('destroy');

       // User Management routes
    Route::get('users', [UserController::class, 'index'])->name('users.index'); // List all users
    Route::get('users/create', [UserController::class, 'create'])->name('users.create'); // Show create user form      Route::post('users', [UserController::class, 'store'])->name('users.store'); // Store a new user
    Route::get('users/{id}/edit', [UserController::class, 'edit'])->name('users.edit'); // Show edit user form
    Route::put('users/{id}', [UserController::class, 'update'])->name('users.update'); // Update user
    Route::post('users/{id}/deactivate', [UserController::class, 'deactivate'])->name('users.deactivate'); // Deactivate user

       // Role Management routes
    Route::get('roles', [RoleController::class, 'index'])->name('roles.index'); // List all roles
    Route::get('roles/create', [RoleController::class, 'create'])->name('roles.create'); // Show create role form
    Route::post('roles', [RoleController::class, 'store'])->name('roles.store'); // Store a new role
    Route::get('roles/{id}/edit', [RoleController::class, 'edit'])->name('roles.edit'); // Show edit role form
    Route::put('roles/{id}', [RoleController::class, 'update'])->name('roles.update'); // Update role
 

    Route::get('/items-by-category', [HomeController::class, 'getItemsByCategory'])->name('items.byCategory');


    Route::get('/about-us/create', [AboutUsController::class, 'create'])->name('about-us.create');
    Route::post('/about-us', [AboutUsController::class, 'store'])->name('about-us.store');
    Route::get('/about-us/index', [AboutUsController::class, 'index'])->name('about-us.index');
    Route::get('about-us/{id}/edit', [AboutUsController::class, 'edit'])->name('about-us.edit');
    Route::put('about-us/{id}', [AboutUsController::class, 'update'])->name('about-us.update');



    Route::get('/items', [ItemController::class, 'index'])->name('items.index');
    Route::get('/items/create', [ItemController::class, 'create'])->name('items.create');
    Route::post('/items', [ItemController::class, 'store'])->name('items.store');
    Route::get('/items/{item}/edit', [ItemController::class, 'edit'])->name('items.edit');
    Route::put('/items/{item}', [ItemController::class, 'update'])->name('items.update');
    Route::delete('/items/{item}', [ItemController::class, 'destroy'])->name('items.destroy');


    Route::get('categories', [CategoryController::class, 'index'])->name('categories.index');
    Route::get('/categories/create', [CategoryController::class, 'createOrEdit'])->name('categories.create');
    Route::get('/categories/{id}/edit', [CategoryController::class, 'createOrEdit'])->name('categories.edit');
    Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
    Route::put('/categories/{id}', [CategoryController::class, 'update'])->name('categories.update');
    Route::delete('categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');



    Route::get('specials', [SpecialController::class, 'index'])->name('specials.index');
    Route::get('specials/create', [SpecialController::class, 'create'])->name('specials.create');
    Route::post('specials', [SpecialController::class, 'store'])->name('specials.store');
    Route::get('specials/{special}/edit', [SpecialController::class, 'edit'])->name('specials.edit');
    Route::put('specials/{special}', [SpecialController::class, 'update'])->name('specials.update');
    Route::delete('specials/{special}', [SpecialController::class, 'destroy'])->name('specials.destroy');




    Route::any('/cart/add', [CartController::class, 'addToCart'])->name('cart.add');


    Route::any('/checkout', [CartController::class, 'checkout'])->name('checkout');



    Route::resource('reviews', ReviewController::class)->except(['show']);

    // Dashboard route (requires authentication)
    Route::get('/dashboard', function () {
        Log::info('User accessing dashboard', ['user' => auth()->user()]);
        return view('admin.admin');
    })->name('dashboard');
});
