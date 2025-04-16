@extends('layouts.app')

@section('content')
<div class="container mt-5">

    {{-- Tampilkan pesan error jika ada --}}
    @if(session('error'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- Tampilkan saran jika tidak ada hasil dan ada rekomendasi --}}
    @if($products->isEmpty() && isset($suggestion))
        <div class="alert alert-info text-center">
            Mungkin maksud Anda:
            <a href="{{ route('search') }}?query={{ urlencode($suggestion) }}" class="text-decoration-underline">
                {{ $suggestion }}
            </a>
        </div>
    @endif

    {{-- Tampilkan produk jika ada --}}
    @if($products->isEmpty())
        <p class="text-center">Produk tidak ditemukan.</p>
    @else
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
    @endif
</div>
@endsection
