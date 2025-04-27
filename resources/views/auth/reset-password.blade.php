<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Perbarui Kata Sandi | Toko Bintang Serasi</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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
        .card h3 {
            text-align: center;
            margin-bottom: 25px;
            font-size: 24px;
            color: #333;
        }
        .input-group {
            margin-bottom: 22px;
            position: relative;
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
            padding-right: 30px;
        }
        .input-group input::placeholder {
            color: rgba(0, 0, 0, 0.3);
        }
        .input-group input:focus {
            outline: none;
            border-color: #2196f3;
            background-color: #e9e9e9;
        }
        .toggle-password {
            position: absolute;
            right: 10px;
            top: 30px;
            cursor: pointer;
            user-select: none;
            font-size: 16px;
            color: #777;
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
    </style>
</head>
<body>
    <div class="card">
        <h3>Perbarui Kata Sandi</h3>

        @if ($errors->has('password'))
            <div class="alert alert-danger">
                Kata sandi baru dan konfirmasi kata sandi tidak sesuai.
            </div>
        @endif

        <form action="{{ route('password.reset.update', ['email' => $email]) }}" method="POST">
            @csrf
            <div class="input-group">
                <label for="password">Kata Sandi Baru</label>
                <input type="password" id="password" name="password" placeholder="Kata Sandi Baru" required>
                <span class="toggle-password" onclick="togglePassword('password')">
                    <i class="fa fa-eye"></i>
                </span>
            </div>

            <div class="input-group">
                <label for="password_confirmation">Konfirmasi Kata Sandi Baru</label>
                <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Konfirmasi Kata Sandi Baru" required>
                <span class="toggle-password" onclick="togglePassword('password_confirmation')">
                    <i class="fa fa-eye"></i>
                </span>
            </div>

            <button type="submit" class="btn">Perbarui Kata Sandi</button>
        </form>

        <div class="back-btn">
            <a href="{{ route('login') }}">Kembali ke Login</a>
        </div>
    </div>

    <script>
        function togglePassword(inputId) {
            const passwordInput = document.getElementById(inputId);
            const toggleButton = passwordInput.nextElementSibling;
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
    </script>
</body>
</html>