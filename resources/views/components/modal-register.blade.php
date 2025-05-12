{{-- resources/views/components/modal-register.blade.php --}}
{{-- Tidak perlu tag <html>, <head>, <body> di sini karena ini adalah komponen --}}

{{-- HTML DENGAN KELAS BARU (auth-modal__...) --}}
<div id="registerModal" class="auth-modal__overlay" style="display: none;">
    <div class="auth-modal__card">
        {{-- Tombol close memanggil fungsi toggleRegisterModal() dari script di bawah --}}
        <button class="auth-modal__close-button" onclick="toggleRegisterModal()" aria-label="Tutup">×</button>
        <h2 class="auth-modal__title">Daftar Akun</h2>

        @if ($errors->hasBag('register'))
            <div class="auth-modal__alert auth-modal__alert--error" role="alert">
                <ul>
                    @foreach ($errors->getBag('register')->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('register') }}" method="POST" id="registerForm">
            @csrf
            <div class="auth-modal__form-group">
                <label for="registerName" class="auth-modal__visually-hidden">Nama</label>
                <input type="text" id="registerName" class="auth-modal__input" name="name" placeholder="Nama" required value="{{ old('name') }}">
            </div>
            <div class="auth-modal__form-group">
                <label for="registerEmail" class="auth-modal__visually-hidden">Email</label>
                <input type="email" id="registerEmail" class="auth-modal__input" name="email" placeholder="Email" required value="{{ old('email') }}">
            </div>
            <div class="auth-modal__form-group">
                <label for="registerPassword" class="auth-modal__visually-hidden">Kata Sandi</label>
                <input type="password" id="registerPassword" class="auth-modal__input" name="password" placeholder="Kata Sandi" required>
                <span class="auth-modal__password-icon-toggle" onclick="togglePasswordVisibility('registerPassword', this.querySelector('i'))" aria-label="Tampilkan/Sembunyikan Kata Sandi">
                    <i class="fa fa-eye" aria-hidden="true"></i>
                </span>
            </div>
            <div class="auth-modal__form-group">
                <label for="confirmPassword" class="auth-modal__visually-hidden">Konfirmasi Kata Sandi</label>
                <input type="password" id="confirmPassword" class="auth-modal__input" name="password_confirmation" placeholder="Konfirmasi Kata Sandi" required>
                <span class="auth-modal__password-icon-toggle" onclick="togglePasswordVisibility('confirmPassword', this.querySelector('i'))" aria-label="Tampilkan/Sembunyikan Kata Sandi">
                    <i class="fa fa-eye" aria-hidden="true"></i>
                </span>
            </div>
            <button class="auth-modal__submit-button" type="submit">Daftar</button>
        </form>
        <div class="auth-modal__footer-text">
            Sudah punya akun?
            {{-- Memanggil fungsi switchToLoginModal() dari script di bawah --}}
            <a href="javascript:void(0);" class="auth-modal__footer-link" onclick="switchToLoginModal()">Masuk</a>
        </div>
    </div>
</div>

{{-- Style CSS untuk modal ini (SAMA DENGAN MODAL LOGIN) --}}
<style>
    /* Global Reset Sederhana & Box Sizing (Jika belum ada global di app.blade.php) */
    /* *, *::before, *::after { box-sizing: border-box; } */

    .auth-modal__overlay{position:fixed;inset:0;background-color:rgba(0,0,0,.65);display:none;align-items:center;justify-content:center;z-index:1070;padding:1rem;overflow-y:auto}
    .auth-modal__card{background-color:#fff;border-radius:8px;border:1px solid #dee2e6;padding:2rem 2.5rem;max-width:400px;width:100%;box-shadow:0 12px 35px rgba(0,0,0,.12);color:#212529;position:relative;animation:authModalFadeIn .3s ease-out}
    @keyframes authModalFadeIn{from{opacity:0;transform:translateY(-10px)}to{opacity:1;transform:translateY(0)}}
    .auth-modal__close-button{position:absolute;top:.75rem;right:.75rem;background:transparent;border:none;color:#6c757d;font-size:1.75rem;line-height:1;padding:.25rem;cursor:pointer;transition:color .2s ease}
    .auth-modal__close-button:hover{color:#343a40}
    .auth-modal__title{text-align:center;margin-top:0;margin-bottom:1.8rem;font-size:1.6rem;font-weight:600;color:#343a40}
    .auth-modal__alert{font-size:.875rem;margin-bottom:1rem;padding:.75rem 1rem;border-radius:6px;border-width:1px;border-style:solid}
    .auth-modal__alert--error{background-color:#f8d7da;border-color:#f5c6cb;color:#721c24}
    .auth-modal__alert--success{background-color:#d1e7dd;border-color:#badbcc;color:#0f5132}
    /* Targetkan UL di dalam alert yang baru (jika ada) */
    .auth-modal__alert ul{margin-bottom:0;padding-left:1.1rem;list-style-type:disc}
    .auth-modal__alert ul li{margin-bottom:.2rem}
    .auth-modal__form-group{margin-bottom:1.1rem;position:relative}
    .auth-modal__input{display:block;width:100%;padding:.75rem 1rem;font-size:.95rem;font-weight:400;line-height:1.6;color:#495057;background-color:#fff;background-clip:padding-box;border:1px solid #ced4da;appearance:none;border-radius:8px;transition:border-color .15s ease-in-out,box-shadow .15s ease-in-out}
    .auth-modal__input::placeholder{color:#6c757d;opacity:1}
    .auth-modal__input:focus{color:#495057;background-color:#fff;border-color:#86b7fe;outline:0;box-shadow:0 0 0 .2rem rgba(13,110,253,.25)}
    .auth-modal__input[type=password]{padding-right:2.75rem}
    .auth-modal__password-icon-toggle{position:absolute;right:.75rem;top:50%;transform:translateY(-50%);cursor:pointer;color:#6c757d;z-index:3;padding:.3rem .4rem;line-height:1;display:flex;align-items:center;justify-content:center}
    .auth-modal__password-icon-toggle i{font-size:.9rem}
    .auth-modal__options-link-container{text-align:right;margin-bottom:1.25rem;margin-top:-.5rem} /* Tidak dipakai di register, tapi tidak masalah */
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

{{-- JavaScript untuk Modal Registrasi (Script asli Anda, hanya selector diupdate jika perlu) --}}
<script>
    // Fungsi ini tetap sama, menargetkan elemen berdasarkan ID
    function togglePasswordVisibility(fieldId, iconElement) {
        const passwordField = document.getElementById(fieldId);
        // Pastikan iconElement adalah elemen i yang benar
        const actualIcon = iconElement.tagName === 'I' ? iconElement : iconElement.querySelector('i');
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
        }
    }

    // Fungsi ini tetap sama, mengontrol modal ini sendiri
    function toggleRegisterModal(forceShow = false) {
        const modal = document.getElementById('registerModal');
        if (modal) {
            if (forceShow) {
                modal.style.display = 'flex';
            } else {
                modal.style.display = modal.style.display === 'none' ? 'flex' : 'none';
            }
            @if ($errors->hasBag('register') && session('open_register_modal_on_error'))
                if (modal.style.display === 'flex') {
                    setTimeout(() => {
                        // Menggunakan kelas card baru jika diubah di HTML
                        const card = modal.querySelector('.auth-modal__card');
                        if(card) card.scrollTop = 0;
                    }, 100);
                }
            @endif
        }
    }

    // Fungsi ini memanggil fungsi global dari app.blade.php
    function switchToLoginModal() {
        // 1. Tutup modal register saat ini
        const registerModal = document.getElementById('registerModal');
        if (registerModal && registerModal.style.display === 'flex') {
            // Panggil toggleRegisterModal() tanpa argumen untuk menutupnya
            toggleRegisterModal();
        }

        // 2. Panggil fungsi global untuk membuka modal login
        if (typeof window.toggleLoginModal === 'function') { // toggleLoginModal dari app.blade.php
            window.toggleLoginModal(); // Ini akan toggle, jika login tertutup jadi terbuka
            // Opsi: Bersihkan pesan sukses login jika ada (ini dari kode asli Anda, pastikan selectornya benar)
            // const loginModalCard = document.querySelector('#modalLogin .auth-modal__card'); // Target card login dengan kelas baru
            // if (loginModalCard) {
            //     const successDiv = loginModalCard.querySelector('.auth-modal__alert--success'); // Target alert sukses dengan kelas baru
            //     if (successDiv) successDiv.style.display = 'none';
            // }
        } else {
            console.error('Fungsi global "toggleLoginModal" tidak ditemukan.');
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        @if (session('open_register_modal_on_error') && $errors->hasBag('register'))
            toggleRegisterModal(true);
        @endif
    });
</script>