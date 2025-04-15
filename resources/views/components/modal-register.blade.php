<!-- resources/views/components/modal-register.blade.php -->
<div id="registerModal" class="modal-login-overlay" style="display: none;">
    <div class="modal-login-card">
        <button onclick="toggleRegisterModal()" class="back-btn">&times;</button>

        <h2>Register</h2>

        @if(session('error'))
            <div class="alert">{{ session('error') }}</div>
        @endif
        @if(session('success'))
            <div class="alert success">{{ session('success') }}</div>
        @endif

        <form action="{{ route('register') }}" method="POST">
            @csrf
            <div class="input-group">
                <input type="text" name="name" placeholder="Nama" required>
            </div>
            <div class="input-group">
                <input type="email" name="email" placeholder="Email" required>
            </div>
            <div class="input-group">
                <input type="password" name="password" placeholder="Password" required>
            </div>
            <div class="input-group">
                <input type="password" name="password_confirmation" placeholder="Konfirmasi Password" required>
            </div>
            <button type="submit" class="btn">Daftar</button>
        </form>

        <div class="text-center">
            Sudah punya akun? <a href="javascript:void(0);" onclick="toggleLogin()">Login</a>
        </div>
    </div>
</div>
