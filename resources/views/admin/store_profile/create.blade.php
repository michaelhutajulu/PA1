@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Tambah Profil Toko</h1>

    {{-- Pastikan route menggunakan tanda minus (bukan underscore) --}}
    <form action="{{ route('store_profile.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="title" class="form-label">Judul Toko</label>
            <input type="text" name="title" id="title" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="short_description" class="form-label">Deskripsi Singkat</label>
            <input type="text" name="short_description" id="short_description" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="full_description" class="form-label">Deskripsi Lengkap</label>
            <textarea name="full_description" id="full_description" class="form-control" rows="5" required></textarea>
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Gambar Toko</label>
            <input type="file" name="image" id="image" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
@endsection
