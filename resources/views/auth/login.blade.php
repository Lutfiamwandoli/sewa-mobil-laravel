<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            background-color: #1e3a5f;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            font-family: Arial, sans-serif;
        }
        .container {
            background-color: #2c4971;
            padding: 30px;
            border-radius: 10px;
            width: 100%;
            max-width: 400px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.3);
        }
        h2 {
            text-align: center;
            color: white;
            margin-bottom: 20px;
        }
        label {
            color: white;
            font-size: 14px;
            display: block;
            margin-bottom: 5px;
        }
        .input-group {
            position: relative;
        }
        input {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: none;
            border-radius: 5px;
            box-sizing: border-box;
        }
        .toggle-password {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            width: 20px;
        }
        button {
            width: 100%;
            padding: 10px;
            background-color: #5b21b6;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
        }
        button:hover {
            background-color: #4c1d95;
        }
        .error {
            background-color: #fee2e2;
            color: #b91c1c;
            padding: 8px;
            border-radius: 5px;
            margin-bottom: 15px;
            font-size: 14px;
        }
        p {
            text-align: center;
            color: white;
            font-size: 14px;
        }
        a {
            color: #22c55e;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Login</h2>

        @if(session('error'))
            <div class="error">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('login') }}" method="POST">
            @csrf
            <label>Username</label>
            <input type="text" name="username" placeholder="Masukkan username" required>

            <label>Password</label>
            <div class="input-group">
                <input type="password" name="password" id="password" placeholder="Masukkan password" required>
                <img src="{{ asset('gambar/show.png') }}" 
                     alt="Toggle Password" 
                     class="toggle-password" 
                     id="togglePassword">
            </div>

            <button type="submit">Login</button>
        </form>

        <p>
            Belum punya akun? 
            <a href="{{ route('register') }}">Registrasi</a>
        </p>
    </div>

    <script>
        const togglePassword = document.getElementById('togglePassword');
        const passwordInput = document.getElementById('password');
        let isShown = false;

        togglePassword.addEventListener('click', function () {
            isShown = !isShown;
            if (isShown) {
                passwordInput.type = 'text';
                togglePassword.src = "{{ asset('gambar/hidden.png') }}"; // icon mata tertutup
            } else {
                passwordInput.type = 'password';
                togglePassword.src = "{{ asset('gambar/eye.png') }}"; // icon mata terbuka
            }
        });
    </script>
</body>
</html>
