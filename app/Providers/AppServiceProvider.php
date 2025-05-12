<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator; // <-- 1. Tambahkan use statement ini

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // <-- 2. Tambahkan baris ini di dalam method boot()
        Paginator::useBootstrapFive();

        /*
         * Catatan:
         * - Gunakan Paginator::useBootstrapFive(); jika AdminLTE Anda menggunakan Bootstrap 5 (versi lebih baru).
         * - Gunakan Paginator::useBootstrapFour(); jika AdminLTE Anda menggunakan Bootstrap 4 (umumnya AdminLTE 3).
         * - Gunakan Paginator::useBootstrap(); jika AdminLTE Anda menggunakan Bootstrap 3 (lebih jarang).
         * Coba salah satu, refresh halaman. Jika belum benar, coba ganti dengan yang lain.
         * useBootstrapFive() atau useBootstrapFour() adalah yang paling mungkin benar.
         */
    }
}