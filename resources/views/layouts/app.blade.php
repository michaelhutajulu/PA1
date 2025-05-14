<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bintang Serasi</title>
    <link rel="icon" href="{{ asset('logo2.png') }}" type="image/x-icon">

    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Custom CSS -->
    <style>
body {
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif; /* Font modern & bersih */
    /* Gradien vertikal halus */
    background: linear-gradient(to bottom,
        /* Peach/Apricot Sangat Pucat di Atas */
        rgba(255, 224, 189, 0.4) 0%, /* #ffe0bd dengan opacity 40% */

        /* Kuning Mentega/Krim Sangat Pucat di Tengah */
        rgba(255, 248, 220, 0.5) 40%, /* #fff8dc dengan opacity 50% */

        /* Off-white/Putih Gading di Bawah */
        #fffdf9 80%,
        #fefcfb 100%
    );
    color: #5D4037; /* Coklat tua yang hangat untuk teks utama */
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    min-height: 100vh;
    overflow-x: hidden;
    line-height: 1.6; /* Keterbacaan yang baik */
}

    /* Modal Login dan Register */
    .modal-login-overlay {
        position: fixed;
        inset: 0;
        background: rgba(0, 0, 0, 0.5);
        display: none;
        align-items: center;
        justify-content: center;
        z-index: 9999;
    }

    .modal-login-card {
        background: #ffffff;
        border-radius: 15px;
        padding: 40px;
        max-width: 400px;
        width: 100%;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
        color: #111;
        font-family: 'Segoe UI', sans-serif;
        position: relative; /* ✅ Tambahan agar tombol .back-btn muncul */
    }

    .modal-login-card h2 {
        text-align: center;
        margin-bottom: 30px;
        font-size: 28px;
        color: #333;
    }

    .modal-login-card .input-group {
        margin-bottom: 20px;
    }

    .modal-login-card input {
        width: 100%;
        padding: 12px;
        border: 1px solid #ccc;
        background: #f8f9fa;
        color: #333;
        font-size: 15px;
        transition: border-color 0.3s ease;
    }

    .modal-login-card input::placeholder {
        color: #888;
    }

    .modal-login-card input:focus {
        border-color: #4facfe;
        outline: none;
    }

    .modal-login-card .btn {
        width: 100%;
        padding: 12px;
        background: #4facfe;
        border: none;
        border-radius: 10px;
        color: #fff;
        font-weight: bold;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .modal-login-card .btn:hover {
        background: #00c6fe;
    }

    .modal-login-card .text-center {
        text-align: center;
        margin-top: 15px;
    }

    .modal-login-card a {
        color: #0077cc;
        text-decoration: underline;
    }

    .modal-login-card .back-btn {
        position: absolute;
        top: 15px;
        right: 15px;
        background: rgba(255, 255, 255, 0.3);
        border: 1px solid #ccc;
        border-radius: 5px;
        padding: 4px 10px;
        color: #111;
        font-size: 16px;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .modal-login-card .back-btn:hover {
        background: rgba(255, 255, 255, 0.5);
        border-color: #999;
    }

    /* Banner caption */
    .banner-caption {
        background-color: rgba(0, 0, 0, 0.3);
        border-radius: 12px;
        max-width: 90%;
        padding: 20px;
        margin-top: 20px;
        transition: background-color 0.4s ease;
    }

    .banner-caption:hover {
        background-color: rgba(0, 0, 0, 0.5);
    }
.featured-card {
    border-radius: 20px;
    background: linear-gradient(135deg,rgb(247, 247, 247) 0%,rgb(248, 248, 248) 100%);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
    transition: transform 0.5s ease, box-shadow 0.5s ease;
    overflow: hidden;
    position: relative;
}

.featured-card:hover {
    transform: translateY(-8px) scale(1.02);
    box-shadow: 0 12px 30px rgba(0, 0, 0, 0.15);
}

.featured-card .image-container {
    height: 180px;
    overflow: hidden;
}

.featured-card .product-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.5s ease;
}

.featured-card:hover .product-image {
    transform: scale(1.1);
}

.featured-card .card-body {
    padding: 20px;
    background-color: #ffffff;
}

.featured-card .card-title {
    font-size: 1.1rem;
    color: #333;
}

.featured-card .text-muted {
    font-size: 0.9rem;
    color: #666;
}

.input-group {
    position: relative;
}

.toggle-password {
    position: absolute;
    right: 10px;
    top: 50%;
    transform: translateY(-50%);
    cursor: pointer;
    color: #888;
}


</style>

</head>
<body>

    {{-- Navbar --}}
    @include('partials.navbar')

    {{-- Konten --}}
    <main class="py-4">
        @yield('content')
    </main>

    {{-- Footer --}}
    @include('partials.footer')

    {{-- ✅ Modal Login & Register Global --}}
    @include('components.modal-login')
    @include('components.modal-register')

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    {{-- ✅ Script Modal Login/Register --}}
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

            sessionStorage.removeItem('redirect_after_login');
        });
    </script>

    {{-- ✅ Agar bisa push script tambahan dari halaman --}}
    @stack('scripts')

</body>
</html>