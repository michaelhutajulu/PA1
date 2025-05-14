<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\StoreProfileController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SaranController;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\SearchController; // Pastikan ini di-import

// ==========================================
// 🔵 1. HALAMAN BERANDA UNTUK USER (dengan data produk)
// ==========================================
Route::get('/', [HomeController::class, 'index'])->name('home');

// BARU: Route untuk menampilkan detail produk ke publik.
Route::get('/produk/{product}', [ProductController::class, 'showPublic'])->name('produk.detail.publik');

Route::get('/katalog', [CatalogController::class, 'index'])->name('katalog.index');
Route::get('/katalog/{id}', [CatalogController::class, 'show'])->name('katalog.show');

Route::get('/profil-toko', [StoreProfileController::class, 'frontend'])->name('profil_toko');
Route::get('/search', [App\Http\Controllers\SearchController::class, 'index'])->name('search');

// ==========================================
// ❤️ FAVORITE (auth only)
// ==========================================
Route::middleware('auth')->group(function () {
    Route::post('/favorite/{product}', [FavoriteController::class, 'toggle'])->name('favorite.toggle');
    Route::get('/favorites', [FavoriteController::class, 'index'])->name('favorites.index');
    Route::get('/favorites', [FavoriteController::class, 'index'])->name('favorit.index'); // Alias, path sama
    Route::post('/saran/kirim', [SaranController::class, 'kirim'])->name('saran.kirim');
});

// ==========================================
// 🔒 2. DASHBOARD ADMIN (khusus user login & admin role)
// ==========================================
Route::get('/dashboard', function () {
    return view('admin.dashboard');
})->middleware(['auth', 'isadmin'])->name('dashboard');

// ==========================================
// 🧑‍💼 3. ADMIN ROUTES (CRUD Produk, Kategori, Store Profile)
// ==========================================
// ===================================================================================
// PERUBAHAN UTAMA ADA DI BARIS INI: Menambahkan ->name('admin.') pada grup
// ===================================================================================
Route::prefix('admin')->name('admin.')->middleware(['auth', 'isadmin'])->group(function () {
    // Dengan ->name('admin.'), Route::resource akan menghasilkan:
    // admin.products.index, admin.products.create, admin.products.store,
    // admin.products.show, admin.products.edit, admin.products.update, admin.products.destroy
    Route::resource('products', ProductController::class);
    Route::resource('categories', CategoryController::class); // Juga akan menjadi admin.categories.*

    // Route berikut juga akan diawali dengan 'admin.' karena ->name('admin.') pada grup
    // Kecuali jika nama route-nya sudah mengandung 'admin.' secara eksplisit
    Route::get('store_profile', [StoreProfileController::class, 'index'])->name('store_profile.index'); // Akan menjadi admin.store_profile.index
    Route::get('store_profile/create', [StoreProfileController::class, 'create'])->name('store_profile.create'); // admin.store_profile.create
    Route::post('store_profile', [StoreProfileController::class, 'store'])->name('store_profile.store'); // admin.store_profile.store
    Route::get('store_profile/edit', [StoreProfileController::class, 'edit'])->name('store_profile.edit'); // admin.store_profile.edit
    Route::put('store_profile', [StoreProfileController::class, 'update'])->name('store_profile.update'); // admin.store_profile.update

    // Route search admin, namanya 'admin.products.search' sudah sesuai dengan prefix grup
    Route::get('products/search', [ProductController::class, 'searchAdmin'])->name('products.search'); // Akan menjadi admin.products.search
});
// ===================================================================================
// AKHIR PERUBAHAN
// ===================================================================================

// ==========================================
// 🔐 4. AUTH ROUTES
// ==========================================
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::get('/forgot-password', [ForgotPasswordController::class, 'showVerifyForm'])->name('forgot.password');
Route::post('/forgot-password', [ForgotPasswordController::class, 'verifyUser'])->name('forgot.password.verify');
Route::get('/reset-password/{email}', [ForgotPasswordController::class, 'showResetForm'])->name('password.reset.form');
Route::post('/reset-password/{email}', [ForgotPasswordController::class, 'updatePassword'])->name('password.reset.update');