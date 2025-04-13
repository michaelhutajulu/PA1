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
            <h4 class="fw-bold">{{ $product->name }}</h4>
            <p class="text-dark fs-5 fw-semibold mb-4">Rp. {{ number_format($product->price, 0, ',', '.') }}</p>

            <div class="mb-4" style="white-space: pre-line;">
                {{ $product->description ?? 'Tidak ada deskripsi.' }}
            </div>

            @auth
                <div class="d-flex align-items-center gap-2 mt-3">
                    <i 
                        id="favorite-icon"
                        class="bi {{ auth()->user()->favorites->contains($product->id) ? 'bi-heart-fill text-danger' : 'bi-heart' }}" 
                        style="font-size: 1.6rem; cursor: pointer;"
                        data-id="{{ $product->id }}"
                    ></i>
                    <span id="favorite-text">
                        {{ auth()->user()->favorites->contains($product->id) ? 'Hapus dari Favorit' : 'Tambah Favorit' }}
                    </span>
                </div>
            @endauth

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
            });
        }
    });
</script>
@endpush
