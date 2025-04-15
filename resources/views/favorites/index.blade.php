@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h3 class="fw-bold mb-4 text-center">Produk Favorit Saya</h3>

    @if ($favorites->count() > 0)
        <div class="row">
            @foreach($favorites as $product)
                <div class="col-md-3 mb-4">
                    <div class="card shadow-sm h-100">
                        <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top" alt="{{ $product->name }}" style="height: 200px; object-fit: cover;">
                        <div class="card-body text-center">
                            <h5>{{ $product->name }}</h5>
                            <p class="text-muted">Rp. {{ number_format($product->price, 0, ',', '.') }}</p>
                            <a href="{{ route('admin.products.show', $product->id) }}"
                               onclick="sessionStorage.setItem('back_url', window.location.href)"
                               class="btn btn-outline-primary btn-sm">Detail</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="alert alert-info text-center">
            Belum ada produk favorit.
        </div>
    @endif
</div>
@endsection
