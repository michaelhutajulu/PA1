<div id="modalLogin" class="modal-login-overlay" style="display: none;">
    <div class="modal-login-card">
        <button class="back-btn" onclick="toggleLoginModal()">×</button>

        <h2>Masuk</h2>

        @if(session('error'))
            <div class="alert">{{ session('error') }}</div>
        @endif
        @if(session('success'))
            <div class="alert success">{{ session('success') }}</div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="input-group">
                <input type="email" name="email" placeholder="Email" required>
            </div>
            <div class="input-group">
                <input type="password" name="password" placeholder="Kata Sandi" required>
            </div>
            <button class="btn" type="submit">Masuk</button>
        </form>

        <div class="text-center">
            Belum punya akun? <a href="javascript:void(0);" onclick="toggleRegister()">Daftar Akun</a>
        </div>
    </div>
</div>
