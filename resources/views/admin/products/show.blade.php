@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-6">
            <img src="{{ asset('storage/' . $product->image) }}" class="img-fluid rounded" alt="{{ $product->name }}">
        </div>
        <div class="col-md-6">
            <h2>{{ $product->name }}</h2>
            <p class="text-muted fs-5">Rp. {{ number_format($product->price, 0, ',', '.') }}</p>
            <p>{{ $product->description ?? 'Tidak ada deskripsi.' }}</p>

            <a href="{{ url()->previous() }}" class="btn btn-secondary mt-3">Kembali</a>
        </div>
    </div>
</div>
@endsection
