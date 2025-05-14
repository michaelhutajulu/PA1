@extends('layouts.admin')

@section('header', 'Daftar Kategori')

@section('content-admin')
    {{-- ========================================================== --}}
    {{-- PERUBAHAN DI SINI: categories.create menjadi admin.categories.create --}}
    {{-- ========================================================== --}}
    <a href="{{ route('admin.categories.create') }}" class="btn btn-primary mb-3">Tambah Kategori</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Nama Kategori</th>
                <th>Gambar</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categories as $category)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $category->name }}</td>
                    <td><img src="{{ asset('storage/' . $category->image) }}" width="50"></td>
                    <td>
                        {{-- ========================================================== --}}
                        {{-- PERUBAHAN DI SINI: categories.edit menjadi admin.categories.edit --}}
                        {{-- ========================================================== --}}
                        <a href="{{ route('admin.categories.edit', $category->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        {{-- ========================================================== --}}
                        {{-- PERUBAHAN DI SINI: categories.destroy menjadi admin.categories.destroy (untuk action form) --}}
                        {{-- ========================================================== --}}
                        <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" onclick="return confirm('Hapus kategori ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@stop