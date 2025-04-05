@extends('layouts.admin')

@section('content')
<div class="container">
    <h1 class="mb-4">Edit Profil Toko</h1>

    <!-- Notifikasi sukses -->
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card p-4 shadow-sm">
                <form action="{{ route('store_profile.update') }}" method="POST" enctype="multipart/form-data" novalidate>
                    @csrf
                    @method('PUT')

                    <!-- Judul Toko -->
                    <div class="mb-3">
                        <label for="title" class="form-label fw-bold">Judul Toko</label>
                        <input type="text" name="title" id="title" class="form-control" 
                            value="{{ old('title', $storeProfile->title ?? '') }}" required>
                    </div>

                    <!-- Deskripsi -->
                    <div class="mb-3">
                        <label for="description" class="form-label fw-bold">Deskripsi</label>
                        <textarea name="description" id="description" class="form-control" rows="5" required>{{ old('description', $storeProfile->description ?? '') }}</textarea>
                    </div>

                    <!-- Gambar Toko -->
                    <div class="mb-3">
                        <label for="image" class="form-label fw-bold">Gambar Toko</label><br>
                        @if (!empty($storeProfile->image))
                            <img src="{{ asset('storage/' . $storeProfile->image) }}" alt="Gambar Toko" width="200" class="mb-2 rounded">
                        @endif
                        <input type="file" name="image" id="image" class="form-control">
                    </div>

                    <!-- Tombol Perbarui -->
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-success">Perbarui Profil</button>
                        <a href="{{ route('store_profile.index') }}" class="btn btn-secondary">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
