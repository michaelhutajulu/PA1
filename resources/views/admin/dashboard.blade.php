@extends('adminlte::page')

@section('title', 'Dashboard Admin')

@section('content_header')
    <h1>Dashboard Admin</h1>
@stop

@section('content')
    <div class="row">
        <!-- Kotak Jumlah Produk -->
        <div class="col-lg-3 col-6">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{ \App\Models\Product::count() }}</h3>
                    <p>Jumlah Produk</p>
                </div>
                <div class="icon">
                    <i class="fas fa-box"></i>
                </div>
                <a href="{{ route('products.index') }}" class="small-box-footer">Lihat Produk <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <!-- Kotak Jumlah Kategori -->
        <div class="col-lg-3 col-6">
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{ \App\Models\Category::count() }}</h3>
                    <p>Jumlah Kategori</p>
                </div>
                <div class="icon">
                    <i class="fas fa-tags"></i>
                </div>
                <a href="{{ route('categories.index') }}" class="small-box-footer">Lihat Kategori <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <!-- Kotak Profil Toko -->
        <div class="col-lg-3 col-6">
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{ \App\Models\StoreProfile::count() }}</h3>
                    <p>Profil Toko</p>
                </div>
                <div class="icon">
                    <i class="fas fa-store"></i>
                </div>
                <a href="{{ route('store_profile.index') }}" class="small-box-footer">Lihat Profil Toko <i class="fas fa-arrow-circle-right"></i></a>
                </div>
        </div>
    </div>
@stop
