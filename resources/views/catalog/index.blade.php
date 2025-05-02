@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h3 class="fw-bold text-center mb-5">Kategori Produk</h3>
    
    <div class="d-flex flex-wrap justify-content-center mx-n2">
    @foreach ($categories as $category)
        <div class="col-6 col-sm-4 col-md-3 mb-4 px-2 d-flex">
            <a href="{{ route('katalog.show', $category->id) }}" class="text-decoration-none text-dark w-100">
                <div class="card product-card h-100" data-category="{{ $category->name }}">
                    <div class="card-shine"></div>
                    <div class="card-inner">
                        <div class="p-3 d-flex justify-content-center align-items-center" style="height: 200px;">
                            <img src="{{ asset('storage/' . $category->image) }}" class="card-img" alt="{{ $category->name }}">
                        </div>
                        <div class="card-body text-center">
                            <h5 class="fw-semibold">{{ $category->name }}</h5>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    @endforeach
</div>


<style>
    .product-card {
        border-radius: 20px;
        background: rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
        border: 1px solid rgba(255, 255, 255, 0.3);
        transition: all 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        position: relative;
        overflow: hidden;
        z-index: 1;
    }
    
    .product-card:hover {
        transform: translateY(-15px);
        box-shadow: 0 15px 35px rgba(22, 119, 255, 0.2);
    }
    
    .card-inner {
        height: 100%;
        width: 100%;
        position: relative;
        z-index: 3;
        background: transparent;
        display: flex;
        flex-direction: column;
    }
    
    .card-img {
        max-height: 150px;
        object-fit: contain;
        transform: translateY(0);
        transition: transform 0.5s ease-out;
        filter: drop-shadow(0 5px 15px rgba(0,0,0,0.1));
    }
    
    .product-card:hover .card-img {
        transform: translateY(-10px) scale(1.05);
    }
    
    .card-shine {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(
            135deg,
            rgba(255, 255, 255, 0.4) 0%,
            rgba(255, 255, 255, 0) 60%
        );
        z-index: 2;
        opacity: 0;
        transition: opacity 0.5s ease;
        border-radius: 20px;
        pointer-events: none;
    }
    
    .product-card:hover .card-shine {
        opacity: 1;
    }
    
    .product-card::after {
        content: "";
        position: absolute;
        inset: 0;
        background: linear-gradient(to right, #4facfe 0%, #00f2fe 100%);
        opacity: 0;
        z-index: -1;
        transition: opacity 0.5s ease;
        border-radius: 20px;
    }
    
    .product-card:hover::after {
        opacity: 0.05;
    }
    
    .card-detail {
        display: flex;
        justify-content: center;
        align-items: center;
        margin-top: 10px;
        opacity: 0;
        transform: translateY(20px);
        transition: all 0.4s ease;
    }
    
    .product-card:hover .card-detail {
        opacity: 1;
        transform: translateY(0);
    }
    
    .view-details {
        font-size: 0.85rem;
        font-weight: 500;
        color: #4facfe;
    }
    
    .card-icon {
        display: inline-block;
        margin-left: 5px;
        transform: translateX(0);
        transition: transform 0.3s ease;
    }
    
    .product-card:hover .card-icon {
        transform: translateX(5px);
    }
    
    /* Adding subtle entry animation for initial load */
    @keyframes cardEntrance {
        from {
            opacity: 0;
            transform: translateY(25px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    .col-md-3 {
        opacity: 0;
        animation: cardEntrance 0.6s forwards;
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
    cards.forEach(card => {                        
            // Update shine position
            const shine = this.querySelector('.card-shine');
            shine.style.opacity = '1';
            shine.style.background = `radial-gradient(circle at ${x}px ${y}px, rgba(255,255,255,0.8) 0%, rgba(255,255,255,0) 70%)`;
        });
        
        // Reset card on mouse leave
        card.addEventListener('mouseleave', function() {
            this.style.transform = '';
            const shine = this.querySelector('.card-shine');
            shine.style.opacity = '0';
        });
        
        // Add click feedback effect
        card.addEventListener('mousedown', function() {
            this.style.transform = 'perspective(1000px) scale(0.95) translateY(-10px)';
        });
        
        card.addEventListener('mouseup', function() {
            this.style.transform = 'perspective(1000px) scale(1) translateY(-15px)';
        });
    });
        
    // Add custom floating keyframes
    const style = document.createElement('style');
    style.textContent = ``;
    document.head.appendChild(style);
    
    // Optional: Add click event for better mobile experience
    cards.forEach(card => {
        card.addEventListener('click', function(e) {
            // Add a ripple effect
            const ripple = document.createElement('div');
            ripple.classList.add('ripple');
            this.appendChild(ripple);
            
            const rect = this.getBoundingClientRect();
            const x = e.clientX - rect.left;
            const y = e.clientY - rect.top;
            
            ripple.style.left = `${x}px`;
            ripple.style.top = `${y}px`;
            
            setTimeout(() => {
                ripple.remove();
            }, 600);
        });
    });
    
</script>
@endsection