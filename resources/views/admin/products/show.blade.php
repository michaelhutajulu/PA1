@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row align-items-start">
        {{-- Gambar Produk --}}
        <div class="col-md-6 mb-4 mb-md-0">
            <img src="{{ asset('storage/' . $product->image) }}" class="img-fluid rounded shadow" alt="{{ $product->name }}">
        </div>

        {{-- Detail Produk --}}
        <div class="col-md-6">
            {{-- NAMA PRODUK: Menambahkan kelas fs-3 untuk ukuran setara <h3> --}}
            <h4 class="fw-bold fs-3">{{ $product->name }}</h4>
            {{-- HARGA PRODUK: Mengubah fs-5 menjadi fs-4 untuk ukuran setara <h4> --}}
            <p class="text-dark fs-4 fw-semibold mb-4">Rp. {{ number_format($product->price, 0, ',', '.') }}</p>

            {{-- JUDUL SPESIFIKASI: Menambahkan kelas fs-5 untuk ukuran setara <h5> --}}
            <h6 class="fw-semibold mb-2 fs-5">Detail Produk</h6>

            {{-- DESKRIPSI PRODUK: Menambahkan kelas fs-6 untuk ukuran paragraf standar Bootstrap --}}
            <div
                class="mb-4 border rounded shadow-sm fs-6" {{-- Tambah fs-6 --}}
                style="
                    padding: 0.1rem 0.5rem 1rem 1rem;
                    max-height: 200px;
                    overflow-y: auto;
                    white-space: pre-line;
                    background-color: #f8f9fa;
                "
            >
                {{ $product->description ?? 'Tidak ada deskripsi.' }}
            </div>

            {{-- Ikon Favorit --}}
            <div class="d-flex align-items-center gap-2 mt-3">
                <i
                    id="favorite-icon"
                    class="bi
                        @auth
                            {{ auth()->user()->favorites->contains($product->id) ? 'bi-heart-fill text-danger' : 'bi-heart' }}
                        @else
                            bi-heart
                        @endauth
                    "
                    style="font-size: 1.8rem; cursor: pointer;" {{-- Ukuran ikon diperbesar dari 1.6rem menjadi 1.8rem --}}
                    data-id="{{ $product->id }}"
                ></i>
                {{-- TEKS FAVORIT: Menambahkan kelas fs-6 untuk ukuran paragraf standar --}}
                <span id="favorite-text" class="fs-6"> {{-- Tambah fs-6 --}}
                    @auth
                        {{ auth()->user()->favorites->contains($product->id) ? 'Hapus dari Favorit' : 'Tambah Favorit' }}
                    @else
                        Tambah Favorit
                    @endauth
                </span>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const icon = document.getElementById('favorite-icon');
        const text = document.getElementById('favorite-text');

        if (icon) {
            icon.addEventListener('click', function () {
                const productId = this.getAttribute('data-id');

                @if (auth()->check())
                    // Jika user login, kirim request favorit
                    fetch(`/favorite/${productId}`, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Accept': 'application/json',
                            'Content-Type': 'application/json'
                        },
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.status === 'added') {
                            icon.classList.remove('bi-heart');
                            icon.classList.add('bi-heart-fill', 'text-danger');
                            text.textContent = 'Hapus dari Favorit';
                        } else if (data.status === 'removed') {
                            icon.classList.remove('bi-heart-fill', 'text-danger');
                            icon.classList.add('bi-heart');
                            text.textContent = 'Tambah Favorit';
                        }
                    })
                    .catch(error => {
                        console.error('Terjadi kesalahan:', error);
                    });
                @else
                    // Jika pengguna belum login, simpan URL saat ini dan coba buka modal login
                    sessionStorage.setItem('redirect_after_login', window.location.href);
                    if (typeof toggleLoginModal === 'function') {
                        toggleLoginModal();
                    } else {
                        // Fallback jika fungsi modal tidak ditemukan, arahkan ke halaman login
                        // Pastikan Anda memiliki route 'login'
                        console.warn("Fungsi toggleLoginModal() tidak ditemukan, mengarahkan ke halaman login.");
                        window.location.href = "{{ route('login') }}"; // Sesuaikan dengan nama route login Anda
                    }
                @endif
            });
        }
    });
</script>
@endpush