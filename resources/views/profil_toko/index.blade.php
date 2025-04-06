@extends('layouts.app')

@section('content')
<style>
    .header-banner {
        position: relative;
        border-radius: 20px;
        overflow: hidden;
        margin-bottom: 40px;
    }

    .header-banner img {
        width: 100%;
        height: 400px;
        object-fit: cover;
        filter: brightness(60%);
    }

    .header-banner .text-overlay {
        position: absolute;
        top: 50%;
        left: 30px;
        transform: translateY(-50%);
        color: white;
        background: rgba(0, 0, 0, 0.5);
        padding: 20px;
        border-radius: 15px;
        max-width: 500px;
    }

    .store-section {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 40px;
        align-items: center;
        margin-bottom: 60px;
    }

    .store-image img {
        border-radius: 20px;
        width: 350px;
        height: auto;
        box-shadow: 0 4px 10px rgba(0,0,0,0.2);
    }

    .store-description {
        max-width: 600px;
        text-align: justify;
    }

    .store-description h3 {
        font-weight: bold;
        margin-bottom: 15px;
    }

    .info-section {
    margin-top: 40px;
    margin-bottom: 60px;
}

.info-cards {
    display: flex;
    justify-content: center;
    gap: 30px;
    flex-wrap: wrap;
}

.info-card {
    border: 1px solid #ccc;
    border-radius: 15px;
    padding: 20px 30px;
    min-width: 220px;
    background-color: #fff;
    box-shadow: 0 2px 8px rgba(0,0,0,0.05);
}

</style>

<div class="container">

    {{-- Banner --}}
    <div class="header-banner">
        <img src="{{ asset('storage/' . $storeProfile->header_image) }}" alt="Header Gambar">
        <div class="text-overlay">
            <h2 class="fw-bold">{{ $storeProfile->title }}</h2>
            <p>{{ $storeProfile->header_description }}</p>
        </div>
    </div>

    {{-- Gambar Toko dan Deskripsi --}}
    <div class="store-section">
        <div class="store-image">
            <img src="{{ asset('storage/' . $storeProfile->store_image) }}" alt="Gambar Toko">
        </div>
        <div class="store-description">
            <h3>Apa Itu Toko Bintang Serasi?</h3>
            <p>{{ $storeProfile->main_description }}</p>
        </div>
    </div>

    {{-- Informasi Lanjutan --}}
<div class="info-section text-center">
    <h4 class="fw-bold mb-4">Informasi Lanjutan :</h4>
    <div class="info-cards d-flex justify-content-center flex-wrap gap-4">
        <div class="info-card">
            <h6><strong>No. Telepon :</strong></h6>
            <p>0812-6466-7712</p>
        </div>
        <div class="info-card">
            <h6><strong>Kode Pos :</strong></h6>
            <p>22311</p>
        </div>
        <div class="info-card">
            <h6><strong>Waktu Operasional :</strong></h6>
            <p>Senin - Sabtu : 08.00 - 20.00<br>Minggu : 12.00 - 20.00</p>
        </div>
    </div>
</div>


</div>
@endsection
