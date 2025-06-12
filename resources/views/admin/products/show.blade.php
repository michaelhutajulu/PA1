@extends('layouts.app')

@section('content')
<style>
    /* === Global Styling untuk Halaman Detail Produk === */
    body {
        /* Font lebih modern dan mudah dibaca */
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol";
        background-color: #f9f9fc; /* Latar belakang halaman yang sangat terang dan bersih */
    }

    .product-detail-container {
        background-color: #ffffff;
        border-radius: 12px; /* Radius sudut yang lebih modern */
        padding: 30px 35px; /* Padding internal yang lebih lega */
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.07); /* Bayangan yang lebih halus dan menyebar */
        margin-top: 20px;
        margin-bottom: 20px;
    }

    /* === Gambar Produk === */
    .product-image-wrapper img {
        border-radius: 10px; /* Radius sudut gambar */
        object-fit: cover; /* Pastikan gambar mengisi area dengan baik */
        /* Bayangan yang lebih subtle untuk gambar */
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
        /* Tambahkan transisi jika ingin efek hover */
        transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
    }
    .product-image-wrapper img:hover {
        /* transform: scale(1.02); */ /* Opsional: sedikit zoom saat hover */
        /* box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1); */
    }


    /* === Detail Produk (Kolom Kanan) === */
    .product-info-column {
        /* Tidak perlu style khusus jika Bootstrap sudah menangani kolomnya */
    }

    /* Nama Produk */
    .product-name {
        color: #2c3e50; /* Warna judul yang kuat tapi tidak hitam pekat */
        line-height: 1.3;
        margin-bottom: 0.75rem; /* Jarak bawah yang pas */
    }

    /* Harga Produk */
    .product-price {
        color: #e74c3c; /* Warna aksen untuk harga (merah lembut) atau bisa warna primer brand Anda */
        /* font-weight: 600; sudah dari fs-semibold */
        margin-bottom: 1.75rem !important; /* Jarak lebih besar sebelum detail */
    }

    /* Judul "Detail Produk" */
    .product-spec-title {
        color: #34495e; /* Warna yang sedikit lebih lembut dari nama produk */
        /* font-weight: 600; sudah dari fw-semibold */
        margin-bottom: 0.75rem !important; /* Jarak sebelum box deskripsi */
        border-bottom: 2px solid #f0f0f0; /* Garis bawah halus sebagai pemisah */
        padding-bottom: 0.5rem;
    }

    /* Box Deskripsi Produk */
    .product-description-box {
        /* Menggunakan class untuk styling yang lebih rapi daripada inline */
        padding: 1rem 1.25rem; /* Padding yang lebih konsisten dan lega */
        max-height: 220px; /* Sedikit lebih tinggi */
        overflow-y: auto;
        white-space: pre-line;
        background-color: #fdfdfd; /* Background yang sangat terang, hampir putih */
        border: 1px solid #e9ecef; /* Border yang lebih halus */
        border-radius: 8px; /* Radius sudut untuk box */
        color: #555; /* Warna teks deskripsi */
        line-height: 1.6;
        /* Styling scrollbar (opsional, butuh prefix browser) */
    }
    
    /* Area Aksi (Favorit) */
    .favorite-action-area {
        margin-top: 2rem !important; /* Jarak atas yang lebih jelas */
        padding-top: 1rem;
        border-top: 1px solid #f0f0f0; /* Garis pemisah halus */
    }

    #favorite-icon {
        /* font-size: 1.8rem; sudah inline */
        /* cursor: pointer; sudah inline */
        transition: transform 0.2s ease, color 0.2s ease; /* Transisi untuk interaksi */
        color: #7f8c8d; /* Warna default ikon hati (abu-abu) */
    }
    #favorite-icon.text-danger { /* text-danger dari Bootstrap akan override ini jika tidak pakai !important */
        color: #e74c3c !important; /* Pastikan warna merah konsisten */
    }
    #favorite-icon:hover {
        transform: scale(1.15); /* Efek scale saat hover */
    }

    #favorite-text {
        /* fs-6 sudah dari class */
        color: #34495e; /* Warna teks yang konsisten */
        font-weight: 500; /* Sedikit lebih tebal */
        margin-left: 0.25rem; /* Sedikit jarak dari ikon */
    }

</style>

{{-- Menggunakan class .product-detail-container untuk styling utama --}}
<div class="container py-4">
    <div class="row align-items-start product-detail-container">
        {{-- Gambar Produk --}}
        <div class="col-md-6 mb-4 mb-md-0 product-image-wrapper">
            <img src="{{ asset('storage/' . $product->image) }}" class="img-fluid" alt="{{ $product->name }}">
            {{-- Kelas shadow dan rounded saya pindahkan ke CSS untuk konsistensi, tapi bisa juga dipertahankan di sini --}}
        </div>

        {{-- Detail Produk --}}
        <div class="col-md-6 product-info-column">
            {{-- NAMA PRODUK: Menambahkan kelas product-name --}}
            <h1 class="fw-bold fs-3 product-name">{{ $product->name }}</h1> {{-- Mengubah h4 ke h1 untuk semantik yang lebih baik --}}

            {{-- HARGA PRODUK: Menambahkan kelas product-price --}}
            <p class="text-dark fs-4 fw-semibold mb-4 product-price">Rp. {{ number_format($product->price, 0, ',', '.') }}</p>

            {{-- JUDUL SPESIFIKASI: Menambahkan kelas product-spec-title --}}
            <h2 class="fw-semibold mb-2 fs-5 product-spec-title">Detail Produk</h2> {{-- Mengubah h6 ke h2 --}}

            {{-- DESKRIPSI PRODUK: Menggunakan kelas product-description-box dan menghapus inline style --}}
            <div
                class="mb-4 fs-6 product-description-box" {{-- fs-6 sudah ada, shadow & border dipindah ke CSS --}}
            >
                {{ $product->description ?? 'Tidak ada deskripsi.' }}
            </div>

            {{-- Ikon Favorit: Menambahkan kelas favorite-action-area pada parent div --}}
            <div class="d-flex align-items-center gap-2 mt-3 favorite-action-area">
                <i
                    id="favorite-icon"
                    class="bi
                        @auth
                            {{ auth()->user()->favorites->contains($product->id) ? 'bi-heart-fill text-danger' : 'bi-heart' }}
                        @else
                            bi-heart
                        @endauth
                    "
                    style="font-size: 1.8rem; cursor: pointer;"
                    data-id="{{ $product->id }}"
                ></i>
                <span id="favorite-text" class="fs-6">
                    @auth
                        {{ auth()->user()->favorites->contains($product->id) ? 'Hapus dari Favorit' : 'Tambah Favorit' }}
                    @else
                        Tambah Favorit
                    @endauth
                </span>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const icon = document.getElementById('favorite-icon');
        const text = document.getElementById('favorite-text');

        if (icon) {
            icon.addEventListener('click', function () {
                const productId = this.getAttribute('data-id');

                @if (auth()->check())
                    fetch(`/favorite/${productId}`, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Accept': 'application/json',
                            'Content-Type': 'application/json'
                        },
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.status === 'added') {
                            icon.classList.remove('bi-heart');
                            icon.classList.add('bi-heart-fill', 'text-danger');
                            text.textContent = 'Hapus dari Favorit';
                        } else if (data.status === 'removed') {
                            icon.classList.remove('bi-heart-fill', 'text-danger');
                            icon.classList.add('bi-heart');
                            text.textContent = 'Tambah Favorit';
                        }
                    })
                    .catch(error => {
                        console.error('Terjadi kesalahan:', error);
                        // Tambahkan notifikasi error untuk pengguna jika perlu
                        alert('Gagal memperbarui status favorit. Silakan coba lagi.');
                    });
                @else
                    sessionStorage.setItem('redirect_after_login', window.location.href);
                    if (typeof toggleLoginModal === 'function') {
                        toggleLoginModal();
                    } else {
                        console.warn("Fungsi toggleLoginModal() tidak ditemukan, mengarahkan ke halaman login.");
                        window.location.href = "{{ route('login') }}";
                    }
                @endif
            });
        }
    });
</script>
@endpush