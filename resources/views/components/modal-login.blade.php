<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login Modal</title>
    <!-- Link ke file CSS eksternal -->
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>
    <div id="modalLogin" class="modal-login-overlay" style="display: none;">
        <div class="modal-login-card">
            <button class="back-btn" onclick="toggleLoginModal()">×</button>

            <h2>Masuk</h2>

            <!-- Menampilkan error jika login gagal -->
            @if(session('error'))
                <div class="alert">{{ session('error') }}</div>
            @endif
            @if(session('success'))
                <div class="alert success">{{ session('success') }}</div>
            @endif
            {{-- Menampilkan error validasi --}}
            @if ($errors->any())
                <div class="alert" style="margin-bottom: 15px; background-color: #f8d7da; color: #721c24; border-color: #f5c6cb; padding: .75rem 1.25rem; border-radius: .25rem;">
                    <ul style="margin: 0; padding-left: 20px; list-style-type: disc;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}" id="loginForm">
                @csrf
                {{-- INPUT HIDDEN UNTUK REDIRECT URL --}}
                {{-- PASTIKAN NAME INI SESUAI DENGAN YANG DICEK DI AuthController --}}
                <input type="hidden" name="redirect_after_login" id="loginRedirectUrl" value="">

                <div class="input-group">
                    <input type="email" name="email" placeholder="Email" required value="{{ old('email') }}">
                </div>
                <div class="input-group">
                    <input type="password" name="password" placeholder="Kata Sandi" required id="passwordField">
                    <span class="toggle-password" onclick="togglePassword()">
                        <i class="fa fa-eye"></i>
                    </span>
                </div>

                {{-- BAGIAN LUPA KATA SANDI --}}
                <div class="forgot-password" style="text-align: right; margin-bottom: 15px; margin-top: 5px;">
                    @if (Route::has('forgot.password')) {{-- Menggunakan nama rute 'forgot.password' --}}
                        <a href="{{ route('forgot.password') }}" style="font-size: 0.9em; color: #555; text-decoration: none;">Lupa Kata Sandi?</a>
                    @else
                        <!-- Opsional: Tampilkan pesan jika rute tidak ada, untuk debugging -->
                        <!-- <p style="font-size: 0.8em; color: red;">Rute 'forgot.password' tidak ditemukan.</p> -->
                    @endif
                </div>

                <button class="btn" type="submit">Masuk</button>
            </form>

            <div class="text-center" style="margin-top: 20px;">
                Belum punya akun? <a href="javascript:void(0);" onclick="toggleRegister()" style="color: #284593; font-weight: bold; text-decoration: none;">Daftar Akun</a>
            </div>
        </div>
    </div>

    <!-- Script JavaScript (TIDAK ADA PERUBAHAN DI SINI DARI VERSI SEBELUMNYA YANG SUDAH BAIK) -->
    <script>
        function togglePassword() {
            const passwordField = document.getElementById('passwordField');
            const eyeIcon = document.querySelector('.toggle-password i');
            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                eyeIcon.classList.remove('fa-eye');
                eyeIcon.classList.add('fa-eye-slash');
            } else {
                passwordField.type = 'password';
                eyeIcon.classList.remove('fa-eye-slash');
                eyeIcon.classList.add('fa-eye');
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            @if(session('error') || $errors->any())
                const modal = document.getElementById('modalLogin');
                if (modal) {
                    modal.style.display = 'flex';
                }
            @endif
        });

        function toggleLoginModal() {
            const modal = document.getElementById('modalLogin');
            const loginRedirectUrlInput = document.getElementById('loginRedirectUrl');

            if (modal) {
                if (modal.style.display === 'none' || modal.style.display === '') {
                    const redirectUrlFromStorage = sessionStorage.getItem('redirect_after_login');
                    if (redirectUrlFromStorage && loginRedirectUrlInput) {
                        loginRedirectUrlInput.value = redirectUrlFromStorage;
                        console.log('Set loginRedirectUrl.value (name:redirect_after_login) to:', redirectUrlFromStorage);
                    } else if (loginRedirectUrlInput) {
                        loginRedirectUrlInput.value = '';
                         console.log('Cleared loginRedirectUrl.value (name:redirect_after_login)');
                    }
                    modal.style.display = 'flex';
                } else {
                    modal.style.display = 'none';
                    if (loginRedirectUrlInput) {
                         loginRedirectUrlInput.value = '';
                         console.log('Cleared loginRedirectUrl.value (name:redirect_after_login) on close');
                    }
                }
            }
        }

        function toggleRegister() {
            const modalLogin = document.getElementById('modalLogin');
            if (modalLogin && modalLogin.style.display !== 'none') {
                toggleLoginModal();
            }
            // Arahkan ke halaman register atau buka modal register
            // Contoh jika Anda punya rute bernama 'register':
            // if ({{ Route::has('register') ? 'true' : 'false' }}) {
            //    window.location.href = "{{ route('register') }}";
            // } else {
            //    alert("Halaman pendaftaran belum tersedia.");
            // }
            alert("Navigasi ke modal/halaman pendaftaran.");
        }
    </script>
</body>
</html>