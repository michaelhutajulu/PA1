@extends('layouts.admin')

@section('content')
<div class="container">
    <h1 class="mb-4">Edit Profil Toko</h1>

    <form action="{{ route('store-profile.update', $storeProfile->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="title" class="form-label">Judul</label>
            <input type="text" name="title" value="{{ old('title', $storeProfile->title) }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="header_description" class="form-label">Deskripsi Judul</label>
            <textarea name="header_description" class="form-control" rows="3" required>{{ old('header_description', $storeProfile->header_description) }}</textarea>
        </div>

        <div class="mb-3">
            <label for="header_image" class="form-label">Gambar Judul</label><br>
            @if ($storeProfile->header_image)
                <img src="{{ asset('storage/' . $storeProfile->header_image) }}" alt="" width="200" class="mb-2"><br>
            @endif
            <input type="file" name="header_image" class="form-control" accept="image/*">
        </div>

        <div class="mb-3">
            <label for="store_image" class="form-label">Gambar Toko</label><br>
            @if ($storeProfile->store_image)
                <img src="{{ asset('storage/' . $storeProfile->store_image) }}" alt="" width="200" class="mb-2"><br>
            @endif
            <input type="file" name="store_image" class="form-control" accept="image/*">
        </div>

        <div class="mb-3">
            <label for="main_description" class="form-label">Deskripsi Toko</label>
            <textarea name="main_description" class="form-control" rows="5" required>{{ old('main_description', $storeProfile->main_description) }}</textarea>
        </div>

        <button type="submit" class="btn btn-success">Simpan Perubahan</button>
    </form>
</div>
@endsection
