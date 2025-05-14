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

// ------------------------------------------------------------------------------------
// PERUBAHAN BAGIAN DETAIL PRODUK (FOKUS UTAMA)
// ------------------------------------------------------------------------------------
// Route lama yang menyebabkan masalah (URL publik dengan nama route admin) DIHAPUS:
// Route::get('/produk/{id}', [ProductController::class, 'show'])->name('admin.products.show');

// BARU: Route untuk menampilkan detail produk ke publik.
// Ini akan menggunakan method baru (misalnya showPublic) di ProductController.
// Menggunakan {product} untuk Route Model Binding jika ProductController@showPublic akan menerimanya.
// Jika ProductController@showPublic menerima {id}, maka tetap gunakan {id}.
// Untuk saat ini, kita akan asumsikan akan ada method showPublic yang menerima model Product.
Route::get('/produk/{product}', [ProductController::class, 'showPublic'])->name('produk.detail.publik');
// ------------------------------------------------------------------------------------

Route::get('/katalog', [CatalogController::class, 'index'])->name('katalog.index');
// Route detail produk via katalog. Jika CatalogController@show sudah benar untuk publik,
// ini bisa menjadi alternatif atau bahkan utama untuk detail produk publik.
// Tetap menggunakan {id} sesuai kode asli Anda.
Route::get('/katalog/{id}', [CatalogController::class, 'show'])->name('katalog.show');

Route::get('/profil-toko', [StoreProfileController::class, 'frontend'])->name('profil_toko');
// Menggunakan FQCN (Fully Qualified Class Name) untuk SearchController agar lebih eksplisit
Route::get('/search', [App\Http\Controllers\SearchController::class, 'index'])->name('search');

// ==========================================
// ❤️ FAVORITE (auth only)
// ==========================================
Route::middleware('auth')->group(function () {
    // Toggle favorite status
    Route::post('/favorite/{product}', [FavoriteController::class, 'toggle'])->name('favorite.toggle');

    // Menampilkan semua favorit user
    Route::get('/favorites', [FavoriteController::class, 'index'])->name('favorites.index'); // ✅ nama utama
    // Untuk alias, jika path sama, nama terakhir akan menimpa.
    // Jika ingin nama 'favorit.index' juga berfungsi dengan path yang sama, ini akan menimpa 'favorites.index'.
    // Jika path berbeda, baru bisa dua nama.
    // Saya akan membiarkan satu saja untuk kejelasan, atau jika ingin path berbeda:
    // Route::get('/favorit-saya', [FavoriteController::class, 'index'])->name('favorit.index');
    // Untuk saat ini, saya akan mengikuti kode asli Anda dengan komentar:
    Route::get('/favorites', [FavoriteController::class, 'index'])->name('favorit.index'); // ✅ alias (akan menimpa 'favorites.index' jika path sama)
    // Jika Anda ingin kedua nama route bekerja dengan path berbeda, salah satu path harus diubah. Misalnya:
    // Route::get('/favorit', [FavoriteController::class, 'index'])->name('favorit.index');

    // 💬 Kirim kritik & saran (hanya untuk user login)
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
Route::prefix('admin')->middleware(['auth', 'isadmin'])->group(function () {
    // Route::resource akan secara otomatis membuat route bernama 'admin.products.show'
    // yang mengarah ke ProductController@show dengan URL /admin/products/{product}
    Route::resource('products', ProductController::class);
    Route::resource('categories', CategoryController::class);

    Route::get('store_profile', [StoreProfileController::class, 'index'])->name('store_profile.index');
    Route::get('store_profile/create', [StoreProfileController::class, 'create'])->name('store_profile.create');
    Route::post('store_profile', [StoreProfileController::class, 'store'])->name('store_profile.store');
    Route::get('store_profile/edit', [StoreProfileController::class, 'edit'])->name('store_profile.edit');
    Route::put('store_profile', [StoreProfileController::class, 'update'])->name('store_profile.update');

    // ------------------------------------------------------------------------------------
    // KOREKSI PATH ADMIN SEARCH
    // ------------------------------------------------------------------------------------
    // Path diubah dari '/admin/products/search' menjadi 'products/search'
    // karena sudah ada prefix 'admin' di grup. URL akhir akan menjadi /admin/products/search
    Route::get('products/search', [ProductController::class, 'searchAdmin'])->name('admin.products.search');
    // ------------------------------------------------------------------------------------
});

// ==========================================
// 🔐 4. AUTH ROUTES
// ==========================================
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

// Form untuk verifikasi nama dan email
Route::get('/forgot-password', [ForgotPasswordController::class, 'showVerifyForm'])->name('forgot.password');

// Proses verifikasi nama dan email
Route::post('/forgot-password', [ForgotPasswordController::class, 'verifyUser'])->name('forgot.password.verify');

// Form ubah password (jika nama & email valid)
Route::get('/reset-password/{email}', [ForgotPasswordController::class, 'showResetForm'])->name('password.reset.form');

// Proses update password baru
Route::post('/reset-password/{email}', [ForgotPasswordController::class, 'updatePassword'])->name('password.reset.update');