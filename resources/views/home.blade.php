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
            <h2 class="fw-bold mb-1">Bintang Serasi</h2>
            <p class="fs-5 mb-0">Tempat Terbaik Mencari Elektronik</p>
        </div>
    </div>

    {{-- Produk Unggulan --}}
    <h3 class="fw-bold mb-4 text-center">Produk Unggulan</h3>
    <div class="row">
        @foreach($products as $product)
        <div class="col-sm-6 col-md-4 col-lg-3 mb-4">
            <div class="card custom-card h-100 position-relative overflow-hidden fade-in">
                <div class="shine-overlay"></div>
                <div class="image-container">
                    <img src="{{ asset('storage/' . $product->image) }}" 
                         class="card-img-top product-image" 
                         alt="{{ $product->name }}">
                </div>
                <div class="card-body text-center">
                    <h5 class="card-title mb-2">{{ $product->name }}</h5>
                    <p class="text-muted">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                    <a href="{{ route('admin.products.show', $product->id) }}" 
                       class="btn btn-outline-primary btn-sm">Detail</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>

</div>


@endsection
