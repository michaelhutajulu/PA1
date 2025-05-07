@extends('layouts.app')

@section('content')
<div class="container mt-4 position-relative">

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
                        {{-- MODIFIKASI HARGA PRODUK (tambah warna biru) --}}
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
                        {{-- MODIFIKASI HARGA PRODUK (tambah warna biru) --}}
                        <h5 class="mb-0 text-primary">Rp {{ number_format($product->price, 0, ',', '.') }}</h5>
                    </div>
                </div>
            </a>
        </div>
    @endforeach
    </div>

</div>
@endsection