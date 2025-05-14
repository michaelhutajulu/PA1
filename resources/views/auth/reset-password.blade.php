<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Perbarui Kata Sandi | Toko Bintang Serasi</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #2196f3;
            --primary-color-dark: #1976d2;
            --text-color: #333;
            --text-muted-color: #6c757d; /* Warna abu-abu yang lebih umum untuk muted text / ikon */
            --border-color: #ced4da;
            --input-bg: #f8f9fa;
            --input-focus-bg: #fff;
            --danger-color: #d32f2f;
            --danger-bg: #ffebee;
            --danger-border: #ef9a9a;
            --font-family-sans-serif: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";

            /* Variabel untuk perhitungan posisi ikon mata */
            --label-font-size: 0.9rem;
            --label-line-height: 1.4; /* Asumsi line-height untuk label */
            --label-margin-bottom: 8px;

            --input-padding-vertical: 12px;
            --input-font-size: 0.95rem;
            --input-line-height: 1.6; /* Asumsi line-height untuk teks di dalam input */

            --toggle-icon-font-size: 1rem;
        }

        *, *::before, *::after { box-sizing: border-box; }

        body {
            margin: 0;
            font-family: var(--font-family-sans-serif);
            background: linear-gradient(135deg, #6dd5ed, #2193b0);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1rem;
            color: var(--text-color);
        }

        .card {
            background: #fff;
            border-radius: 12px;
            padding: 35px 30px;
            width: 100%;
            max-width: 380px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1), 0 5px 10px rgba(0, 0, 0, 0.04);
            animation: fadeInCard 0.5s ease-out;
        }

        @keyframes fadeInCard {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .card-title {
            text-align: center;
            margin-top: 0;
            margin-bottom: 30px;
            font-size: 1.75rem;
            font-weight: 600;
            color: var(--text-color);
        }

        .input-group {
            margin-bottom: 20px;
            position: relative;
        }

        .input-group label {
            display: block;
            margin-bottom: var(--label-margin-bottom);
            font-size: var(--label-font-size);
            font-weight: 500;
            color: var(--text-muted-color);
        }

        .input-group input[type="password"],
        .input-group input[type="text"] {
            width: 100%;
            padding: var(--input-padding-vertical) 15px;
            padding-right: 45px; /* Ruang untuk ikon mata */
            font-size: var(--input-font-size);
            line-height: var(--input-line-height); /* Penting untuk perhitungan tinggi */
            border: 1px solid var(--border-color);
            border-radius: 8px;
            background-color: var(--input-bg);
            color: var(--text-color);
            transition: border-color 0.2s ease, box-shadow 0.2s ease, background-color 0.2s ease;
        }

        .input-group input::placeholder { color: #999; opacity: 1; }

        .input-group input:focus {
            outline: none;
            border-color: var(--primary-color);
            background-color: var(--input-focus-bg);
            box-shadow: 0 0 0 0.2rem rgba(33, 150, 243, 0.25);
        }

        .toggle-password {
            position: absolute;
            right: 15px;
            /*
              Perhitungan top:
              1. Tinggi perkiraan label: var(--label-font-size) * var(--label-line-height)
              2. Margin bawah label: var(--label-margin-bottom)
              3. Setengah dari tinggi efektif input: ( (var(--input-padding-vertical) * 2) + (var(--input-font-size) * var(--input-line-height)) ) / 2
                 Ini adalah titik tengah vertikal dari input field itu sendiri.
            */
            top: calc(
                (var(--label-font-size) * var(--label-line-height)) + /* Perkiraan tinggi label */
                var(--label-margin-bottom) +                         /* Margin bawah label */
                var(--input-padding-vertical) +                     /* Padding atas input */
                ( (var(--input-font-size) * var(--input-line-height)) / 2 ) /* Setengah dari tinggi teks di dalam input */
            );
            transform: translateY(-50%); /* Pusatkan ikon secara vertikal terhadap titik 'top' di atas */
            font-size: var(--toggle-icon-font-size);
            color: var(--text-muted-color);
            cursor: pointer;
            user-select: none;
            transition: color 0.2s ease;
            line-height: 1; /* Pastikan ikon tidak menambah tinggi yang tidak perlu */
            display: flex; /* Untuk memastikan ikon terpusat jika ada padding di span */
            align-items: center;
        }

        .input-group input:focus ~ .toggle-password {
            color: var(--primary-color);
        }

        .btn-submit {
            width: 100%;
            padding: 12px 15px;
            background-color: var(--primary-color);
            border: none;
            border-radius: 8px;
            color: white;
            font-weight: 600;
            font-size: 1rem;
            cursor: pointer;
            transition: background-color 0.2s ease, transform 0.1s ease, box-shadow 0.2s ease;
            box-shadow: 0 4px 15px rgba(33, 150, 243, 0.2);
        }
        .btn-submit:hover { background-color: var(--primary-color-dark); box-shadow: 0 6px 20px rgba(33, 150, 243, 0.3); }
        .btn-submit:active { transform: translateY(1px); box-shadow: 0 2px 10px rgba(33, 150, 243, 0.2); }

        .back-link-container { text-align: center; margin-top: 25px; font-size: 0.9rem; }
        .back-link-container a { color: var(--primary-color); text-decoration: none; font-weight: 500; }
        .back-link-container a:hover { text-decoration: underline; color: var(--primary-color-dark); }

        .alert {
            margin-bottom: 20px; padding: 12px 15px; border-radius: 8px;
            font-size: 0.9rem; display: flex; align-items: center;
        }
        .alert i { margin-right: 10px; font-size: 1.2em; }
        .alert ul { margin: 0; padding-left: 1.2rem; list-style-type: disc; }
        .alert ul li { margin-bottom: 0.25rem; }
        .alert ul li:last-child { margin-bottom: 0; }
        .alert-danger { background-color: var(--danger-bg); color: var(--danger-color); border: 1px solid var(--danger-border); }
    </style>
</head>
<body>
    <div class="card">
        <h3 class="card-title">Perbarui Kata Sandi</h3>

        @if(session('error'))
            <div class="alert alert-danger">
                <i class="fas fa-times-circle"></i> {{ session('error') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <i class="fas fa-exclamation-triangle"></i>
                <div>
                    <strong>Oops! Terjadi kesalahan:</strong>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif

        <form action="{{ route('password.reset.update', ['email' => $email]) }}" method="POST">
            @csrf
            <div class="input-group">
                <label for="password">Kata Sandi Baru</label>
                <input type="password" id="password" name="password" placeholder="Masukkan kata sandi baru" required>
                <span class="toggle-password" onclick="togglePassword('password')" aria-label="Tampilkan/Sembunyikan kata sandi">
                    <i class="fas fa-eye"></i>
                </span>
            </div>

            <div class="input-group">
                <label for="password_confirmation">Konfirmasi Kata Sandi Baru</label>
                <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Konfirmasi kata sandi baru" required>
                <span class="toggle-password" onclick="togglePassword('password_confirmation')" aria-label="Tampilkan/Sembunyikan konfirmasi kata sandi">
                    <i class="fas fa-eye"></i>
                </span>
            </div>

            <button type="submit" class="btn-submit">Perbarui Kata Sandi</button>
        </form>

        <div class="back-link-container">
            <a href="{{ route('home') }}">Kembali ke Beranda</a>
        </div>
    </div>

    <script>
        function togglePassword(inputId) {
            const passwordInput = document.getElementById(inputId);
            let toggleButton = passwordInput.nextElementSibling;
            while(toggleButton && !toggleButton.classList.contains('toggle-password')) {
                toggleButton = toggleButton.nextElementSibling;
            }

            if (toggleButton) {
                const eyeIcon = toggleButton.querySelector('i');
                if (passwordInput.type === "password") {
                    passwordInput.type = "text";
                    eyeIcon.classList.remove('fa-eye');
                    eyeIcon.classList.add('fa-eye-slash');
                } else {
                    passwordInput.type = "password";
                    eyeIcon.classList.remove('fa-eye-slash');
                    eyeIcon.classList.add('fa-eye');
                }
            }
        }
    </script>
</body>
</html>