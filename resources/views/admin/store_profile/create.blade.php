@extends('layouts.admin')

@section('content')
<div class="container">
    <h1 class="mb-4">Tambah Profil Toko</h1>

    <form action="{{ route('store_profile.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

        <div class="mb-3">
            <label for="title" class="form-label">Judul</label>
            <input type="text" name="title" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="header_description" class="form-label">Deskripsi Judul</label>
            <textarea name="header_description" class="form-control" rows="3" required></textarea>
        </div>

        <div class="mb-3">
            <label for="header_image" class="form-label">Gambar Judul</label>
            <input type="file" name="header_image" class="form-control" accept="image/*">
        </div>

        <div class="mb-3">
            <label for="store_image" class="form-label">Gambar Toko</label>
            <input type="file" name="store_image" class="form-control" accept="image/*" required>
        </div>

        <div class="mb-3">
            <label for="main_description" class="form-label">Deskripsi Toko</label>
            <textarea name="main_description" class="form-control" rows="5" required></textarea>
        </div>

        <button type="submit" class="btn btn-success">Simpan</button>
    </form>
</div>
@endsection
