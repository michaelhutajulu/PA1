@extends('layouts.app')

@section('content')
<style>
    .product-card {
        border-radius: 12px;
        background: #fff;
        overflow: hidden;
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.05), 
                    0 4px 6px -2px rgba(0, 0, 0, 0.02);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        border: 1px solid rgba(0, 0, 0, 0.05);
        position: relative;
        cursor: pointer;
        text-decoration: none;
        color: inherit;
        display: block;
    }

    .product-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1),
                    0 10px 10px -5px rgba(0, 0, 0, 0.04);
    }

    .card-image-container {
        height: 200px;
        overflow: hidden;
    }

    .product-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }

    .product-card:hover .product-image {
        transform: scale(1.07);
    }

    .card-content {
        padding: 16px;
        text-align: center;
    }

    .product-title {
        font-weight: 600;
        font-size: 1rem;
        color: #333;
        margin-bottom: 8px;
    }

    .price {
        color: #2563eb;
        font-weight: 600;
        font-size: 1.1rem;
    }
</style>

<div class="container mt-5">
    @if(session('error'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if($products->isEmpty() && $suggestion)
        <div class="alert alert-info text-center">
            <strong>Tidak ada hasil untuk:</strong> "{{ $query }}"<br>
            Mungkin maksud Anda:
            <a href="{{ route('search') }}?query={{ urlencode($suggestion) }}" class="text-decoration-underline">
                {{ $suggestion }}
            </a>
        </div>
    @endif

    @if($products->isEmpty() && !$suggestion)
        <p class="text-center">Produk <strong>"{{ $query }}"</strong> tidak ditemukan.</p>
    @endif

    @if(!$products->isEmpty())
        <div class="mb-3">
            <h5>Hasil pencarian untuk: <strong>{{ $query }}</strong></h5>
        </div>

        <div class="row">
            @foreach($products as $product)
                <div class="col-md-3 mb-4">
                    <a href="{{ route('products.show', $product->id) }}" class="product-card">
                        <div class="card-image-container">
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="product-image">
                        </div>
                        <div class="card-content">
                            <div class="product-title">{{ $product->name }}</div>
                            <div class="price">Rp. {{ number_format($product->price, 0, ',', '.') }}</div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
