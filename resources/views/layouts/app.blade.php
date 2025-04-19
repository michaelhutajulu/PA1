<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bintang Serasi</title>

    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Custom CSS -->
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
        }
        .nav-link:hover {
            text-decoration: underline;
        }

        /* CSS modal login dan register (global agar tersedia di semua halaman) */
        .modal-login-overlay {
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.6);
            backdrop-filter: blur(6px);
            display: none;
            align-items: center;
            justify-content: center;
            z-index: 9999;
        }

        .modal-login-card {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(15px);
            border-radius: 15px;
            padding: 40px;
            width: 100%;
            max-width: 400px;
            box-shadow: 0 0 30px rgba(0, 0, 0, 0.4);
            color: #111;
            position: relative;
            font-family: 'Segoe UI', sans-serif;
        }

        .modal-login-card h2 {
            text-align: center;
            margin-bottom: 30px;
            font-size: 28px;
            color: #111;
        }

        .modal-login-card .input-group {
            margin-bottom: 20px;
        }

        .modal-login-card input {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 8px;
            background: rgba(255,255,255,0.6);
            color: #111;
            font-size: 15px;
        }

        .modal-login-card input::placeholder {
            color: #666;
        }

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

        .modal-login-card .alert {
            margin-bottom: 15px;
            background: rgba(255, 0, 0, 0.2);
            padding: 10px;
            border-radius: 8px;
            color: #a10000;
        }

        .modal-login-card .alert.success {
            background: rgba(0, 255, 0, 0.2);
            color: #007a00;
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

         /* === Banner caption === */
    .banner-caption {
        background-color: rgba(0, 0, 0, 0.5);
        border-radius: 12px;
        max-width: 90%;
        backdrop-filter: blur(4px);
    }

    /* === Card style === */
    .custom-card {
        border-radius: 16px;
        background-color: #ffffffdd;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
        transition: all 0.5s ease;
        position: relative;
        z-index: 1;
        border: 1px solid transparent;
    }

    .custom-card:hover {
        transform: translateY(-10px) scale(1.03);
        box-shadow: 0 0 20px rgba(0, 255, 255, 0.5);
        border-color: #00f0ff;
    }

    /* === Zoom image effect === */
    .image-container {
        overflow: hidden;
        border-top-left-radius: 16px;
        border-top-right-radius: 16px;
    }

    .product-image {
        height: 200px;
        object-fit: cover;
        transition: transform 0.4s ease;
        width: 100%;
    }

    .custom-card:hover .product-image {
        transform: scale(1.1);
    }

    /* === Shine overlay === */
    .shine-overlay {
        content: "";
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(
            120deg,
            transparent,
            rgba(255, 255, 255, 0.4),
            transparent
        );
        z-index: 2;
        transition: all 0.6s ease-in-out;
    }

    .custom-card:hover .shine-overlay {
        left: 100%;
    }

    /* === Fade-in animation === */
    .fade-in {
        animation: fadeInUp 0.6s ease-in-out both;
    }

    @keyframes fadeInUp {
        0% {
            opacity: 0;
            transform: translateY(20px);
        }
        100% {
            opacity: 1;
            transform: translateY(0);
        }
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
