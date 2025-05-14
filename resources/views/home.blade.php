@extends('layouts.app')

@section('content')
<div class="container mt-4 position-relative">

    {{-- 👇 ***** HAPUS ATAU KOMENTARI BLOK NOTIFIKASI INI ***** 👇 --}}
    {{--
    @if (session('status'))
        <div class="alert alert-success alert-dismissible fade show fixed-top m-3" role="alert" id="status-notification" style="z-index: 1056;">
            {{ session('status') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    --}}
    {{-- 👆 ***** AKHIR BLOK YANG DIHAPUS/DIKOMENTARI ***** 👆 --}}


    {{-- Banner --}}
    <div class="position-relative mb-5">
        <img src="{{ asset('storage/dashboard/banner.jpg') }}"
             class="img-fluid w-100 rounded shadow"
             alt="Banner Toko"
             style="max-height: 450px; object-fit: cover;">

        <div class="position-absolute top-50 start-0 translate-middle-y text-white ps-4 pe-5 py-3 banner-caption">
            <h2 class="fw-bold mb-1">Pilihan Terbaik untuk Elektronik dan Perabotan Rumah</h2>
        </div>
    </div>

    {{-- Cari Produk --}}
    <h4 class="fw-bold text-center mb-4">Mau cari apa hari ini?</h4>

    <div class="row justify-content-center mb-5">
        @foreach($featuredProducts as $product)
        <div class="col-sm-6 col-md-4 col-lg-3 mb-4">
            <a href="{{ route('admin.products.show', $product->id) }}" class="text-decoration-none text-dark">
                <div class="featured-card h-100 fade-in">
                    <div class="image-container">
                        <img src="{{ asset('storage/' . $product->image) }}"
                             class="product-image"
                             alt="{{ $product->name }}">
                    </div>
                    <div class="card-body text-center">
                        <h4 class="card-title fw-bold mb-2">{{ $product->name }}</h4>
                        <h5 class="mb-0 text-primary">Rp {{ number_format($product->price, 0, ',', '.') }}</h5>
                    </div>
                </div>
            </a>
        </div>
        @endforeach
    </div>

    {{-- Produk Per Kategori --}}
    <h4 class="fw-bold text-center mb-4">Produk</h4>
    <div class="d-flex flex-wrap justify-content-center mx-n2">
    @foreach($productsPerCategory as $product)
        <div class="col-6 col-sm-6 col-md-4 col-lg-3 mb-4 px-2 d-flex">
            <a href="{{ route('admin.products.show', $product->id) }}" class="text-decoration-none text-dark w-100">
                <div class="featured-card h-100 fade-in">
                    <div class="image-container">
                        <img src="{{ asset('storage/' . $product->image) }}"
                             class="product-image"
                             alt="{{ $product->name }}">
                    </div>
                    <div class="card-body text-center">
                        <h4 class="card-title fw-bold mb-2">{{ $product->name }}</h4>
                        <h5 class="mb-0 text-primary">Rp {{ number_format($product->price, 0, ',', '.') }}</h5>
                    </div>
                </div>
            </a>
        </div>
    @endforeach
    </div>

</div>
@endsection

@push('scripts')
<script>
    // Fungsi openLoginModalCustom tidak lagi diperlukan di sini jika toggleLoginModal sudah global
    // dan bisa diakses. Kita akan memanggil toggleLoginModal langsung.

    document.addEventListener('DOMContentLoaded', function() {
        // Tidak ada lagi logika untuk statusNotification di sini

        @if (session('open_login_modal'))
            console.log("Session 'open_login_modal' terdeteksi.");

            // Panggil fungsi global untuk membuka modal
            if (typeof window.toggleLoginModal === 'function') {
                window.toggleLoginModal(); // Buka modal menggunakan fungsi aslinya
                console.log("Modal login dipanggil via toggleLoginModal().");
            } else {
                console.error("Fungsi global 'toggleLoginModal' tidak ditemukan. Pastikan sudah termuat dari script modal.");
                // Fallback jika toggleLoginModal tidak ada (kurang ideal)
                const modalLoginElement = document.getElementById('modalLogin');
                if (modalLoginElement) modalLoginElement.style.display = 'flex';
            }

            // Periksa apakah ada pesan status dari reset password
            @if (session('status_from_password_reset'))
                const successMessage = "{{ session('status_from_password_reset') }}";
                console.log("Pesan sukses reset password: " + successMessage);
                // Panggil fungsi global untuk menampilkan notifikasi di dalam modal
                if (typeof window.showLoginModalSuccessNotification === 'function') {
                    window.showLoginModalSuccessNotification(successMessage);
                } else {
                    console.error("Fungsi global 'showLoginModalSuccessNotification' tidak ditemukan.");
                    // Fallback jika fungsi tidak ada
                    alert(successMessage);
                }
            @endif
        @endif
    });
</script>
@endpush