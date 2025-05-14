@extends('layouts.app') {{-- Pastikan layouts.app adalah layout publik Anda --}}

@section('content')
<style>
    .product-card {
        border-radius: 12px;
        background: #fff;
        overflow: hidden;
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.05),
                    0 4px 6px -2px rgba(0, 0, 0, 0.02);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        border: 1px solid rgba(0, 0, 0, 0.05);
        position: relative;
        cursor: pointer;
        text-decoration: none; /* Menghilangkan garis bawah default dari link */
        color: inherit; /* Mengambil warna teks dari parent */
        display: block; /* Membuat seluruh area card bisa diklik */
    }

    .product-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1),
                    0 10px 10px -5px rgba(0, 0, 0, 0.04);
    }

    .card-image-container {
        height: 200px; /* Sesuaikan tinggi gambar sesuai kebutuhan */
        overflow: hidden;
        background-color: #f8f9fa; /* Warna placeholder jika gambar gagal load */
    }

    .product-image {
        width: 100%;
        height: 100%;
        object-fit: cover; /* Pastikan gambar mengisi container tanpa distorsi */
        transition: transform 0.5s ease;
    }

    .product-card:hover .product-image {
        transform: scale(1.07);
    }

    .card-content {
        padding: 16px;
        text-align: center; /* Atau 'left' jika lebih sesuai desain */
    }

    .product-title {
        font-weight: 600;
        font-size: 1rem; /* Sesuaikan ukuran font */
        color: #333;
        margin-bottom: 8px;
        /* Membatasi teks jika terlalu panjang dan menambahkan elipsis */
        display: -webkit-box;
        -webkit-line-clamp: 2; /* Jumlah baris yang ditampilkan */
        -webkit-box-orient: vertical;
        overflow: hidden;
        text-overflow: ellipsis;
        min-height: 2.4em; /* (font-size * line-height * line-clamp) kira-kira, untuk konsistensi tinggi */
        line-height: 1.2em;
    }

    .price {
        color: #2563eb; /* Warna bisa disesuaikan dengan tema */
        font-weight: 600;
        font-size: 1.1rem; /* Sesuaikan ukuran font */
    }
</style>

<div class="container mt-5">
    @if(session('error'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if($products->isEmpty() && isset($query) && trim($query) !== '' && isset($suggestion) && $suggestion)
        <div class="alert alert-info text-center">
            <strong>Tidak ada hasil untuk:</strong> "{{ $query }}"<br>
            Mungkin maksud Anda:
            {{-- Pastikan $suggestion di-urlencode jika mengandung spasi atau karakter khusus --}}
            <a href="{{ route('search', ['query' => urlencode($suggestion)]) }}" class="text-decoration-underline fw-bold">
                {{ $suggestion }}
            </a>
        </div>
    @elseif($products->isEmpty() && isset($query) && trim($query) !== '')
        <div class="alert alert-info text-center">
            Produk dengan kata kunci <strong>"{{ $query }}"</strong> tidak ditemukan.
        </div>
    @elseif($products->isEmpty() && (!isset($query) || trim($query) === ''))
        {{-- Kondisi jika query kosong tapi entah bagaimana masuk ke halaman ini --}}
        <div class="alert alert-info text-center">
            Silakan masukkan kata kunci untuk mencari produk.
        </div>
    @endif

    @if(!$products->isEmpty())
        <div class="mb-4 text-center"> {{-- Ubah ke text-center jika ingin judulnya di tengah --}}
            <h5>Hasil pencarian untuk: <strong>"{{ $query }}"</strong></h5>
            <p class="text-muted">Menampilkan {{ $products->count() }} produk.</p>
        </div>

        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4"> {{-- Grid responsif --}}
            @foreach($products as $product)
                <div class="col"> {{-- Tidak perlu class mb-4 di sini karena g-4 (gap) sudah mengatur jarak --}}
                    {{-- ========================================================== --}}
                    {{-- PERUBAHAN UTAMA ADA DI HREF INI --}}
                    {{-- ========================================================== --}}
                    <a href="{{ route('produk.detail.publik', $product->id) }}" class="product-card text-decoration-none">
                        <div class="card-image-container">
                            @if($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="product-image">
                            @else
                                {{-- Placeholder jika tidak ada gambar --}}
                                <img src="https://via.placeholder.com/300x200.png?text=No+Image" alt="No image available" class="product-image">
                            @endif
                        </div>
                        <div class="card-content">
                            <div class="product-title">{{ $product->name }}</div>
                            <div class="price">Rp {{ number_format($product->price, 0, ',', '.') }}</div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>

        {{-- Tampilkan pagination jika ada --}}
        @if ($products instanceof \Illuminate\Pagination\LengthAwarePaginator && $products->hasPages())
            <div class="mt-4 d-flex justify-content-center">
                {{ $products->appends(request()->query())->links() }} {{-- appends untuk menjaga query string pencarian --}}
            </div>
        @endif

    @endif
</div>
@endsection