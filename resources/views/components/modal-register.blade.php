<div id="registerModal" class="modal-login-overlay" style="display: none;">
    <div class="modal-login-card">
        <button onclick="toggleRegisterModal()" class="back-btn">×</button>

        <h2>Daftar Akun</h2>

        {{-- Menampilkan error validasi DARI SERVER, spesifik untuk 'register' error bag --}}
        @if ($errors->hasBag('register'))
            <div class="alert" style="margin-bottom: 15px; background-color: #f8d7da; color: #721c24; border-color: #f5c6cb; padding: .75rem 1.25rem; border-radius: .25rem;">
                <ul style="margin: 0; padding-left: 20px; list-style-type: disc;">
                    @foreach ($errors->getBag('register')->all() as $error) {{-- Mengambil error dari bag 'register' --}}
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        {{-- Hapus session 'register_success' dan 'register_error' karena redirect sukses akan ditangani oleh flag 'show_login_modal' --}}

        <form action="{{ route('register') }}" method="POST" id="registerForm">
            @csrf
            <div class="input-group">
                <input type="text" name="name" placeholder="Nama" required value="{{ old('name') }}">
            </div>
            <div class="input-group">
                <input type="email" name="email" placeholder="Email" required value="{{ old('email') }}">
            </div>
            <div class="input-group">
                <input type="password" name="password" placeholder="Kata Sandi" required id="registerPassword">
                <span class="toggle-password" onclick="togglePasswordVisibility('registerPassword', this.querySelector('i'))">
                    <i class="fa fa-eye"></i>
                </span>
            </div>
            <div class="input-group">
                <input type="password" name="password_confirmation" placeholder="Konfirmasi Kata Sandi" required id="confirmPassword">
                <span class="toggle-password" onclick="togglePasswordVisibility('confirmPassword', this.querySelector('i'))">
                    <i class="fa fa-eye"></i>
                </span>
            </div>
            <button type="submit" class="btn">Daftar</button>
        </form>

        <div class="text-center" style="margin-top: 20px;">
            Sudah punya akun? <a href="javascript:void(0);" onclick="switchToLoginModal()" style="color: #284593; font-weight: bold; text-decoration: none;">Masuk</a>
        </div>
    </div>
</div>

{{-- JavaScript untuk Modal Registrasi --}}
<script>
    function togglePasswordVisibility(fieldId, iconElement) {
        const passwordField = document.getElementById(fieldId);
        if (passwordField && iconElement) {
            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                iconElement.classList.remove('fa-eye');
                iconElement.classList.add('fa-eye-slash');
            } else {
                passwordField.type = 'password';
                iconElement.classList.remove('fa-eye-slash');
                iconElement.classList.add('fa-eye');
            }
        }
    }

    function toggleRegisterModal(forceShow = false) {
        const modal = document.getElementById('registerModal');
        if (modal) {
            if (forceShow) {
                modal.style.display = 'flex';
            } else {
                modal.style.display = modal.style.display === 'none' ? 'flex' : 'none';
            }

            // Jika modal ditampilkan karena ada error validasi dari server, scroll ke atas modal
            @if ($errors->hasBag('register') && session('open_register_modal_on_error'))
                if (modal.style.display === 'flex') {
                    setTimeout(() => {
                        const card = modal.querySelector('.modal-login-card');
                        if(card) card.scrollTop = 0;
                    }, 100);
                }
            @endif
        }
    }

    function switchToLoginModal() {
        const registerModal = document.getElementById('registerModal');
        if (registerModal) {
            registerModal.style.display = 'none';
        }
        if (typeof toggleLoginModal === 'function') {
            toggleLoginModal();
            // Bersihkan pesan sukses login jika ada, karena kita beralih dari registrasi
            const loginModalCard = document.querySelector('#modalLogin .modal-login-card');
            if (loginModalCard) {
                const successDiv = loginModalCard.querySelector('.alert.success-message-placeholder');
                if (successDiv) successDiv.style.display = 'none';
            }
        } else {
            console.error('Fungsi toggleLoginModal() tidak ditemukan.');
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        // Logika untuk otomatis membuka modal registrasi jika ada error validasi dari server setelah submit
        @if (session('open_register_modal_on_error'))
            toggleRegisterModal(true); // Paksa tampilkan modal registrasi
        @endif
    });
</script>