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

    {{-- Garis pemisah --}}
    <hr class="my-5">

    {{-- Lokasi dan Form Saran --}}
    <div class="row text-white" style="background-color: #0d3b66; padding: 40px 20px; border-radius: 15px;">
        <div class="col-md-6 mb-3">
            <h4>Lokasi Bintang Serasi</h4>
            <iframe src="https://www.google.com/maps/embed?pb=..." width="100%" height="300" style="border:0;" allowfullscreen loading="lazy"></iframe>
        </div>
        <div class="col-md-6">
            <h4>Beri Saran untuk Kami</h4>
            <form action="{{ route('saran.store') }}" method="POST">
                @csrf
                <input type="text" name="name" class="form-control mb-2" placeholder="Nama Anda" required>
                <textarea name="message" class="form-control mb-2" rows="4" placeholder="Saran Anda..." required></textarea>
                <button class="btn btn-light">Kirim</button>
            </form>
        </div>
    </div>

</div>
@endsection
