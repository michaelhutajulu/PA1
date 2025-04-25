<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Lupa Kata Sandi | Bintang Serasi</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', sans-serif;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background: linear-gradient(120deg, #f7a07a, #ff914d);
            overflow: hidden;
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
            height: 100%;
        }

        .card {
            background: #fff;
            border-radius: 15px;
            padding: 40px;
            width: 100%;
            max-width: 450px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card:hover {
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.2);
            transform: translateY(-5px);
        }

        .card h2 {
            text-align: center;
            margin-bottom: 30px;
            font-size: 28px;
            color: #333;
            font-weight: bold;
            animation: fadeIn 1s ease-in-out;
        }

        .input-group {
            margin-bottom: 20px;
        }

        .input-group input {
            width: 100%;
            padding: 14px;
            border: 2px solid #ddd;
            border-radius: 12px;
            background: #f7f7f7;
            color: #333;
            font-size: 16px;
            outline: none;
            transition: all 0.3s ease;
        }

        .input-group input::placeholder {
            color: #bbb;
        }

        .input-group input:focus {
            background: #fff;
            border-color: #ff914d;
        }

        .btn {
            width: 100%;
            padding: 16px;
            background: #ff914d;
            border: none;
            border-radius: 12px;
            color: #fff;
            font-size: 18px;
            font-weight: bold;
            cursor: pointer;
            transition: background 0.3s ease, transform 0.3s ease;
        }

        .btn:hover {
            background: #ff7f29;
            transform: scale(1.05);
        }

        .back-btn {
            text-align: center;
            margin-top: 15px;
        }

        .back-btn a {
            font-size: 16px;
            color: #ff914d;
            text-decoration: none;
            font-weight: 600;
            transition: color 0.3s ease;
        }

        .back-btn a:hover {
            color: #ff7f29;
        }

        .welcome-text {
            color: #fff;
            font-size: 40px;
            font-weight: bold;
            text-align: left;
            margin-top: 20px;
            text-transform: uppercase;
            letter-spacing: 1px;
            animation: slideIn 1s ease-out;
        }

        @keyframes slideIn {
            0% {
                opacity: 0;
                transform: translateX(-50px);
            }
            100% {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes fadeIn {
            0% {
                opacity: 0;
            }
            100% {
                opacity: 1;
            }
        }
    </style>
</head>
<body>

    <div class="container">
        <!-- Kolom Kiri: Teks Selamat Datang -->
        <div class="welcome-text">
            Selamat Datang di Toko Bintang Serasi
        </div>

        <!-- Kolom Kanan: Form Input -->
        <div class="card">
            <h2>Lupa Kata Sandi</h2>

            @if(session('error'))
                <div class="alert">{{ session('error') }}</div>
            @endif
            @if(session('success'))
                <div class="alert success">{{ session('success') }}</div>
            @endif

            <form method="POST" action="{{ route('forgot.password.verify') }}">
                @csrf
                <div class="input-group">
                    <input type="text" name="name" placeholder="Nama Pengguna" required>
                </div>
                <div class="input-group">
                    <input type="email" name="email" placeholder="Email" required>
                </div>
                <button class="btn" type="submit">Kirim Link Reset</button>
            </form>

            <div class="back-btn">
                <a href="{{ route('login') }}">Kembali ke Login</a>
            </div>
        </div>
    </div>

</body>
</html>
