@extends('layouts.app')

@section('content')
<div class="container mt-4">

    {{-- Banner dengan Teks di Atasnya --}}
    <div class="position-relative mb-5">
        <img src="{{ asset('storage/dashboard/banner.jpg') }}" class="img-fluid w-100 rounded shadow" alt="Banner Toko" style="max-height: 450px; object-fit: cover;">
        <div class="position-absolute top-50 start-0 translate-middle-y text-white px-4" style="background: rgba(0, 0, 0, 0.4); border-radius: 10px;">
            <h2 class="fw-bold">Bintang Serasi</h2>
            <p class="fs-5">Tempat Terbaik Mencari Elektronik</p>
        </div>
    </div>

    {{-- Produk Unggulan --}}
    <h3 class="fw-bold mb-4 text-center">Produk Unggulan</h3>
    <div class="row">
        @foreach($products as $product)
        <div class="col-md-3 mb-4">
            <div class="card shadow-sm h-100">
                <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top" alt="{{ $product->name }}" style="height: 200px; object-fit: cover;">
                <div class="card-body text-center">
                    <h5>{{ $product->name }}</h5>
                    <p class="text-muted">Rp. {{ number_format($product->price, 0, ',', '.') }}</p>
                    <a href="{{ route('admin.products.show', $product->id) }}" class="btn btn-outline-primary btn-sm">Detail</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>

</div>

{{-- Modal Login --}}
@include('components.modal-login')

{{-- Modal Register --}}
@include('components.modal-register')

@endsection

@push('scripts')
<style>
/* CSS modal login dan register (sama) */
.modal-login-overlay {
    position: fixed;
    inset: 0;
    background: rgba(0, 0, 0, 0.4);
    backdrop-filter: blur(6px);
    display: none;
    align-items: center;
    justify-content: center;
    z-index: 9999;
}
.modal-login-card {
    background: rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(15px);
    border-radius: 15px;
    padding: 40px;
    width: 100%;
    max-width: 400px;
    box-shadow: 0 0 20px rgba(0,0,0,0.3);
    color: #fff;
    position: relative;
    font-family: 'Segoe UI', sans-serif;
}
.modal-login-card h2 { text-align: center; margin-bottom: 30px; font-size: 28px; }
.modal-login-card .input-group { margin-bottom: 20px; }
.modal-login-card input {
    width: 100%;
    padding: 12px;
    border: none;
    border-radius: 8px;
    background: rgba(255,255,255,0.15);
    color: #fff;
    font-size: 14px;
}
.modal-login-card input::placeholder { color: #ccc; }
.modal-login-card .btn {
    width: 100%;
    padding: 12px;
    background: #4facfe;
    border: none;
    border-radius: 8px;
    color: #fff;
    font-weight: bold;
    cursor: pointer;
    transition: 0.3s ease;
}
.modal-login-card .btn:hover { background: #00f2fe; }
.modal-login-card .text-center { text-align: center; margin-top: 15px; }
.modal-login-card a { color: #add8ff; text-decoration: none; }
.modal-login-card .alert {
    margin-bottom: 15px;
    background: rgba(255, 0, 0, 0.2);
    padding: 10px;
    border-radius: 8px;
    color: #ffb3b3;
}
.modal-login-card .alert.success {
    background: rgba(0, 255, 0, 0.2);
    color: #b2ffb2;
}
.modal-login-card .back-btn {
    position: absolute;
    top: 15px;
    right: 15px;
    background: transparent;
    border: 1px solid rgba(252, 252, 252, 0.53);
    border-radius: 5px;
    padding: 4px 10px;
    color: #fff;
    font-size: 16px;
    cursor: pointer;
    backdrop-filter: blur(4px);
    transition: all 0.3s ease;
}
.modal-login-card .back-btn:hover {
    background: rgba(255, 255, 255, 0.1);
    border-color: rgba(255, 255, 255, 0.5);
}
</style>

<script>
    function toggleLoginModal() {
        const modal = document.getElementById('modalLogin');
        modal.style.display = (modal.style.display === 'flex') ? 'none' : 'flex';
    }

    function openLoginModal() {
        document.getElementById('modalLogin').style.display = 'flex';
    }

    function closeLoginModal() {
        document.getElementById('modalLogin').style.display = 'none';
    }

    function openRegisterModal() {
        document.getElementById('registerModal').style.display = 'flex';
        closeLoginModal();
    }

    function closeRegisterModal() {
        document.getElementById('registerModal').style.display = 'none';
    }

    function toggleLogin() {
        closeRegisterModal();
        openLoginModal();
    }

    function toggleRegister() {
        closeLoginModal();
        openRegisterModal();
    }

    document.addEventListener('DOMContentLoaded', function () {
        const redirectUrl = sessionStorage.getItem('redirect_after_login');
        if (redirectUrl) {
            const form = document.querySelector('#modalLogin form');
            if (form) {
                const hiddenInput = document.createElement('input');
                hiddenInput.type = 'hidden';
                hiddenInput.name = 'redirect_after_login';
                hiddenInput.value = redirectUrl;
                form.appendChild(hiddenInput);
            }
        }

        // Bersihkan setelah login
        sessionStorage.removeItem('redirect_after_login');
    });
</script>
@endpush
