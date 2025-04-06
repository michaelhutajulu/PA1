@extends('layouts.app')

@section('content')
<div class="container mt-4">

    {{-- Banner dengan Teks di Atasnya --}}
    <div class="position-relative mb-5">
        <img src="{{ asset('storage/dashboard/banner.jpg') }}" class="img-fluid w-100 rounded shadow" alt="Banner Toko" style="max-height: 450px; object-fit: cover;">
        <div class="position-absolute top-50 start-0 translate-middle-y text-white px-4" style="background: rgba(0, 0, 0, 0.4); border-radius: 10px;">
            <h2 class="fw-bold">Bintang Serasi</h2>
            <p class="fs-5">Tempat Terbaik Mencari Elektronik</p>
        </div>
    </div>

    {{-- Produk Unggulan --}}
    <h3 class="fw-bold mb-4 text-center">Produk Unggulan</h3>
    <div class="row">
        @foreach($products as $product)
        <div class="col-md-3 mb-4">
            <div class="card shadow-sm h-100">
                <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top" alt="{{ $product->name }}" style="height: 200px; object-fit: cover;">
                <div class="card-body text-center">
                    <h5>{{ $product->name }}</h5>
                    <p class="text-muted">Rp. {{ number_format($product->price, 0, ',', '.') }}</p>
                    <a href="{{ route('admin.products.show', $product->id) }}" class="btn btn-outline-primary btn-sm">Detail</a>
                    </div>
            </div>
        </div>
        @endforeach
    </div>

</div>
@endsection
