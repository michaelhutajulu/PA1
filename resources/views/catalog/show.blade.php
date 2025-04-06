@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h3 class="fw-bold text-center mb-5">Produk Kategori: {{ $category->name }}</h3>

    @if ($products->count() > 0)
        <div class="row">
            @foreach($products as $product)
            <div class="col-md-3 mb-4">
                <div class="card shadow-sm h-100">
                    <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top" alt="{{ $product->name }}" style="height: 200px; object-fit: cover;">
                    <div class="card-body text-center">
                        <h5 class="fw-semibold">{{ $product->name }}</h5>
                        <p class="text-muted">Rp. {{ number_format($product->price, 0, ',', '.') }}</p>
                        <a href="{{ route('admin.products.show', $product->id) }}" class="btn btn-outline-primary btn-sm">Detail</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    @else
        <div class="alert alert-info text-center">
            Belum ada produk dalam kategori ini.
        </div>
    @endif
</div>
@endsection
