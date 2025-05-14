{{-- File: resources/views/partials/modal_login.blade.php (atau langsung di layout) --}}
{{-- Menggunakan KODE ASLI ANDA + Penambahan untuk Notifikasi Sukses Reset --}}

<!DOCTYPE html> {{-- Jika ini adalah file komponen, tag html, head, body mungkin tidak diperlukan --}}
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login Modal</title> {{-- Judul ini mungkin tidak relevan jika ini komponen --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        /* SEMUA STYLE ASLI ANDA TETAP DI SINI */
        *,*::before,*::after{box-sizing:border-box}body{font-family:'Segoe UI',-apple-system,BlinkMacSystemFont,"Roboto","Helvetica Neue",Arial,sans-serif;margin:0}
        .auth-modal__overlay{position:fixed;inset:0;background-color:rgba(0,0,0,.65);display:none;align-items:center;justify-content:center;z-index:1070;padding:1rem;overflow-y:auto}
        .auth-modal__card{background-color:#fff;border-radius:8px;border:1px solid #dee2e6;padding:2rem 2.5rem;max-width:400px;width:100%;box-shadow:0 12px 35px rgba(0,0,0,.12);color:#212529;position:relative;animation:authModalFadeIn .3s ease-out}
        @keyframes authModalFadeIn{from{opacity:0;transform:translateY(-10px)}to{opacity:1;transform:translateY(0)}}
        .auth-modal__close-button{position:absolute;top:.75rem;right:.75rem;background:transparent;border:none;color:#6c757d;font-size:1.75rem;line-height:1;padding:.25rem;cursor:pointer;transition:color .2s ease}
        .auth-modal__close-button:hover{color:#343a40}
        .auth-modal__title{text-align:center;margin-top:0;margin-bottom:1.8rem;font-size:1.6rem;font-weight:600;color:#343a40}
        .auth-modal__alert{font-size:.875rem;margin-bottom:1rem;padding:.75rem 1rem;border-radius:6px;border-width:1px;border-style:solid}
        .auth-modal__alert--error{background-color:#f8d7da;border-color:#f5c6cb;color:#721c24}
        .auth-modal__alert--success{background-color:#d1e7dd;border-color:#badbcc;color:#0f5132}
        .auth-modal__alert ul{margin-bottom:0;padding-left:1.1rem;list-style-type:disc}
        .auth-modal__alert ul li{margin-bottom:.2rem}
        .auth-modal__form-group{margin-bottom:1.1rem;position:relative}
        .auth-modal__input{display:block;width:100%;padding:.75rem 1rem;font-size:.95rem;font-weight:400;line-height:1.6;color:#495057;background-color:#fff;background-clip:padding-box;border:1px solid #ced4da;appearance:none;border-radius:8px;transition:border-color .15s ease-in-out,box-shadow .15s ease-in-out}
        .auth-modal__input::placeholder{color:#6c757d;opacity:1}
        .auth-modal__input:focus{color:#495057;background-color:#fff;border-color:#86b7fe;outline:0;box-shadow:0 0 0 .2rem rgba(13,110,253,.25)}
        .auth-modal__input[type=password]{padding-right:2.75rem} /* Penting untuk ikon mata */
        .auth-modal__password-icon-toggle{position:absolute;right:.75rem;top:50%;transform:translateY(-50%);cursor:pointer;color:#6c757d;z-index:3;padding:.3rem .4rem;line-height:1;display:flex;align-items:center;justify-content:center}
        .auth-modal__password-icon-toggle i{font-size:.9rem}
        .auth-modal__options-link-container{text-align:right;margin-bottom:1.25rem;margin-top:-.5rem}
        .auth-modal__options-link{font-size:.8rem;color:#6c757d;text-decoration:none;transition:color .2s ease}
        .auth-modal__options-link:hover{color:#343a40;text-decoration:underline}
        .auth-modal__submit-button{display:inline-block;font-weight:500;line-height:1.6;color:#fff;text-align:center;text-decoration:none;vertical-align:middle;cursor:pointer;user-select:none;background-color:#0d6efd;border:1px solid #0d6efd;width:100%;padding:.65rem 1rem;font-size:1rem;border-radius:8px;transition:background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out}
        .auth-modal__submit-button:hover{background-color:#0b5ed7;border-color:#0a58ca}
        .auth-modal__submit-button:focus{background-color:#0b5ed7;border-color:#0a58ca;box-shadow:0 0 0 .2rem rgba(49,132,253,.5)}
        .auth-modal__footer-text{text-align:center;margin-top:1.25rem;font-size:.875rem;color:#6c757d}
        .auth-modal__footer-link{color:#0d6efd;font-weight:500;text-decoration:none;transition:color .2s ease}
        .auth-modal__footer-link:hover{color:#0a58ca;text-decoration:underline}
        .auth-modal__visually-hidden{position:absolute!important;width:1px!important;height:1px!important;padding:0!important;margin:-1px!important;overflow:hidden!important;clip:rect(0,0,0,0)!important;white-space:nowrap!important;border:0!important}
    </style>
</head>
<body> {{-- Jika ini adalah file komponen, tag body mungkin tidak diperlukan --}}
    <div id="modalLogin" class="auth-modal__overlay" style="display: none;">
        <div class="auth-modal__card">
            <button class="auth-modal__close-button" onclick="toggleLoginModal()" aria-label="Tutup">×</button>
            <h2 class="auth-modal__title">Masuk</h2>

            {{-- 👇 ***** TEMPAT BARU UNTUK NOTIFIKASI SUKSES RESET PASSWORD ***** 👇 --}}
            <div id="loginModalSuccessNotification" class="auth-modal__alert auth-modal__alert--success" role="alert" style="display: none; margin-bottom: 1rem;">
                {{-- Pesan akan diisi oleh JavaScript --}}
            </div>
            {{-- 👆 ***** AKHIR TEMPAT BARU ***** 👆 --}}

            {{-- Pesan error dan form standar Anda --}}
            @if(session('error')) <div class="auth-modal__alert auth-modal__alert--error" role="alert">{{ session('error') }}</div> @endif
            {{-- Kondisi untuk session('success') asli Anda jika diperlukan untuk alur lain --}}
            @if(session('success') && !session('status_from_password_reset'))
                <div class="auth-modal__alert auth-modal__alert--success" role="alert">{{ session('success') }}</div>
            @endif
            @if ($errors->any()) <div class="auth-modal__alert auth-modal__alert--error" role="alert"><ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div> @endif

            <form method="POST" action="{{ route('login') }}" id="loginForm">
                @csrf
                <input type="hidden" name="redirect_after_login" id="loginRedirectUrl" value="">
                <div class="auth-modal__form-group">
                    <label for="loginEmail" class="auth-modal__visually-hidden">Email</label>
                    <input type="email" id="loginEmail" class="auth-modal__input" name="email" placeholder="Email" required value="{{ old('email') }}">
                </div>
                <div class="auth-modal__form-group">
                    <label for="passwordField" class="auth-modal__visually-hidden">Kata Sandi</label>
                    <input type="password" id="passwordField" class="auth-modal__input" name="password" placeholder="Kata Sandi" required>
                    {{-- IKON MATA ASLI ANDA --}}
                    <span class="auth-modal__password-icon-toggle" onclick="togglePassword()" aria-label="Tampilkan/Sembunyikan Kata Sandi">
                        <i class="fa fa-eye" aria-hidden="true"></i>
                    </span>
                </div>
                <div class="auth-modal__options-link-container">
                    @if (Route::has('forgot.password'))
                        <a href="{{ route('forgot.password') }}" class="auth-modal__options-link">Lupa Kata Sandi?</a>
                    @endif
                </div>
                <button class="auth-modal__submit-button" type="submit">Masuk</button>
            </form>
            <div class="auth-modal__footer-text">
                Belum punya akun?
                <a href="javascript:void(0);" class="auth-modal__footer-link" onclick="callToggleRegisterFromRegisterModal()">Daftar Akun</a>
            </div>
        </div>
    </div>

    {{-- SCRIPT ASLI ANDA + PENAMBAHAN FUNGSI BARU --}}
    <script>
        // FUNGSI togglePassword() ASLI ANDA
        function togglePassword() {
            const passwordField = document.getElementById('passwordField');
            // Selector ikon mata dari kode asli Anda (sudah benar jika HTML-nya sesuai)
            const eyeIcon = document.querySelector('#modalLogin .auth-modal__form-group .auth-modal__password-icon-toggle i');
            if (passwordField && eyeIcon) {
                if (passwordField.type === 'password') {
                    passwordField.type = 'text';
                    eyeIcon.classList.remove('fa-eye');
                    eyeIcon.classList.add('fa-eye-slash');
                } else {
                    passwordField.type = 'password';
                    eyeIcon.classList.remove('fa-eye-slash');
                    eyeIcon.classList.add('fa-eye');
                }
            } else {
                if (!passwordField) console.error("PasswordField tidak ditemukan dalam togglePassword.");
                if (!eyeIcon) console.error("EyeIcon tidak ditemukan dalam togglePassword. Selector: '#modalLogin .auth-modal__form-group .auth-modal__password-icon-toggle i'");
            }
        }

        // FUNGSI toggleLoginModal() ASLI ANDA, DENGAN PENAMBAHAN UNTUK MEMBERSIHKAN NOTIFIKASI
        function toggleLoginModal() { // Pastikan ini global
            const modal = document.getElementById('modalLogin');
            const loginRedirectUrlInput = document.getElementById('loginRedirectUrl');
            const successNotificationElement = document.getElementById('loginModalSuccessNotification'); // Ambil elemen notifikasi

            if (modal) {
                const isDisplayed = modal.style.display === 'flex';
                modal.style.display = isDisplayed ? 'none' : 'flex';

                if (isDisplayed && successNotificationElement) { // Jika modal ditutup
                    successNotificationElement.style.display = 'none'; // Sembunyikan notifikasi
                    successNotificationElement.textContent = '';    // Bersihkan teksnya
                }

                if (!isDisplayed) { // Jika modal dibuka
                    const redirectUrlFromStorage = sessionStorage.getItem('redirect_after_login');
                    if (redirectUrlFromStorage && loginRedirectUrlInput) { loginRedirectUrlInput.value = redirectUrlFromStorage; }
                    else if (loginRedirectUrlInput) { loginRedirectUrlInput.value = ''; }
                } else { // Jika modal ditutup
                    if (loginRedirectUrlInput) { loginRedirectUrlInput.value = ''; }
                }
            }
        }

        // DOMContentLoaded ASLI ANDA (untuk membuka modal jika ada error dari server)
        document.addEventListener('DOMContentLoaded', function() {
            @if(session('error') || $errors->any())
                const modal = document.getElementById('modalLogin');
                // Pertimbangkan untuk membuat kondisi ini lebih spesifik agar hanya error login yang membuka modal
                if (modal) {
                    // Cek apakah error berasal dari form login, bukan dari proses lain
                    // Untuk sekarang, kita asumsikan jika ada error dan modal ada, kita tampilkan
                    // toggleLoginModal(); // Lebih baik memanggil fungsi toggle jika sudah ada logika di sana
                    modal.style.display = 'flex'; // Sesuai kode asli Anda
                    console.log("Modal login dibuka karena session error atau $errors->any()");
                }
            @endif
        });

        // FUNGSI callToggleRegisterFromRegisterModal() ASLI ANDA
        function callToggleRegisterFromRegisterModal() {
            const modalLogin = document.getElementById('modalLogin');
            if (modalLogin && modalLogin.style.display === 'flex') {
                toggleLoginModal();
            }
            if (typeof window.toggleRegisterModal === 'function') {
                window.toggleRegisterModal(true);
            } else {
                console.error("Fungsi global 'toggleRegisterModal' dari komponen modal register tidak ditemukan.");
                alert("Tidak dapat membuka modal pendaftaran saat ini. Fungsi 'toggleRegisterModal' tidak terdefinisi.");
            }
        }

        // 👇 ***** FUNGSI BARU UNTUK MENAMPILKAN NOTIFIKASI SUKSES DI DALAM MODAL LOGIN ***** 👇
        /**
         * Menampilkan notifikasi sukses di dalam modal login.
         * @param {string} message Pesan yang akan ditampilkan.
         */
        function showLoginModalSuccessNotification(message) { // Pastikan ini global
            const notificationElement = document.getElementById('loginModalSuccessNotification');
            if (notificationElement && message) {
                notificationElement.textContent = message;
                notificationElement.style.display = 'block';

                setTimeout(() => {
                    if (notificationElement.style.display === 'block') {
                        notificationElement.style.display = 'none';
                        notificationElement.textContent = '';
                    }
                }, 7000); // Hilang setelah 7 detik
            }
        }
        // 👆 ***** AKHIR FUNGSI BARU ***** 👆
    </script>
</body>
</html>