@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h3 class="mb-4 fw-bold">Produk Favorit Saya</h3>

    @if ($favorites->count() > 0)
        <div class="row row-cols-1 row-cols-md-3 g-4">
            @foreach ($favorites as $product)
                <div class="col">
                    <div class="card h-100 shadow-sm border-0">
                        <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top" alt="{{ $product->name }}" style="object-fit: cover; height: 200px;">
                        <div class="card-body text-center">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <p class="card-text text-muted">Rp. {{ number_format($product->price, 0, ',', '.') }}</p>
                        </div>
                        <div class="card-footer bg-transparent border-0 text-center">
                            <a href="{{ route('katalog.show', $product->id) }}" class="btn btn-outline-primary">Detail</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="text-muted">Belum ada produk favorit.</div>
    @endif
</div>
@endsection
