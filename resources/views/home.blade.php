@extends('layouts.app')

@section('content')
<div class="container mt-4 position-relative">

    {{-- Banner --}}
    <div class="position-relative mb-5">
        <img src="{{ asset('storage/dashboard/banner.jpg') }}"
             class="img-fluid w-100 rounded shadow"
             alt="Banner Toko"
             style="max-height: 450px; object-fit: cover;">
        <div class="position-absolute top-50 start-0 translate-middle-y text-white ps-4 pe-5 py-3 banner-caption">
            <h2 class="fw-bold mb-1">Pilihan Terbaik untuk Elektronik dan Perabotan Rumah</h2>
        </div>
    </div>

    {{-- Mau cari apa hari ini? (Judul bagian) --}}
    <h4 class="fw-bold text-center mb-4">Mau cari apa hari ini?</h4>

    {{-- Kontainer untuk 4 produk yang akan diisi secara dinamis --}}
    <div class="row justify-content-center mb-5" id="dynamic-four-products-container">
        @for ($i = 0; $i < 4; $i++)
        {{-- Menggunakan kelas kolom yang sama persis dengan kode asli Anda --}}
        <div class="col-sm-6 col-md-4 col-lg-3 mb-4 product-slot-{{ $i }}">
            <a href="#" class="text-decoration-none text-dark product-link"> {{-- d-block w-100 jika diperlukan oleh style asli kartu Anda --}}
                {{-- Menggunakan struktur dan kelas yang sama persis dengan kode asli Anda --}}
                <div class="featured-card h-100"> {{-- Mungkin ada 'fade-in' dari style global, JS akan handle fade-in/out baru --}}
                    <div class="image-container">
                        <img src="{{ asset('images/placeholder_product.png') }}" {{-- GANTI DENGAN PLACEHOLDER VALID --}}
                             class="product-image"
                             alt="Memuat produk...">
                    </div>
                    <div class="card-body text-center">
                        <h4 class="card-title fw-bold mb-2 product-name">Memuat...</h4>
                        <h5 class="mb-0 text-primary product-price">Rp ...</h5>
                    </div>
                </div>
            </a>
        </div>
        @endfor
        <div class="col-12 text-center d-none" id="dynamic-products-error">
            <p>Gagal memuat produk. Silakan coba lagi nanti.</p>
        </div>
    </div>

    {{-- Produk Per Kategori (BAGIAN INI TETAP SAMA SEPERTI KODE ASLI ANDA) --}}
    <h4 class="fw-bold text-center mb-4">Produks</h4>
    <div class="d-flex flex-wrap justify-content-center mx-n2">
    @foreach($productsPerCategory as $product)
        <div class="col-6 col-sm-6 col-md-4 col-lg-3 mb-4 px-2 d-flex">
            <a href="{{ route('produk.detail.publik', $product->id) }}" class="text-decoration-none text-dark w-100">
                <div class="featured-card h-100 fade-in">
                    <div class="image-container">
                        <img src="{{ asset('storage/' . $product->image) }}"
                             class="product-image"
                             alt="{{ $product->name }}">
                    </div>
                    <div class="card-body text-center">
                        <h4 class="card-title fw-bold mb-2">{{ $product->name }}</h4>
                        <h5 class="mb-0 text-primary">Rp {{ number_format($product->price, 0, ',', '.') }}</h5>
                    </div>
                </div>
            </a>
        </div>
    @endforeach
    </div>

</div>
@endsection

@push('styles')
<style>
    /* ========================================================================== */
    /* CSS HANYA UNTUK ANIMASI FADE-IN/OUT PADA KARTU DINAMIS */
    /* TIDAK ADA CSS TAMBAHAN UNTUK STYLING VISUAL KARTU, GAMBAR, ATAU TEKSNYA */
    /* Ini akan membiarkan style global Anda atau default browser yang berlaku, */
    /* sama seperti pada kode asli Anda untuk bagian "Mau cari apa hari ini?". */
    /* ========================================================================== */

    #dynamic-four-products-container .featured-card {
        transition: opacity 0.4s ease-in-out;
        opacity: 0; /* Mulai transparan, akan di-fade-in oleh JS */
    }
    #dynamic-four-products-container .featured-card.fade-in-active {
        opacity: 1;
    }
    #dynamic-four-products-container .featured-card.fade-out-active {
        opacity: 0;
    }

    /*
    Jika Anda memiliki CSS di file global (misalnya app.css) untuk
    .featured-card, .image-container, .product-image, .card-body, .card-title
    yang Anda gunakan di kode asli, maka style tersebut akan otomatis
    diterapkan pada slot dinamis ini karena kita menggunakan kelas yang sama.
    Tidak perlu mendefinisikannya ulang di sini kecuali untuk animasi.
    */

    /* Anda BISA menambahkan style hover di sini jika style global Anda tidak punya
       dan Anda menginginkannya untuk SEMUA .featured-card (dinamis dan statis)
       Contoh:
    .featured-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 6px 12px rgba(0,0,0,0.1);
    }
    */
</style>
@endpush

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // ... (kode modal login Anda) ...
        @if (session('open_login_modal'))
            // ... (kode modal login Anda) ...
        @endif

        const fourProductsContainer = document.getElementById('dynamic-four-products-container');
        const errorDisplay = document.getElementById('dynamic-products-error');

        if (fourProductsContainer) {
            const productSlots = [];
            for (let i = 0; i < 4; i++) {
                const slotElement = fourProductsContainer.querySelector(`.product-slot-${i}`);
                if (slotElement) {
                    productSlots.push({
                        card: slotElement.querySelector('.featured-card'), // Target .featured-card
                        link: slotElement.querySelector('.product-link'),
                        image: slotElement.querySelector('.product-image'), // Target .product-image
                        name: slotElement.querySelector('.product-name'),   // Target .product-name
                        price: slotElement.querySelector('.product-price'), // Target .product-price
                    });
                }
            }
            const updateInterval = 8000;
            async function fetchAndUpdateFourProducts() {
                if (productSlots.length < 4) {
                    if(errorDisplay) errorDisplay.classList.remove('d-none');
                    return;
                }
                try {
                    productSlots.forEach(slot => {
                        if (slot.card && slot.card.classList.contains('fade-in-active')) {
                            slot.card.classList.add('fade-out-active');
                            slot.card.classList.remove('fade-in-active');
                        } else if (slot.card) {
                            slot.card.style.opacity = '0';
                            slot.card.classList.remove('fade-out-active', 'fade-in-active');
                        }
                    });
                    setTimeout(async () => {
                        const response = await fetch("{{ route('ajax.four_random_products') }}");
                        if (!response.ok) {
                            if(errorDisplay) errorDisplay.classList.remove('d-none');
                            productSlots.forEach(slot => { if (slot.card) slot.card.classList.remove('fade-out-active');});
                            return;
                        }
                        const result = await response.json();
                        if (result.success && result.data && result.data.length > 0) {
                            if(errorDisplay) errorDisplay.classList.add('d-none');
                            result.data.slice(0, 4).forEach((product, index) => {
                                const slot = productSlots[index];
                                if (slot && slot.link && slot.image && slot.name && slot.price && slot.card) {
                                    slot.link.href = product.detail_url;
                                    slot.image.src = product.image_url;
                                    slot.image.alt = product.name;
                                    slot.name.textContent = product.name;
                                    slot.price.textContent = product.formatted_price;

                                    // Penting: Jika gambar Anda sebelumnya tidak menggunakan object-fit:cover
                                    // secara eksplisit di CSS, dan Anda ingin perilaku default browser,
                                    // maka Anda mungkin TIDAK PERLU baris di bawah ini.
                                    // Namun, jika Anda ingin MEMASTIKAN gambar mengisi kontainer (dengan potensi crop),
                                    // Anda bisa menambahkan style ini via JS atau di CSS.
                                    // Untuk konsistensi dengan 'style="object-fit: cover;"' di HTML placeholder Anda:
                                    slot.image.style.objectFit = 'cover'; // Atau 'contain' jika itu yang Anda inginkan

                                    slot.card.classList.remove('fade-out-active');
                                    void slot.card.offsetWidth;
                                    slot.card.classList.add('fade-in-active');
                                    slot.card.style.opacity = '';
                                }
                            });
                            for (let i = result.data.length; i < 4; i++) {
                                if (productSlots[i] && productSlots[i].card) {
                                    productSlots[i].card.classList.remove('fade-in-active');
                                    productSlots[i].card.classList.add('fade-out-active');
                                }
                            }
                        } else {
                            if(errorDisplay) errorDisplay.classList.remove('d-none');
                             productSlots.forEach(slot => { if (slot.card) { slot.card.classList.remove('fade-in-active'); slot.card.classList.add('fade-out-active');}});
                        }
                    }, 400);
                } catch (error) {
                    console.error('Error saat fetch 4 produk acak:', error);
                    if(errorDisplay) errorDisplay.classList.remove('d-none');
                }
            }
            if (productSlots.length === 4) {
                fetchAndUpdateFourProducts();
                setInterval(fetchAndUpdateFourProducts, updateInterval);
            } else {
                if(errorDisplay) errorDisplay.classList.remove('d-none');
            }
        } else {
            if(errorDisplay) errorDisplay.classList.remove('d-none');
        }
    });
</script>
@endpush