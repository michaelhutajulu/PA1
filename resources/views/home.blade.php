@extends('layouts.app')

@section('content')
<div class="container mt-4 position-relative">

    {{-- ========================== BANNER UTAMA ========================== --}}
    <div class="position-relative mb-5">
        <img src="{{ asset('storage/dashboard/banner.jpg') }}"
             class="img-fluid w-100 rounded shadow"
             alt="Banner Toko"
             style="max-height: 450px; object-fit: cover;">
        <div class="position-absolute top-50 start-0 translate-middle-y text-white ps-4 pe-5 py-3 banner-caption">
            <h2 class="fw-bold mb-1">Pilihan Terbaik untuk Elektronik dan Perabotan Rumah</h2>
        </div>
    </div>

    {{-- ========================== JUDUL ========================== --}}
    <h3 class="fw-bold text-center mb-5">Mau cari apa hari ini?</h3>

    {{-- ========================== PRODUK BERDASARKAN KATEGORI ========================== --}}
    @foreach($productsByCategories as $categoryName => $products)
        @if($products->isNotEmpty())
        <div class="category-section mb-5">

            {{-- Nama Kategori --}}
            <h4 class="fw-bold mb-3 text-center">{{ $categoryName }}</h4>

            {{-- SLIDER PRODUK --}}
            <div class="slider-wrapper position-relative">

                {{-- Tombol panah kiri --}}
                <button class="slider-arrow prev-arrow" aria-label="Produk Sebelumnya">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                         fill="currentColor" class="bi bi-chevron-left" viewBox="0 0 16 16">
                         <path fill-rule="evenodd" d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z"/>
                    </svg>
                </button>

                {{-- Isi slider --}}
                <div class="css-slider">
                    @foreach($products->take(6) as $product)
                    <div class="css-slider-item">
                        <a href="{{ route('produk.detail.publik', $product->id) }}"
                           class="text-decoration-none text-dark d-block h-100">
                            <div class="featured-card h-100">
                                <div class="image-container">
                                    <img src="{{ asset('storage/' . $product->image) }}"
                                         class="product-image"
                                         alt="{{ $product->name }}">
                                </div>
                                <div class="card-body text-center">
                                    <h4 class="card-title fw-bold mb-2">{{ $product->name }}</h4>
                                    <h5 class="mb-0 text-primary">
                                        Rp {{ number_format($product->price, 0, ',', '.') }}
                                    </h5>
                                </div>
                            </div>
                        </a>
                    </div>
                    @endforeach
                </div>

                {{-- Tombol panah kanan --}}
                <button class="slider-arrow next-arrow" aria-label="Produk Berikutnya">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                         fill="currentColor" class="bi bi-chevron-right" viewBox="0 0 16 16">
                         <path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z"/>
                    </svg>
                </button>

            </div>
        </div>
        @endif
    @endforeach

    {{-- ========================== JIKA TIDAK ADA PRODUK ========================== --}}
    @if($productsByCategories->isEmpty())
        <div class="text-center my-5">
            <h4 class="fw-bold text-center mb-4">Mau cari apa hari ini?</h4>
            <p>Belum ada produk untuk ditampilkan.</p>
        </div>
    @endif

</div>
@endsection

{{-- ========================== BAGIAN CSS ========================== --}}
@push('styles')
<style>
    /* Container utama slider */
    .css-slider {
        display: flex;
        overflow-x: auto;
        scroll-snap-type: x mandatory;
        -webkit-overflow-scrolling: touch;
        scroll-behavior: smooth;
        gap: 1.5rem;
        padding: 0.25rem;
    }

    .css-slider::-webkit-scrollbar {
        display: none;
    }

    .css-slider {
        -ms-overflow-style: none;
        scrollbar-width: none;
    }

    /* Item di dalam slider */
    .css-slider-item {
        scroll-snap-align: start;
        flex-shrink: 0;
        width: calc(100% / 4 - 1.125rem); /* Untuk 4 item di layar besar */
    }

    /* Responsif */
    @media (max-width: 1199px) {
        .css-slider-item { width: calc(100% / 3 - 1rem); }
    }
    @media (max-width: 767px) {
        .css-slider-item { width: calc(100% / 2 - 0.75rem); }
    }
    @media (max-width: 575px) {
        .css-slider-item { width: 70%; }
    }

    /* Tombol navigasi slider */
    .slider-arrow {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        z-index: 10;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background-color: rgba(255, 255, 255, 0.9);
        border: 1px solid #ddd;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.2s ease;
        opacity: 1; */
        pointer-events: all; 
    }

    .slider-arrow:hover {
        background-color: #fff;
        transform: translateY(-50%) scale(1.1);
    }

    .slider-arrow.prev-arrow { left: -20px; }
    .slider-arrow.next-arrow { right: -20px; }

    @media (max-width: 767px) {
        .slider-arrow.prev-arrow { left: 5px; }
        .slider-arrow.next-arrow { right: 5px; }
    }
</style>
@endpush

{{-- ========================== BAGIAN JAVASCRIPT ========================== --}}
@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const sliderWrappers = document.querySelectorAll('.slider-wrapper');

    sliderWrappers.forEach(wrapper => {
        const slider = wrapper.querySelector('.css-slider');
        const prevButton = wrapper.querySelector('.prev-arrow');
        const nextButton = wrapper.querySelector('.next-arrow');

        if (!slider || !prevButton || !nextButton) return;

        // Fungsi scroll slider
        function scrollSlider(direction) {
            const itemWidth = slider.querySelector('.css-slider-item').offsetWidth;
            const scrollAmount = (itemWidth + 24) * direction; // Tambahan 24px = gap antar item
            slider.scrollBy({ left: scrollAmount, behavior: 'smooth' });
        }

        prevButton.addEventListener('click', () => scrollSlider(-1));
        nextButton.addEventListener('click', () => scrollSlider(1));
    });
});
</script>
@endpush
