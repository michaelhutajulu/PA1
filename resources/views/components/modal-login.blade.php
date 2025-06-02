{{-- File: resources/views/partials/modal_login.blade.php --}}

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login Modal</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        /* STYLE ANDA */
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
        .auth-modal__input[type=password]{padding-right:2.75rem}
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
<body>
    <div id="modalLogin" class="auth-modal__overlay" style="display: none;">
        <div class="auth-modal__card">
            <button class="auth-modal__close-button" onclick="toggleLoginModal()" aria-label="Tutup">×</button>
            <h2 class="auth-modal__title">Masuk</h2>

            <div id="loginModalGeneralSuccessNotification" class="auth-modal__alert auth-modal__alert--success" role="alert" style="display: none; margin-bottom: 1rem;">
                {{-- Pesan akan diisi oleh JavaScript --}}
            </div>

            {{-- Menampilkan error dari validasi form login (bag 'login') --}}
            @if ($errors->hasBag('login'))
                <div class="auth-modal__alert auth-modal__alert--error" role="alert">
                    <ul>
                        @foreach ($errors->getBag('login')->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            {{-- Menampilkan error global (session('error')), HANYA JIKA TIDAK ADA error spesifik dari form login --}}
            @elseif (session('error') && !$errors->hasBag('login'))
                <div class="auth-modal__alert auth-modal__alert--error" role="alert">
                    <ul>
                        <li>{{ session('error') }}</li>
                    </ul>
                </div>
            @endif {{-- Akhir dari @if ($errors->hasBag('login')) --}}


            {{-- Kondisi untuk session('success') asli Anda jika diperlukan untuk alur lain (misal dari reset password) --}}
            {{-- Hanya tampilkan jika BUKAN dari sukses registrasi (karena itu ditangani JS) --}}
            @if(session('success') && !session('login_success_message') && !session('show_login_modal'))
                <div class="auth-modal__alert auth-modal__alert--success" role="alert">{{ session('success') }}</div>
            @endif {{-- Akhir dari @if(session('success') ... ) --}}


            <form method="POST" action="{{ route('login') }}" id="loginForm">
                @csrf
                <input type="hidden" name="redirect_after_login" id="loginRedirectUrl" value="">
                <div class="auth-modal__form-group">
                    <label for="loginEmail" class="auth-modal__visually-hidden">Email</label>
                    <input type="email" id="loginEmail" class="auth-modal__input" name="email" placeholder="Email" required value="{{ old('email', session('login_attempt_email')) }}">
                </div>
                <div class="auth-modal__form-group">
                    <label for="passwordField" class="auth-modal__visually-hidden">Kata Sandi</label>
                    <input type="password" id="passwordField" class="auth-modal__input" name="password" placeholder="Kata Sandi" required>
                    <span class="auth-modal__password-icon-toggle" onclick="togglePasswordVisibility('passwordField', this.querySelector('i'))" aria-label="Tampilkan/Sembunyikan Kata Sandi">
                        <i class="fa fa-eye" aria-hidden="true"></i>
                    </span>
                </div>
                <div class="auth-modal__options-link-container">
                    @if (Route::has('forgot.password'))
                        <a href="{{ route('forgot.password') }}" class="auth-modal__options-link">Lupa Kata Sandi?</a>
                    @endif {{-- Akhir dari @if (Route::has('forgot.password')) --}}
                </div>
                <button class="auth-modal__submit-button" type="submit">Masuk</button>
            </form>
            <div class="auth-modal__footer-text">
                Belum punya akun?
                <a href="javascript:void(0);" class="auth-modal__footer-link" onclick="callToggleRegisterFromRegisterModal()">Daftar Akun</a>
            </div>
        </div>
    </div>

    <script>
        // Pastikan fungsi-fungsi ini global atau di-scope dengan benar jika dipanggil dari HTML onclick
        // atau dari script lain.
        // Untuk keamanan, kita buat mereka sebagai window.namaFungsi

        window.togglePasswordVisibility = function(fieldId, iconElement) {
            const passwordField = document.getElementById(fieldId);
            const actualIcon = iconElement.tagName === 'I' ? iconElement : iconElement.querySelector('i'); // Lebih aman
            if (passwordField && actualIcon) {
                if (passwordField.type === 'password') {
                    passwordField.type = 'text';
                    actualIcon.classList.remove('fa-eye');
                    actualIcon.classList.add('fa-eye-slash');
                } else {
                    passwordField.type = 'password';
                    actualIcon.classList.remove('fa-eye-slash');
                    actualIcon.classList.add('fa-eye');
                }
            } else {
                if (!passwordField) console.error(`PasswordField '${fieldId}' tidak ditemukan.`);
                if (!actualIcon) console.error("EyeIcon tidak ditemukan.");
            }
        };

        window.toggleLoginModal = function(forceShow = false, successMessage = null) {
            const modal = document.getElementById('modalLogin');
            const loginRedirectUrlInput = document.getElementById('loginRedirectUrl');
            const successNotificationElement = document.getElementById('loginModalGeneralSuccessNotification');
            const errorNotificationElements = modal ? Array.from(modal.querySelectorAll('.auth-modal__alert--error')) : [];

            if (modal) {
                const isCurrentlyDisplayed = modal.style.display === 'flex';

                if (forceShow) {
                    modal.style.display = 'flex';
                    errorNotificationElements.forEach(el => el.style.display = 'none');

                    if (successMessage && successNotificationElement) {
                        successNotificationElement.innerHTML = `<ul><li>${successMessage}</li></ul>`;
                        successNotificationElement.style.display = 'block';
                    } else if (successNotificationElement) {
                        successNotificationElement.style.display = 'none';
                        successNotificationElement.innerHTML = '';
                    }
                } else {
                    modal.style.display = isCurrentlyDisplayed ? 'none' : 'flex';
                    if (successNotificationElement && !isCurrentlyDisplayed) {
                        successNotificationElement.style.display = 'none';
                        successNotificationElement.innerHTML = '';
                    }
                }

                if (modal.style.display === 'flex') {
                    const redirectUrlFromStorage = sessionStorage.getItem('redirect_after_login');
                    if (redirectUrlFromStorage && loginRedirectUrlInput) { loginRedirectUrlInput.value = redirectUrlFromStorage; }
                    else if (loginRedirectUrlInput) { loginRedirectUrlInput.value = ''; }
                } else {
                    if (loginRedirectUrlInput) { loginRedirectUrlInput.value = ''; }
                    if (successNotificationElement) {
                        successNotificationElement.style.display = 'none';
                        successNotificationElement.innerHTML = '';
                    }
                    errorNotificationElements.forEach(el => el.style.display = 'none');
                }
            }
        };

        window.callToggleRegisterFromRegisterModal = function() {
            const modalLogin = document.getElementById('modalLogin');
            if (modalLogin && modalLogin.style.display === 'flex') {
                window.toggleLoginModal();
            }
            if (typeof window.toggleRegisterModal === 'function') {
                window.toggleRegisterModal(true);
            } else {
                console.error("Fungsi global 'toggleRegisterModal' tidak ditemukan.");
            }
        };

        document.addEventListener('DOMContentLoaded', function() {
            const modal = document.getElementById('modalLogin');
            const loginModalCard = modal ? modal.querySelector('.auth-modal__card') : null;

            let shouldOpenModal = false;
            let successMessageToShow = null;

            @if (session('show_login_modal') && session('login_success_message'))
                shouldOpenModal = true;
                successMessageToShow = @json(session('login_success_message'));
                console.log("Modal login akan dibuka karena sukses registrasi.");
            @elseif (session('success') && session('status_from_password_reset')) // Ganti dengan flag Anda jika ada
                shouldOpenModal = true;
                successMessageToShow = @json(session('success'));
                console.log("Modal login akan dibuka karena sukses reset password.");
            @elseif ($errors->hasBag('login'))
                shouldOpenModal = true;
                console.log("Modal login akan dibuka karena error validasi form login.");
            @elseif (session('error'))
                shouldOpenModal = true;
                console.log("Modal login akan dibuka karena session('error').");
            @endif

            if (shouldOpenModal) {
                window.toggleLoginModal(true, successMessageToShow);
                if (loginModalCard && successMessageToShow) { // Scroll ke atas jika ada pesan sukses
                     loginModalCard.scrollTop = 0;
                } else if (loginModalCard && !successMessageToShow) { // Scroll ke atas jika ada error
                     const errorIsVisible = Array.from(loginModalCard.querySelectorAll('.auth-modal__alert--error')).some(el => el.style.display !== 'none' && el.offsetHeight > 0);
                     if(errorIsVisible) loginModalCard.scrollTop = 0;
                }
            }
        });
    </script>
</body>
</html>