@extends('layouts.admin')

@section('header', 'Edit Kategori')

@section('content-admin')
    {{-- ========================================================== --}}
    {{-- PERUBAHAN DI SINI: categories.update menjadi admin.categories.update --}}
    {{-- ========================================================== --}}
    <form action="{{ route('admin.categories.update', $category->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label>Nama Kategori</label>
            <input type="text" name="name" class="form-control" value="{{ $category->name }}" required>
        </div>
        <div class="form-group">
            <label>Gambar</label>
            <input type="file" name="image" class="form-control-file">
            <img src="{{ asset('storage/' . $category->image) }}" width="100">
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        {{-- ========================================================== --}}
        {{-- PERUBAHAN DI SINI JUGA: categories.index menjadi admin.categories.index --}}
        {{-- ========================================================== --}}
        <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">Batal</a>
    </form>
@stop