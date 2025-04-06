@extends('layouts.admin')

@section('header', 'Edit Profil Toko')

@section('content-admin')
    <form action="{{ route('store_profile.update', $storeProfile->id) }}" method="POST" enctype="multipart/form-data">
        @csrf @method('PUT')

        <div class="form-group">
            <label>Judul</label>
            <input type="text" name="title" class="form-control" value="{{ $storeProfile->title }}" required>
        </div>

        <div class="form-group">
            <label>Deskripsi Judul</label>
            <textarea name="header_description" class="form-control" rows="3" required>{{ $storeProfile->header_description }}</textarea>
        </div>

        <div class="form-group">
            <label>Gambar Judul</label>
            <input type="file" name="header_image" class="form-control-file">
            @if ($storeProfile->header_image)
                <img src="{{ asset('storage/' . $storeProfile->header_image) }}" width="100" class="mt-2">
            @endif
        </div>

        <div class="form-group">
            <label>Gambar Toko</label>
            <input type="file" name="store_image" class="form-control-file">
            @if ($storeProfile->store_image)
                <img src="{{ asset('storage/' . $storeProfile->store_image) }}" width="100" class="mt-2">
            @endif
        </div>

        <div class="form-group">
            <label>Deskripsi Toko</label>
            <textarea name="main_description" class="form-control" rows="4" required>{{ $storeProfile->main_description }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('store_profile.index') }}" class="btn btn-secondary">Batal</a>
    </form>
@endsection
