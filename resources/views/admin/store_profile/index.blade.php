@extends('layouts.admin') {{-- Ganti dengan layout AdminLTE kamu --}}

@section('content')
<div class="container">
    <h1 class="mb-4">Profil Toko</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if ($storeProfile)
        <div class="card">
            <div class="card-body">
                <h4>{{ $storeProfile->title }}</h4>
                <p>{{ $storeProfile->header_description }}</p>

                <div class="mb-3">
                    <strong>Gambar Judul:</strong><br>
                    <img src="{{ asset('storage/' . $storeProfile->header_image) }}" alt="" width="300">
                </div>

                <div class="mb-3">
                    <strong>Gambar Toko:</strong><br>
                    <img src="{{ asset('storage/' . $storeProfile->store_image) }}" alt="" width="300">
                </div>

                <p><strong>Deskripsi Toko:</strong></p>
                <p>{{ $storeProfile->main_description }}</p>

                <a href="{{ route('store_profile.edit') }}" class="btn btn-warning">Edit</a>
                </div>
        </div>
    @else
        <div class="alert alert-info">Belum ada data profil toko.</div>
        <a href="{{ route('store_profile.create') }}" class="btn btn-primary">Tambah Profil</a>
        @endif
</div>
@endsection
