<div id="registerModal" class="modal-login-overlay" style="display: none;">
    <div class="modal-login-card">
        <button onclick="closeRegisterModal()" class="back-btn">&times;</button>

        <h2>Daftar Akun</h2>

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
                <input type="password" name="password" placeholder="Kata Sandi" required id="registerPassword">
                <span class="toggle-password" onclick="toggleRegisterPassword('registerPassword', this)">
                    <i class="fa fa-eye"></i>
                </span>
            </div>
            <div class="input-group">
                <input type="password" name="password_confirmation" placeholder="Konfirmasi Kata Sandi" required id="confirmPassword">
                <span class="toggle-password" onclick="toggleRegisterPassword('confirmPassword', this)">
                    <i class="fa fa-eye"></i>
                </span>
            </div>
            <button type="submit" class="btn">Daftar</button>
        </form>

        <div class="text-center">
            Sudah punya akun? <a href="javascript:void(0);" onclick="toggleLogin()">Masuk</a>
        </div>
    </div>
</div>
