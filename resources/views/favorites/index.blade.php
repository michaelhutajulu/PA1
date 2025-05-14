@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center mb-4">
        <div class="col-md-8">
            <h3 class="fw-bold text-center mb-4">Produk Favorit Saya</h3>
        </div>
    </div>

    @if ($favorites->count() > 0)
    <div class="d-flex flex-wrap justify-content-center mx-n2" id="favorites-container">
        @foreach($favorites as $product)
            <div class="col-6 col-sm-4 col-md-3 mb-4 px-2 d-flex">
                {{-- ========================================================== --}}
                {{-- PERUBAHAN UTAMA ADA DI HREF INI --}}
                {{-- ========================================================== --}}
                <a href="{{ route('produk.detail.publik', $product->id) }}" 
                   onclick="sessionStorage.setItem('back_url', window.location.href)" 
                   class="text-decoration-none text-dark w-100">
                    <div class="card h-100 border-0 custom-card product-card">
                        <div class="image-container">
                            <img src="{{ asset('storage/' . $product->image) }}" class="product-image" 
                                alt="{{ $product->name }}">
                        </div>
                        <div class="card-body d-flex flex-column align-items-center">
                            <h5 class="card-title text-center">{{ $product->name }}</h5>
                            <p class="card-text text-primary fw-bold">Rp. {{ number_format($product->price, 0, ',', '.') }}</p>
                        </div>
                    </div>
                </a>
            </div>
        @endforeach
    </div>
    @else
        <div class="alert alert-info text-center py-4" id="empty-message">
            <i class="bi bi-heart fs-1 d-block mb-3"></i>
            <h5>Belum ada produk favorit.</h5>
            <p>Mulai tambahkan produk ke favorit Anda untuk melihatnya di sini.</p>
        </div>
    @endif
</div>

<!-- Add Bootstrap Icons CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">

<style>
    /* === Card style === */
    .custom-card {
        border-radius: 16px;
        background-color: #ffffffdd;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
        transition: all 0.5s ease;
        position: relative;
        z-index: 1;
        border: 1px solid transparent;
    }
    .custom-card:hover {
        transform: translateY(-10px) scale(1.03);
        box-shadow: 0 0 20px rgba(119, 121, 122, 0.5);
    }
    /* === Zoom image effect === */
    .image-container {
        overflow: hidden;
        border-top-left-radius: 16px;
        border-top-right-radius: 16px;
    }
    .product-image {
        height: 200px;
        object-fit: cover;
        transition: transform 0.4s ease;
        width: 100%;
    }
    .custom-card:hover .product-image {
        transform: scale(1.1);
    }
</style>
@endsection