@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h3 class="fw-bold text-center mb-5">Kategori Produk</h3>

    <div class="row">
        @foreach($categories as $category)
        <div class="col-md-3 mb-4">
            <a href="{{ route('katalog.show', $category->id) }}" class="text-decoration-none text-dark">
                <div class="card shadow-sm h-100">
                    <div class="p-3 d-flex justify-content-center align-items-center" style="height: 200px;">
                        <img src="{{ asset('storage/' . $category->image) }}" class="img-fluid" style="max-height: 150px; object-fit: contain;" alt="{{ $category->name }}">
                    </div>
                    <div class="card-body text-center">
                        <h5 class="fw-semibold">{{ $category->name }}</h5>
                    </div>
                </div>
            </a>
        </div>
        @endforeach
    </div>
</div>
@endsection
