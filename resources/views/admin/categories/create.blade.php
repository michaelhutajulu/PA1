@extends('layouts.admin')

@section('header', 'Tambah Kategori')

@section('content-admin')
    {{-- ========================================================== --}}
    {{-- PERUBAHAN DI SINI: categories.store menjadi admin.categories.store --}}
    {{-- ========================================================== --}}
    <form action="{{ route('admin.categories.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label>Nama Kategori</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Gambar Kategori</label>
            <input type="file" name="image" class="form-control-file">
        </div>
        <button type="submit" class="btn btn-success">Simpan</button>
        {{-- ========================================================== --}}
        {{-- PERUBAHAN DI SINI JUGA: categories.index menjadi admin.categories.index --}}
        {{-- ========================================================== --}}
        <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">Batal</a>
    </form>
@stop