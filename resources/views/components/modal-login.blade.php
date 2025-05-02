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

            <form method="POST" action="{{ route('login') }}" id="loginForm">
                @csrf
                <div class="input-group">
                    <input type="email" name="email" placeholder="Email" required value="{{ old('email') }}">
                </div>
                <div class="input-group">
                    <input type="password" name="password" placeholder="Kata Sandi" required id="passwordField">
                    <span class="toggle-password" onclick="togglePassword()">
                        <i class="fa fa-eye"></i>
                    </span>
                </div>
                <div class="forgot-password">
                    <a href="{{ route('forgot.password') }}">Lupa Kata Sandi?</a>
                </div>
                <button class="btn" type="submit">Masuk</button>
            </form>

            <div class="text-center">
                Belum punya akun? <a href="javascript:void(0);" onclick="toggleRegister()">Daftar Akun</a>
            </div>
        </div>
    </div>

    <!-- Script JavaScript -->
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
            @if(session('error'))
                document.getElementById('modalLogin').style.display = 'flex';
            @endif
        });

        function toggleLoginModal() {
            const modal = document.getElementById('modalLogin');
            modal.style.display = modal.style.display === 'none' ? 'flex' : 'none';
        }

        function toggleRegister() {
            // Fungsi ini tergantung implementasi modal register kamu
            alert("Navigasi ke modal pendaftaran.");
        }
    </script>
</body>
</html>
