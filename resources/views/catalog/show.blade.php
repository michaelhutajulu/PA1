@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h3 class="fw-bold text-center mb-5">Produk Kategori: {{ $category->name }}</h3>
    
    @if ($products->count() > 0)
    <div class="row">
    @foreach($products as $product)
    <div class="col-md-3 mb-4">
        <a href="{{ route('admin.products.show', $product->id) }}" class="text-decoration-none text-dark">
            <div class="product-card h-100">
                <div class="card-image-container">
                    <img src="{{ asset('storage/' . $product->image) }}" class="product-image" alt="{{ $product->name }}">
                </div>
                <div class="card-content">
                    <h5 class="product-title">{{ $product->name }}</h5>
                    <div class="price">Rp. {{ number_format($product->price, 0, ',', '.') }}</div>
                    <!-- Menghapus tombol "Detail" karena seluruh card sudah menjadi link -->
                </div>
            </div>
        </a>
    </div>
    @endforeach
</div>

    @else
        <div class="alert alert-info text-center">
            Belum ada produk dalam kategori ini.
        </div>
    @endif
</div>

<style>
    .product-card {
        border-radius: 12px;
        background: #fff;
        overflow: hidden;
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.05), 0 4px 6px -2px rgba(0, 0, 0, 0.02);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        border: 1px solid rgba(0, 0, 0, 0.05);
        position: relative;
    }
    
    .product-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
    }
    
    .card-image-container {
        height: 200px;
        position: relative;
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
    
    .quick-view {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.3);
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transition: opacity 0.3s ease;
    }
    
    .product-card:hover .quick-view {
        opacity: 1;
    }
    
    .btn-view {
        background-color: #fff;
        color: #333;
        padding: 8px 16px;
        border-radius: 4px;
        text-decoration: none;
        font-weight: 500;
        font-size: 14px;
        transition: all 0.2s ease;
        transform: translateY(10px);
    }
    
    .product-card:hover .btn-view {
        transform: translateY(0);
    }
    
    .btn-view:hover {
        background-color: #f8f9fa;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }
    
    .card-content {
        padding: 16px;
        display: flex;
        flex-direction: column;
        align-items: center;
    }
    
    .product-title {
        margin-bottom: 10px;
        font-weight: 600;
        text-align: center;
        font-size: 1rem;
        color: #333;
    }
    
    .price {
        color: #2563eb;
        font-weight: 600;
        font-size: 1.1rem;
        margin-bottom: 12px;
    }
    
    .detail-link {
        text-decoration: none;
        color: #6b7280;
        font-size: 0.875rem;
        display: flex;
        align-items: center;
        gap: 4px;
        transition: color 0.2s ease;
        margin-top: auto;
    }
    
    .detail-link:hover {
        color: #2563eb;
    }
    
    .arrow-icon {
        display: inline-block;
        transition: transform 0.2s ease;
    }
    
    .detail-link:hover .arrow-icon {
        transform: translateX(3px);
    }
    
    /* Entry animation */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    .col-md-3 {
        opacity: 0;
        animation: fadeInUp 0.5s ease forwards;
    }
    
    @media (prefers-reduced-motion: no-preference) {
        .col-md-3:nth-child(1) { animation-delay: 0.1s; }
        .col-md-3:nth-child(2) { animation-delay: 0.2s; }
        .col-md-3:nth-child(3) { animation-delay: 0.3s; }
        .col-md-3:nth-child(4) { animation-delay: 0.4s; }
        .col-md-3:nth-child(n+5) { animation-delay: 0.5s; }
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Simple hover animation enhancement
    const productCards = document.querySelectorAll('.product-card');
    
    productCards.forEach(card => {
        // Enhanced hover effect
        card.addEventListener('mouseenter', function() {
            // Add subtle shadow pulse
            this.classList.add('pulse-shadow');
        });
        
        card.addEventListener('mouseleave', function() {
            this.classList.remove('pulse-shadow');
        });
        
        // Add click effect
        card.addEventListener('mousedown', function() {
            this.style.transform = 'translateY(-5px) scale(0.98)';
        });
        
        card.addEventListener('mouseup', function() {
            this.style.transform = 'translateY(-8px) scale(1)';
        });
    });
    
</script>
@endsection