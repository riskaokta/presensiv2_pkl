<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            height: 100vh;
            background: linear-gradient(135deg, #74ebd5, #acb6e5);
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .login-container {
            background: #ffffff;
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
            width: 100%;
            max-width: 400px;
            animation: fadeIn 0.8s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        h2 {
            text-align: center;
            margin-bottom: 30px;
            color: #333;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            font-size: 0.95rem;
            color: #444;
            margin-bottom: 6px;
            display: block;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 12px;
            font-size: 1rem;
            border: 1px solid #ccc;
            border-radius: 8px;
            transition: 0.3s;
        }

        input:focus {
            border-color: #007bff;
            outline: none;
        }

        .password-wrapper {
            position: relative;
        }

        .show-password {
            position: absolute;
            top: 50%;
            right: 15px;
            transform: translateY(-50%);
            cursor: pointer;
            font-size: 1.2rem;
            color: #888;
        }

        .forgot-password {
            font-size: 0.85rem;
            color: #007bff;
            text-decoration: none;
            margin-top: 6px;
            display: inline-block;
        }

        .forgot-password:hover {
            text-decoration: underline;
        }

        .checkbox-group {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
            font-size: 0.9rem;
        }

        .checkbox-group input {
            margin-right: 10px;
        }

        .btn-primary {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 12px;
            font-size: 1rem;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        @media (max-width: 480px) {
            .login-container {
                padding: 30px 20px;
                border-radius: 12px;
            }
        }
    </style>
</head>

<body>
    <div class="login-container">
        <h2>Login Admin SIPRESENS</h2>
        <form action="/prosesloginadmin" method="POST">
            @csrf
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="email" placeholder="your@email.com" autocomplete="off">
            </div>
            <div class="form-group">
                <label>Password</label>
                <div class="password-wrapper">
                    <input type="password" id="password" name="password" placeholder="Your password" required>
                    <span class="show-password" onclick="togglePassword()">👁️</span>
                </div>
                <!-- <a href="#" class="forgot-password">I forgot password</a> -->
            </div>
            <!-- <div class="form-group checkbox-group">
                <input type="checkbox" id="remember" name="remember">
                <label for="remember">Remember me on this device</label>
            </div> -->
            <button type="submit" class="btn-primary">Sign in</button>
        </form>
    </div>

    <script>
        function togglePassword() {
            const passwordInput = document.getElementById("password");
            const icon = document.querySelector(".show-password");
            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                icon.textContent = "🙈";
            } else {
                passwordInput.type = "password";
                icon.textContent = "👁️";
            }
        }
    </script>
</body>

</html>