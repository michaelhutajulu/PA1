<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Register | Bintang Serasi</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', sans-serif;
            background: linear-gradient(120deg, #1e3c72, #2a5298);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
        }
        .card {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(15px);
            border-radius: 15px;
            padding: 40px;
            width: 100%;
            max-width: 400px;
            box-shadow: 0 0 20px rgba(0,0,0,0.3);
        }
        .card h2 {
            text-align: center;
            margin-bottom: 30px;
            font-size: 28px;
        }
        .input-group {
            margin-bottom: 20px;
        }
        .input-group input {
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 8px;
            background: rgba(255,255,255,0.15);
            color: #fff;
            font-size: 14px;
        }
        .input-group input::placeholder {
            color: #ccc;
        }
        .btn {
            width: 100%;
            padding: 12px;
            background: #4facfe;
            border: none;
            border-radius: 8px;
            color: #fff;
            font-weight: bold;
            cursor: pointer;
            transition: 0.3s ease;
        }
        .btn:hover {
            background: #00f2fe;
        }
        .text-center {
            text-align: center;
            margin-top: 15px;
        }
        a {
            color: #add8ff;
            text-decoration: none;
        }
        .alert {
            margin-bottom: 15px;
            background: rgba(255, 0, 0, 0.2);
            padding: 10px;
            border-radius: 8px;
            color: #ffb3b3;
        }
    </style>
</head>
<body>
    <div class="card">
        <h2>Register</h2>

        @if ($errors->any())
            <div class="alert">
                <ul style="margin: 0; padding-left: 20px;">
                    @foreach ($errors->all() as $error)
                        <li style="color: #ffb3b3;">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('register') }}">
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
            <button class="btn" type="submit">Daftar</button>
        </form>

        <div class="text-center">
            Sudah punya akun? <a href="{{ route('login') }}">Login</a>
        </div>
    </div>
</body>
</html>
