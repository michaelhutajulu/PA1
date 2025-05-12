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

    {{-- Info hasil pencarian (jika ada) --}}
    @if (isset($query))
        <div class="alert alert-info mb-3">
            Menampilkan hasil pencarian untuk: <strong>"{{ $query }}"</strong>
            {{-- Menampilkan saran jika tidak ditemukan dan ada saran --}}
            @if ($products->isEmpty() && isset($suggestion))
                <br>Mungkin maksud Anda: <a href="{{ route('admin.products.search', ['query' => $suggestion]) }}">{{ $suggestion }}</a>?
            @endif
        </div>
    @endif

    {{-- Tabel Produk --}}
    <div class="table-responsive"> {{-- Wrapper agar tabel bisa scroll horizontal di layar kecil --}}
        <table class="table table-bordered table-striped"> {{-- Tambah class table-striped untuk belang --}}
            <thead class="thead-dark"> {{-- Header tabel lebih gelap --}}
                <tr>
                    <th>#</th>
                    <th>Nama</th>
                    <th>Deskripsi</th> {{-- ✅ Tambahan kolom deskripsi --}}
                    <th>Kategori</th>
                    <th>Harga</th>
                    <th>Gambar</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                {{-- Menggunakan nomor urut pagination --}}
                @forelse ($products as $index => $item)
                    <tr>
                        {{-- Nomor urut berdasarkan halaman pagination --}}
                        <td>{{ $products->firstItem() + $index }}</td>
                        <td>{{ $item->name }}</td>
                        {{-- Batasi panjang deskripsi jika perlu --}}
                        <td>{{ Str::limit($item->description, 50) }}</td> {{-- ✅ Menampilkan deskripsi produk (dibatasi 50 char) --}}
                        <td>{{ $item->category->name ?? 'Tanpa Kategori' }}</td> {{-- Handle jika kategori null --}}
                        <td>Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                        <td>
                            @if($item->image)
                                <img src="{{ asset('storage/' . $item->image) }}" width="50" alt="{{ $item->name }}">
                            @else
                                <small>Tanpa Gambar</small>
                            @endif
                        </td>
                        <td>
                            <div class="btn-group" role="group"> {{-- Kelompokkan tombol aksi --}}
                                <a href="{{ route('products.edit', $item->id) }}" class="btn btn-warning btn-sm" title="Edit">
                                    <i class="bi bi-pencil-square"></i> Edit
                                </a>
                                <form action="{{ route('products.destroy', $item->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Anda yakin ingin menghapus produk \'{{ $item->name }}\'?')" title="Hapus">
                                        <i class="bi bi-trash"></i> Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        {{-- Pastikan colspan sesuai jumlah kolom header --}}
                        <td colspan="7" class="text-center">
                            @if (isset($query))
                                Produk dengan kata kunci "{{ $query }}" tidak ditemukan.
                                @if (isset($suggestion))
                                    <br>Mungkin maksud Anda: <a href="{{ route('admin.products.search', ['query' => $suggestion]) }}">{{ $suggestion }}</a>?
                                @endif
                            @else
                                Belum ada data produk.
                            @endif
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- ========================================== --}}
    {{-- ⬇️⬇️⬇️  BAGIAN PAGINATION DITAMBAHKAN DI SINI ⬇️⬇️⬇️ --}}
    {{-- ========================================== --}}
    <div class="mt-3 d-flex justify-content-center">
         {{-- Pastikan variabel $products tersedia dan merupakan instance Paginator --}}
         @if ($products instanceof \Illuminate\Pagination\LengthAwarePaginator)
            {{ $products->links() }}
         @endif
    </div>
    {{-- ========================================== --}}
    {{-- ⬆️⬆️⬆️  AKHIR BAGIAN PAGINATION ⬆️⬆️⬆️ --}}
    {{-- ========================================== --}}

@stop

{{-- Opsional: Tambahkan sedikit CSS jika perlu, tapi biasanya AdminLTE/Bootstrap sudah handle --}}
@push('styles')
<style>
    /* Styling tambahan jika diperlukan */
    .pagination {
        margin-bottom: 0; /* Hapus margin bawah default jika perlu */
    }
</style>
@endpush