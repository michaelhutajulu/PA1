<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Lupa Kata Sandi | Bintang Serasi</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
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
        .card h2 {
            text-align: center;
            margin-bottom: 25px;
            font-size: 24px;
            color: #333;
        }
        .input-group {
            margin-bottom: 18px;
        }
        .input-group label {
            display: block;
            margin-bottom: 5px;
            font-size: 14px;
            color: #555;
        }
        .input-group input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
            box-sizing: border-box;
            background-color: #f0f0f0; 
            color: #333;
        }
        .input-group input::placeholder {
            color: rgba(0, 0, 0, 0.3); 
        }
        .input-group input:focus {
            outline: none;
            border-color: #2196f3;
            background-color: #e9e9e9;
        }
        .btn {
            width: 100%;
            padding: 10px;
            background-color: #2196f3;
            border: none;
            border-radius: 5px;
            color: white;
            font-weight: bold;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }
        .btn:hover {
            background-color: #1976d2;
        }
        .back-btn {
            text-align: center;
            margin-top: 20px;
            font-size: 14px;
            color: #555;
        }
        .back-btn a {
            color: #2196f3;
            text-decoration: none;
        }
        .back-btn a:hover {
            text-decoration: underline;
        }
        .alert {
            margin-bottom: 15px;
            padding: 10px;
            border-radius: 5px;
            font-size: 14px;
        }
        .alert-danger {
            background-color: #ffebee;
            color: #d32f2f;
            border: 1px solid #ef9a9a;
        }
        .alert-success {
            background-color: #e8f5e9;
            color: #388e3c;
            border: 1px solid #a5d6a7;
        }
    </style>
</head>
<body>
    <div class="card">
        <h2>Lupa Kata Sandi</h2>

        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form method="POST" action="{{ route('forgot.password.verify') }}">
            @csrf
            <div class="input-group">
                <label for="name">Nama Pengguna</label>
                <input type="text" id="name" name="name" placeholder="Nama Pengguna" required style="background-color: #f0f0f0; color: #333;">
            </div>
            <div class="input-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="Email" required style="background-color: #f0f0f0; color: #333;">
            </div>
            <button class="btn" type="submit">Konfirmasi</button>
        </form>

        <div class="back-btn">
            <a href="{{ route('login') }}">Kembali ke Login</a>
        </div>
    </div>
</body>
</html>