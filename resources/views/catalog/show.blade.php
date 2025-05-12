@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h3 class="fw-bold text-center mb-5">Produk Kategori: {{ $category->name }}</h3>

    {{-- Cek apakah ada produk SETELAH pagination diterapkan --}}
    @if ($products->isNotEmpty()) {{-- Gunakan isNotEmpty() untuk Paginator --}}
        <div class="d-flex flex-wrap justify-content-center mx-n2">
            @foreach($products as $product)
            <div class="col-6 col-sm-4 col-md-3 mb-4 px-2 d-flex">
                {{-- Pastikan link ini sesuai, mungkin ke halaman detail produk user, bukan admin? --}}
                {{-- Jika ada route 'product.show.user', gunakan itu --}}
                <a href="{{ route('admin.products.show', $product->id) }}" class="text-decoration-none text-dark w-100">
                    <div class="product-card h-100">
                        <div class="card-image-container">
                            @if($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}" class="product-image" alt="{{ $product->name }}">
                            @else
                                {{-- Placeholder jika tidak ada gambar --}}
                                <img src="{{ asset('path/to/default/placeholder.png') }}" class="product-image" alt="Gambar tidak tersedia">
                            @endif
                        </div>
                        <div class="card-content">
                            {{-- MODIFIKASI NAMA PRODUK --}}
                            <h4 class="product-title">{{ Str::limit($product->name, 40) }}</h4> {{-- Batasi panjang nama --}}
                            {{-- MODIFIKASI HARGA PRODUK --}}
                            <h5 class="price">Rp. {{ number_format($product->price, 0, ',', '.') }}</h5>
                        </div>
                        {{-- Mungkin tambahkan tombol detail atau favorit di sini jika perlu --}}
                    </div>
                </a>
            </div>
            @endforeach
        </div>

        {{-- ========================================== --}}
        {{-- ⬇️⬇️⬇️  BAGIAN PAGINATION DITAMBAHKAN DI SINI ⬇️⬇️⬇️ --}}
        {{-- ========================================== --}}
        <div class="d-flex justify-content-center mt-4">
            {{-- Pastikan variabel $products adalah instance Paginator --}}
            @if ($products instanceof \Illuminate\Pagination\LengthAwarePaginator)
                {{ $products->links() }}
            @endif
        </div>
        {{-- ========================================== --}}
        {{-- ⬆️⬆️⬆️  AKHIR BAGIAN PAGINATION ⬆️⬆️⬆️ --}}
        {{-- ========================================== --}}

    @else
        <div class="alert alert-info text-center">
            Belum ada produk dalam kategori ini.
        </div>
    @endif
</div>

{{-- Style CSS Anda tidak diubah --}}
<style>
    .product-card {
        border-radius: 12px;
        background: #fff;
        overflow: hidden;
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.05), 0 4px 6px -2px rgba(0, 0, 0, 0.02);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        border: 1px solid rgba(0, 0, 0, 0.05);
        position: relative; /* Tetap diperlukan jika ada elemen absolute di dalamnya */
        display: flex; /* Untuk mengatur konten di dalamnya */
        flex-direction: column; /* Konten ditumpuk vertikal */
    }

    .product-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
    }

    .card-image-container {
        height: 200px; /* Atur tinggi gambar */
        position: relative;
        overflow: hidden;
        flex-shrink: 0; /* Mencegah container gambar menyusut */
    }

    .product-image {
        width: 100%;
        height: 100%;
        object-fit: cover; /* Gambar akan menutupi area, mungkin terpotong */
        /* object-fit: contain; */ /* Alternatif: Gambar utuh, mungkin ada ruang kosong */
        transition: transform 0.5s ease;
    }

    .product-card:hover .product-image {
        transform: scale(1.07);
    }

    .card-content {
        padding: 16px;
        display: flex;
        flex-direction: column;
        align-items: center;
        flex-grow: 1; /* Memastikan konten mengisi ruang tersisa */
        text-align: center; /* Pusatkan semua teks di dalam konten */
    }

    .product-title {
        margin-bottom: 8px; /* Kurangi margin bawah sedikit */
        font-weight: 600;
        font-size: 0.95rem; /* Sedikit kecilkan font jika perlu */
        color: #333;
        width: 100%;
        /* Pastikan judul tidak terlalu panjang, gunakan Str::limit di Blade */
        /* line-height: 1.3; */ /* Atur jarak antar baris jika judul 2 baris */
        /* height: 2.6em; */ /* Batasi tinggi untuk 2 baris (line-height * 2) */
        /* overflow: hidden; */ /* Sembunyikan teks berlebih jika > 2 baris */
        /* text-overflow: ellipsis; */ /* Tampilkan ... jika teks terpotong */
        /* display: -webkit-box; */ /* Diperlukan untuk -webkit-line-clamp */
        /* -webkit-line-clamp: 2; */ /* Batasi maksimal 2 baris (membutuhkan prefix) */
        /* -webkit-box-orient: vertical; */ /* Diperlukan untuk -webkit-line-clamp */
    }

    .price {
        color: #2563eb;
        font-weight: 600;
        font-size: 1rem; /* Sesuaikan ukuran font harga */
        margin-bottom: 0; /* Hapus margin bawah jika tidak ada elemen lagi di bawahnya */
        width: 100%;
    }

    /* (Sisa CSS untuk quick view dan detail link bisa dibiarkan jika tidak digunakan saat ini) */

    /* Entry animation (tidak diubah) */
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

    .col-6.col-sm-4.col-md-3 {
        opacity: 0;
        animation: fadeInUp 0.5s ease forwards;
    }

    @media (prefers-reduced-motion: no-preference) {
        .col-6.col-sm-4.col-md-3:nth-child(1) { animation-delay: 0.1s; }
        .col-6.col-sm-4.col-md-3:nth-child(2) { animation-delay: 0.2s; }
        .col-6.col-sm-4.col-md-3:nth-child(3) { animation-delay: 0.3s; }
        .col-6.col-sm-4.col-md-3:nth-child(4) { animation-delay: 0.4s; }
        .col-6.col-sm-4.col-md-3:nth-child(n+5) { animation-delay: 0.5s; }
    }

    /* Pastikan pagination style dari Bootstrap/AdminLTE yang diterapkan */
    .pagination {
        /* Biarkan kosong agar style dari framework berlaku */
    }

</style>

{{-- Script JS Anda tidak diubah --}}
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Script Anda tetap di sini
    const productCards = document.querySelectorAll('.product-card');
    // ... (sisa script Anda) ...
});
</script>
@endsection