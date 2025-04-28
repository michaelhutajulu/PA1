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

<script>
    // Fungsi untuk membuka dan menutup password
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

    // Fungsi untuk tetap menampilkan modal login setelah login gagal
    document.addEventListener('DOMContentLoaded', function() {
        @if(session('error'))
            // Tetap tampilkan modal login jika login gagal
            document.getElementById('modalLogin').style.display = 'flex';
        @endif
    });
</script>
