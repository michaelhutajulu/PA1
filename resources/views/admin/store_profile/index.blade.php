@extends('layouts.admin') {{-- Ganti dengan layout AdminLTE kamu --}}

@section('content')
<div class="container">
    <h1 class="mb-4">Profil Toko</h1>

    {{-- Notifikasi sukses --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Jika profil toko tersedia --}}
    @if ($storeProfile)
        <div class="card mb-4">
            <div class="card-body">
                <h4 class="card-title">{{ $storeProfile->title }}</h4>
                <p class="card-text">{{ $storeProfile->header_description }}</p>

                {{-- Gambar Header --}}
                @if($storeProfile->header_image)
                    <div class="mb-3">
                        <strong>Gambar Judul:</strong><br>
                        <img src="{{ asset('storage/' . $storeProfile->header_image) }}" alt="Header Image" width="300" class="img-thumbnail">
                    </div>
                @endif

                {{-- Gambar Toko --}}
                @if($storeProfile->store_image)
                    <div class="mb-3">
                        <strong>Gambar Toko:</strong><br>
                        <img src="{{ asset('storage/' . $storeProfile->store_image) }}" alt="Store Image" width="300" class="img-thumbnail">
                    </div>
                @endif

                {{-- Deskripsi --}}
                <p><strong>Deskripsi Toko:</strong></p>
                <p>{{ $storeProfile->main_description }}</p>

                {{-- Tombol Edit --}}
                <a href="{{ route('store_profile.edit') }}" class="btn btn-warning mt-2">Edit Profil</a>
            </div>
        </div>
    @else
        {{-- Jika belum ada data --}}
        <div class="alert alert-info">Belum ada data profil toko.</div>
        <a href="{{ route('store_profile.create') }}" class="btn btn-primary">Tambah Profil</a>
    @endif
</div>
@endsection
