<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Lupa Kata Sandi | Bintang Serasi</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{-- Menambahkan Font Awesome untuk ikon (opsional, jika ingin ikon di input) --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        /* -- CSS LAMA ANDA SEBAGAI DASAR -- */
        /* body {
            margin: 0;
            font-family: 'Segoe UI', sans-serif;
            background: linear-gradient(120deg, #6ec6ff, #1e88e5);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .card {
            background: #fff;
            border-radius: 15px;
            padding: 30px;
            width: 100%;
            max-width: 350px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        ... (CSS lama lainnya) ...
        */

        /* 👇 ***** CSS BARU / YANG DIPERBARUI ***** 👇 */
        :root {
            --primary-color: #2196f3; /* Biru utama Anda */
            --primary-color-dark: #1976d2;
            --text-color: #333;
            --text-muted-color: #555;
            --border-color: #ced4da; /* Warna border yang lebih netral */
            --input-bg: #f8f9fa; /* Background input yang sedikit lebih cerah */
            --input-focus-bg: #fff;
            --danger-color: #d32f2f;
            --danger-bg: #ffebee;
            --danger-border: #ef9a9a;
            --success-color: #388e3c;
            --success-bg: #e8f5e9;
            --success-border: #a5d6a7;
            --font-family-sans-serif: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
        }

        *,
        *::before,
        *::after {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: var(--font-family-sans-serif);
            background: linear-gradient(135deg, #6dd5ed, #2193b0); /* Gradient baru yang lebih halus */
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1rem; /* Padding agar card tidak mentok di layar kecil */
            color: var(--text-color);
        }

        .card {
            background: #fff;
            border-radius: 12px; /* Border radius lebih halus */
            padding: 35px 30px; /* Sedikit lebih banyak padding vertikal */
            width: 100%;
            max-width: 380px; /* Sedikit lebih lebar */
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1), 0 5px 10px rgba(0, 0, 0, 0.04); /* Shadow lebih dalam */
            animation: fadeInCard 0.5s ease-out;
        }

        @keyframes fadeInCard {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .card-title { /* Mengganti h2 dengan class agar lebih spesifik */
            text-align: center;
            margin-top: 0;
            margin-bottom: 30px; /* Lebih banyak spasi */
            font-size: 1.75rem; /* Sedikit lebih besar */
            font-weight: 600; /* Lebih tebal */
            color: var(--text-color);
        }

        .input-group {
            margin-bottom: 20px; /* Lebih banyak spasi antar input */
            position: relative; /* Untuk ikon di dalam input jika ditambahkan */
        }

        .input-group label {
            display: block;
            margin-bottom: 8px; /* Spasi lebih antara label dan input */
            font-size: 0.9rem; /* Sedikit lebih kecil tapi jelas */
            font-weight: 500; /* Sedikit lebih tebal */
            color: var(--text-muted-color);
        }

        .input-group input {
            width: 100%;
            padding: 12px 15px; /* Padding lebih nyaman */
            /* padding-left: 40px; /* Aktifkan jika menggunakan ikon di kiri */
            font-size: 0.95rem;
            border: 1px solid var(--border-color);
            border-radius: 8px; /* Border radius yang lebih modern */
            background-color: var(--input-bg);
            color: var(--text-color);
            transition: border-color 0.2s ease, box-shadow 0.2s ease, background-color 0.2s ease;
        }

        .input-group input::placeholder {
            color: #999; /* Placeholder lebih lembut */
            opacity: 1;
        }

        .input-group input:focus {
            outline: none;
            border-color: var(--primary-color);
            background-color: var(--input-focus-bg);
            box-shadow: 0 0 0 0.2rem rgba(33, 150, 243, 0.25); /* Shadow saat fokus */
        }

        /* Opsional: Ikon di dalam input (jika Anda mau menambahkan <span> ikon di HTML)
        .input-icon {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(calc(-50% + 4px)); Jika ada label, sedikit penyesuaian
            color: var(--text-muted-color);
            pointer-events: none;
            font-size: 0.95rem;
        }
        .input-group input:focus + .input-icon {
            color: var(--primary-color);
        }
        */

        .btn-submit { /* Mengganti .btn dengan class lebih spesifik */
            width: 100%;
            padding: 12px 15px;
            background-color: var(--primary-color);
            border: none;
            border-radius: 8px;
            color: white;
            font-weight: 600; /* Lebih tebal */
            font-size: 1rem;
            cursor: pointer;
            transition: background-color 0.2s ease, transform 0.1s ease, box-shadow 0.2s ease;
            box-shadow: 0 4px 15px rgba(33, 150, 243, 0.2); /* Shadow halus untuk tombol */
        }

        .btn-submit:hover {
            background-color: var(--primary-color-dark);
            box-shadow: 0 6px 20px rgba(33, 150, 243, 0.3);
        }
        .btn-submit:active {
            transform: translateY(1px);
            box-shadow: 0 2px 10px rgba(33, 150, 243, 0.2);
        }


        .back-link-container { /* Mengganti .back-btn */
            text-align: center;
            margin-top: 25px;
            font-size: 0.9rem;
        }

        .back-link-container a {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 500;
        }

        .back-link-container a:hover {
            text-decoration: underline;
            color: var(--primary-color-dark);
        }

        .alert {
            margin-bottom: 20px;
            padding: 12px 15px;
            border-radius: 8px;
            font-size: 0.9rem;
            display: flex; /* Untuk ikon dan teks sejajar */
            align-items: center;
        }
        .alert i { /* Untuk ikon di alert */
            margin-right: 10px;
            font-size: 1.2em;
        }

        .alert-danger {
            background-color: var(--danger-bg);
            color: var(--danger-color);
            border: 1px solid var(--danger-border);
        }

        .alert-success {
            background-color: var(--success-bg);
            color: var(--success-color);
            border: 1px solid var(--success-border);
        }

        .text-danger-small {
            color: var(--danger-color);
            font-size: 0.8rem; /* Lebih kecil lagi */
            display: block;
            margin-top: 6px; /* Spasi lebih */
            padding-left: 2px; /* Sedikit indent */
        }
        /* 👆 ***** AKHIR CSS BARU / YANG DIPERBARUI ***** 👆 */
    </style>
</head>
<body>
    <div class="card">
        <h2 class="card-title">Lupa Kata Sandi</h2> {{-- Menggunakan class baru --}}

        {{-- Menampilkan error umum dari session --}}
        @if(session('error'))
            <div class="alert alert-danger">
                <i class="fas fa-times-circle"></i> {{-- Ikon untuk error --}}
                {{ session('error') }}
            </div>
        @endif

        {{-- Menampilkan notifikasi sukses jika ada --}}
        @if(session('success'))
            <div class="alert alert-success">
                <i class="fas fa-check-circle"></i> {{-- Ikon untuk sukses --}}
                {{ session('success') }}
            </div>
        @endif

        {{-- Menampilkan error spesifik jika kombinasi nama/email tidak cocok --}}
        @if ($errors->has('credentials'))
            <div class="alert alert-danger">
                <i class="fas fa-exclamation-triangle"></i> {{-- Ikon untuk warning/error --}}
                {{ $errors->first('credentials') }}
            </div>
        @endif

        <form method="POST" action="{{ route('forgot.password.verify') }}">
            @csrf
            <div class="input-group">
                <label for="name">Nama Pengguna</label>
                {{-- Jika ingin ikon: <i class="fas fa-user input-icon"></i> --}}
                <input type="text" id="name" name="name" placeholder="Masukkan nama pengguna Anda" value="{{ old('name') }}" required> {{-- Hapus style inline --}}
                @error('name')
                    <span class="text-danger-small">{{ $message }}</span>
                @enderror
            </div>

            <div class="input-group">
                <label for="email">Email</label>
                {{-- Jika ingin ikon: <i class="fas fa-envelope input-icon"></i> --}}
                <input type="email" id="email" name="email" placeholder="Masukkan alamat email Anda" value="{{ old('email') }}" required> {{-- Hapus style inline --}}
                @error('email')
                    <span class="text-danger-small">{{ $message }}</span>
                @enderror
            </div>
            <button class="btn-submit" type="submit">Konfirmasi</button> {{-- Menggunakan class baru --}}
        </form>

        <div class="back-link-container"> {{-- Menggunakan class baru --}}
            <a href="{{ route('home') }}">Kembali ke Halaman Utama</a> {{-- Teks link bisa disesuaikan --}}
        </div>
    </div>
</body>
</html>