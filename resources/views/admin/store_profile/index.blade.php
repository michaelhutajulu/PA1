@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Profil Toko</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Form update profil toko --}}
    <form action="{{ route('store_profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="title" class="form-label">Judul Toko</label>
            <input type="text" name="title" id="title" class="form-control" 
                value="{{ old('title', $storeProfile->title ?? '') }}" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Deskripsi</label>
            <textarea name="description" id="description" class="form-control" rows="5" required>{{ old('description', $storeProfile->description ?? '') }}</textarea>
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Gambar Toko</label>
            @if (!empty($storeProfile->image))
                <div class="mb-2">
                    <img src="{{ asset('storage/' . $storeProfile->image) }}" alt="Gambar Toko" width="200">
                </div>
            @endif
            <input type="file" name="image" id="image" class="form-control">
        </div>

        <button type="submit" class="btn btn-success">Simpan Profil</button>
        <a href="{{ route('store_profile.edit') }}" class="btn btn-primary ">Edit Profil</a>

    </form>
</div>
@endsection
