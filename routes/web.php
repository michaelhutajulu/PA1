<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\StoreProfileController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\SaranController;
use App\Http\Controllers\CatalogController;



// ==========================================
// 🔵 1. HALAMAN BERANDA UNTUK USER (dengan data produk)
// ==========================================
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/produk/{id}', [ProductController::class, 'show'])->name('admin.products.show');
Route::get('/katalog', [CatalogController::class, 'index'])->name('katalog.index');
Route::get('/katalog/{id}', [CatalogController::class, 'show'])->name('katalog.show');
Route::get('/profil-toko', [StoreProfileController::class, 'frontend'])->name('profil_toko');

// NOTE: Jangan lupa buat HomeController & method index()

// ==========================================
// 🔒 2. DASHBOARD ADMIN (khusus user login & admin role)
// ==========================================
Route::get('/dashboard', function () {
    return view('admin.dashboard');
})->middleware(['auth', 'isadmin'])->name('dashboard');
// NOTE: Kita akan buat middleware is_admin agar hanya admin yg bisa akses

// ==========================================
// 🧑‍💼 3. ADMIN ROUTES (CRUD Produk, Kategori, Store Profile)
// ==========================================
Route::prefix('admin')->middleware(['auth', 'isadmin'])->group(function () {
    Route::resource('products', ProductController::class);
    Route::resource('categories', CategoryController::class);

    Route::get('store_profile', [StoreProfileController::class, 'index'])->name('store_profile.index');
    Route::get('store_profile/create', [StoreProfileController::class, 'create'])->name('store_profile.create');
    Route::post('store_profile', [StoreProfileController::class, 'store'])->name('store_profile.store');
    Route::get('store_profile/edit', [StoreProfileController::class, 'edit'])->name('store_profile.edit');
    Route::put('store_profile', [StoreProfileController::class, 'update'])->name('store_profile.update');
});

// ==========================================
// 🔐 4. AUTH ROUTES
// ==========================================
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
