<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\FoodController;

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
});

Route::get('/menu', [FoodController::class, 'menu'])->name('menu');

Route::view('/my-orders', 'orders.my_orders');