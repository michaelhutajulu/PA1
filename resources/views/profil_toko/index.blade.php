@extends('layouts.app')

@section('content')
<style>
    /* Font dasar bisa disesuaikan di layouts.app atau di sini */
    body {
        font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
        background-color: #f8f9fa; /* Warna latar halaman yang netral */
        color: #333;
    }

    /* Banner Atas (Header) */
    .custom-header-banner {
        position: relative;
        border-radius: 15px; /* Radius yang lebih halus, sesuaikan dengan gambar Anda */
        overflow: hidden;
        margin-bottom: 50px; /* Jarak yang cukup ke konten berikutnya */
        /* Tidak perlu background-color solid jika gambar selalu ada */
    }

    .custom-header-banner .banner-image-background {
        width: 100%;
        height: 300px; /* Sesuaikan tinggi banner agar proporsional dan teks muat */
        object-fit: cover;
        /* Filter brightness untuk memastikan teks putih kontras tanpa overlay gelap solid */
        filter: brightness(0.65); /* Sesuaikan nilai brightness (0.0 - 1.0) */
        display: block;
    }

    .custom-header-banner .banner-text-content {
        position: absolute;
        top: 50%;
        left: 50%; /* Pusatkan teks secara horizontal */
        transform: translate(-50%, -50%); /* Teknik centering absolut */
        color: white;
        text-align: center; /* Teks di tengah */
        width: 80%; /* Batasi lebar teks agar tidak terlalu ke pinggir */
        max-width: 750px; /* Batas maksimal agar tetap terbaca di layar lebar */
        padding: 20px;
        /* Tidak ada background di sini agar benar-benar transparan di atas gambar */
        /* text-shadow: 0 1px 3px rgba(0,0,0,0.5); */ /* Opsional: sedikit shadow untuk keterbacaan lebih */
    }

    .custom-header-banner .banner-text-content h2 {
        font-size: 2.4rem; /* Ukuran font judul banner */
        font-weight: bold;
        margin-bottom: 15px;
        line-height: 1.2;
    }

    .custom-header-banner .banner-text-content p {
        font-size: 1.1rem; /* Ukuran font deskripsi banner */
        line-height: 1.6;
        opacity: 0.95; /* Sedikit transparan agar lebih menyatu */
    }

    /* Bagian Konten Toko (Gambar Besar di Kiri dan Deskripsi di Kanan) */
    .custom-store-section {
        display: flex;
        flex-wrap: wrap; /* Agar responsif */
        gap: 30px; /* Jarak antara gambar dan deskripsi */
        align-items: flex-start; /* Gambar dan teks align dari atas */
        margin-bottom: 60px;
        background-color: #fff; /* Beri background putih untuk section ini */
        padding: 25px; /* Padding di sekeliling section */
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.08);
    }

    .custom-store-image-wrapper {
        /* Gambar mengambil porsi lebih besar dan mentok ke kiri */
        flex: 0 0 60%; /* Misalnya, 60% dari lebar section */
        max-width: 60%; /* Sesuaikan persentase ini sesuai keinginan */
        /* Tidak ada margin-left agar mentok ke padding parent (.custom-store-section) */
    }

    .custom-store-image-wrapper img {
        width: 100%; /* Gambar mengisi wrapper */
        /* Tinggi bisa auto agar mengikuti rasio aspek, atau set nilai tetap */
        /* Mengikuti referensi gambar Anda (515x440), jika lebar diperbesar, tinggi juga akan membesar proporsional */
        /* Mari kita set tinggi spesifik dan gunakan object-fit, atau biarkan auto */
        height: 500px; /* Tinggi gambar lebih besar, sesuaikan */
        object-fit: cover;
        border-radius: 10px; /* Radius untuk gambar toko */
        box-shadow: 0 3px 8px rgba(0,0,0,0.1);
        display: block;
    }

    .custom-store-description-wrapper {
        flex: 1; /* Mengambil sisa ruang yang tersedia (sekitar 40% dikurangi gap) */
        min-width: 280px; /* Lebar minimum sebelum deskripsi menjadi terlalu sempit */
        padding-left: 15px; /* Sedikit jarak dari gambar jika gap tidak cukup */
    }

    .custom-store-description-wrapper h3 {
        font-weight: bold;
        font-size: 1.9rem; /* Ukuran font judul "Apa itu..." */
        color: #2c3e50;
        margin-top: 5px; /* Sedikit penyesuaian vertikal */
        margin-bottom: 20px;
        line-height: 1.3;
    }

    .custom-store-description-wrapper p {
        font-size: 1rem;
        line-height: 1.7; /* Line height yang baik untuk keterbacaan */
        color: #454545; /* Warna teks paragraf yang sedikit lebih lembut */
        text-align: left; /* Sesuai gambar, bukan justify agar spasi antar kata rapi */
        margin-bottom: 15px; /* Jarak antar paragraf jika ada lebih dari satu */
    }
    .custom-store-description-wrapper p:last-child {
        margin-bottom: 0;
    }


    /* Media Query untuk Responsivitas */
    @media (max-width: 991px) { /* Ukuran tablet */
        .custom-header-banner .banner-text-content h2 {
            font-size: 2rem;
        }
        .custom-header-banner .banner-text-content p {
            font-size: 1rem;
        }

        .custom-store-section {
            /* Di tablet, gambar mungkin masih bisa di samping, tapi persentasenya diubah */
            gap: 25px;
        }
        .custom-store-image-wrapper {
            flex-basis: 50%; /* Gambar dan teks jadi 50-50 di tablet */
            max-width: 50%;
        }
        .custom-store-image-wrapper img {
            height: 420px; /* Sesuaikan tinggi gambar untuk tablet */
        }
        .custom-store-description-wrapper {
            padding-left: 0; /* Hapus padding kiri karena sudah ada gap */
        }
        .custom-store-description-wrapper h3 {
            font-size: 1.7rem;
        }
    }

    @media (max-width: 767px) { /* Ukuran mobile */
        .custom-header-banner {
            height: 250px; /* Banner lebih pendek di mobile */
            margin-bottom: 30px;
        }
        .custom-header-banner .banner-text-content h2 {
            font-size: 1.7rem;
        }
        .custom-header-banner .banner-text-content p {
            font-size: 0.9rem;
        }

        .custom-store-section {
            flex-direction: column; /* Tumpuk di layar mobile */
            padding: 20px;
        }
        .custom-store-image-wrapper,
        .custom-store-description-wrapper {
            flex-basis: 100%; /* Mengambil lebar penuh saat ditumpuk */
            max-width: 100%;
        }
        .custom-store-image-wrapper {
            margin-bottom: 25px; /* Jarak bawah gambar saat ditumpuk */
        }
        .custom-store-image-wrapper img {
            height: 350px; /* Sesuaikan tinggi gambar untuk mobile */
        }
        .custom-store-description-wrapper h3 {
            font-size: 1.6rem;
            text-align: center; /* Judul deskripsi bisa di tengah di mobile */
        }
        .custom-store-description-wrapper p {
            text-align: justify; /* Paragraf bisa justify di mobile agar rapi di blok */
        }
    }
</style>

{{-- Container utama bisa container-fluid untuk banner dan container untuk konten, atau semua dalam container --}}
{{-- Untuk banner agar bisa full-width (jika diinginkan, tapi gambar contoh Anda sepertinya dibatasi container) --}}
{{-- Saya akan gunakan .container untuk semua agar konsisten dengan gambar contoh Anda --}}

<div class="container py-4"> {{-- Padding atas dan bawah untuk seluruh halaman --}}

    {{-- Banner --}}
    <div class="custom-header-banner">
        @if($storeProfile->header_image)
            <img src="{{ asset('storage/' . $storeProfile->header_image) }}" alt="Header Toko {{ $storeProfile->title ?? '' }}" class="banner-image-background">
        @endif
        <div class="banner-text-content">
            <h2 class="fw-bold">{{ $storeProfile->title ?? 'Nama Toko Anda' }}</h2>
            <p>{{ $storeProfile->header_description ?? 'Deskripsi singkat mengenai usaha dan produk unggulan toko Anda.' }}</p>
        </div>
    </div>

    {{-- Gambar Toko dan Deskripsi --}}
    <div class="custom-store-section">
        <div class="custom-store-image-wrapper">
            {{-- Pastikan path gambar store_image benar --}}
            <img src="{{ asset('storage/' . $storeProfile->store_image) }}" alt="Foto Toko {{ $storeProfile->title ?? '' }}">
        </div>
        <div class="custom-store-description-wrapper">
            <h3>Apa itu {{ $storeProfile->title ?? 'Toko Kami' }} ?</h3>
            <p>{{ $storeProfile->main_description ?? 'Penjelasan detail mengenai toko Anda, lokasi, jenis produk yang dijual, keunggulan, dan informasi lain yang relevan untuk pelanggan.' }}</p>
            {{-- Anda bisa menambahkan paragraf lain di sini jika $storeProfile->main_description terlalu panjang atau ingin dipecah --}}
        </div>
    </div>

    {{-- Bagian Info Cards telah dihapus --}}

</div>
@endsection