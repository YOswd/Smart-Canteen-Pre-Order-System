<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\FoodController;
use App\Http\Controllers\OrderController;

Route::get('/', function () {
    return view('index');
});

// Registration
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

// Login
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

// Logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add/{food}', [CartController::class, 'add'])->name('cart.add');
    Route::post('/cart/remove/{food}', [CartController::class, 'remove'])->name('cart.remove');
    Route::post('/cart/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
    Route::post('/cart/checkout/{food}', [CartController::class, 'checkoutSingle'])->name('cart.checkout.single');

    // User Orders
    Route::get('/my-orders', [OrderController::class, 'index'])->name('my-orders');
});

// Admin routes
Route::middleware(['auth', function ($request, $next) {
    if (auth()->user()->role !== 'admin') {
        abort(403, 'Unauthorized action.');
    }
    return $next($request);
}])->group(function () {
    Route::get('/manage-orders', [OrderController::class, 'manage'])->name('admin.orders');
    Route::patch('/orders/{order}/status', [OrderController::class, 'updateStatus'])->name('orders.status');
});

Route::get('/menu', [FoodController::class, 'menu'])->name('menu');
