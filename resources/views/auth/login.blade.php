<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login | Bintang Serasi</title>
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
            position: relative;
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

        /* 🔹 Tombol kembali */
.back-btn {
    position: absolute;
    top: 15px;
    left: 15px;
    background: transparent;
    border: 1px solid rgba(252, 252, 252, 0.53);
    border-radius: 5px;
    padding: 8px 16px;
    color: #fff;
    font-size: 14px;
    cursor: pointer;
    backdrop-filter: blur(4px);
    transition: all 0.3s ease;
}
.back-btn:hover {
    background: rgba(255, 255, 255, 0.1);
    border-color: rgba(255, 255, 255, 0.5);
}

    </style>
</head>
<body>
            <!-- 🔙 Tombol Kembali -->
            <button class="back-btn" onclick="window.history.back()">← Kembali</button>
    <div class="card">


        <h2>Login</h2>

        @if(session('error'))
            <div class="alert">{{ session('error') }}</div>
        @endif
        @if(session('success'))
            <div class="alert" style="background: rgba(0, 255, 0, 0.2); color: #b2ffb2;">{{ session('success') }}</div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="input-group">
                <input type="email" name="email" placeholder="Email / Username" required>
            </div>
            <div class="input-group">
                <input type="password" name="password" placeholder="Password" required>
            </div>
            <button class="btn" type="submit">Login</button>
        </form>

        <div class="text-center">
            Belum punya akun? <a href="{{ route('register') }}">Registrasi</a>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const redirectUrl = sessionStorage.getItem('redirect_after_login');
            if (redirectUrl) {
                const form = document.querySelector('form');
                if (form) {
                    const hiddenInput = document.createElement('input');
                    hiddenInput.type = 'hidden';
                    hiddenInput.name = 'redirect_after_login';
                    hiddenInput.value = redirectUrl;
                    form.appendChild(hiddenInput);
                }
            }
        });
    </script>
</body>
</html>
