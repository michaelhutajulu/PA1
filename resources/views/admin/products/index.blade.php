@extends('layouts.admin')

@section('header', 'Daftar Produk')

@section('content-admin')
    <a href="{{ route('products.create') }}" class="btn btn-primary mb-3">Tambah Produk</a>

    {{-- Search Bar untuk Admin --}}
    <form class="mb-3" role="search" action="{{ route('admin.products.search') }}" method="GET">
        <div class="input-group w-50">
            <input class="form-control rounded-start" type="search" name="query" value="{{ request('query') }}" placeholder="Cari produk...">
            <button class="btn btn-outline-secondary rounded-end" type="submit">
                <i class="bi bi-search"></i>
            </button>
        </div>
    </form>

    {{-- Info hasil pencarian dan saran --}}
    @if (isset($query))
        <div class="mb-3">
            <strong>Hasil pencarian untuk:</strong> "{{ $query }}"

        </div>
    @endif

    {{-- Tabel Produk --}}
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Nama</th>
                <th>Kategori</th>
                <th>Harga</th>
                <th>Gambar</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($products as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->category->name }}</td>
                    <td>Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                    <td><img src="{{ asset('storage/' . $item->image) }}" width="50"></td>
                    <td>
                        <a href="{{ route('products.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('products.destroy', $item->id) }}" method="POST" class="d-inline">
                            @csrf @method('DELETE')
                            <button class="btn btn-danger btn-sm" onclick="return confirm('Hapus produk ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">Produk tidak ditemukan.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@stop
