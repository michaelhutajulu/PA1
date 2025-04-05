<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\StoreProfileController;
use App\Http\Controllers\AuthController;

// Dashboard untuk admin
Route::get('/dashboard', function () {
    return view('admin.dashboard');
})->name('dashboard');

// Group route untuk admin
Route::prefix('admin')->middleware('auth')->group(function () {
    Route::resource('products', ProductController::class);
    Route::resource('categories', CategoryController::class);

    // Route manual untuk Store Profile (karena hanya ada 1 data)
    Route::get('store_profile', [StoreProfileController::class, 'index'])->name('store_profile.index');
    Route::get('store_profile/create', [StoreProfileController::class, 'create'])->name('store_profile.create');
    Route::post('store_profile', [StoreProfileController::class, 'store'])->name('store_profile.store');
    Route::get('store_profile/edit', [StoreProfileController::class, 'edit'])->name('store_profile.edit');
    Route::put('store_profile', [StoreProfileController::class, 'update'])->name('store_profile.update');
});

// Auth Routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
