<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        /* General Styles */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f4f5f7;
        }

        .login-container {
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            width: 400px;
            text-align: center;
        }

        h2 {
            margin-bottom: 20px;
            font-size: 1.5rem;
            color: #333;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        .form-group {
            margin-bottom: 15px;
            text-align: left;
        }

        label {
            font-size: 0.9rem;
            color: #555;
            margin-bottom: 5px;
            display: block;
        }

        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            font-size: 1rem;
            border: 1px solid #ccc;
            border-radius: 4px;
            margin-top: 5px;
        }

        .password-wrapper {
            position: relative;
        }

        .password-wrapper .show-password {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            text-decoration: none;
            color: #666;
            font-size: 1rem;
            cursor: pointer;
        }

        .forgot-password {
            display: block;
            margin-top: 5px;
            font-size: 0.8rem;
            color: #007BFF;
            text-decoration: none;
        }

        .forgot-password:hover {
            text-decoration: underline;
        }

        .checkbox-group {
            display: flex;
            align-items: center;
            font-size: 0.9rem;
        }

        .checkbox-group input {
            margin-right: 10px;
        }

        .btn-primary {
            background-color: #007BFF;
            color: #fff;
            border: none;
            padding: 10px;
            font-size: 1rem;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .or-divider {
            margin: 20px 0;
            font-size: 0.9rem;
            color: #888;
            position: relative;
        }

        .or-divider::before,
        .or-divider::after {
            content: "";
            position: absolute;
            top: 50%;
            width: 40%;
            height: 1px;
            background-color: #ccc;
        }

        .or-divider::before {
            left: 0;
        }

        .or-divider::after {
            right: 0;
        }

        .social-login {
            display: flex;
            justify-content: space-between;
        }

        .btn-secondary {
            background-color: #f4f5f7;
            color: #333;
            border: 1px solid #ccc;
            padding: 10px;
            font-size: 0.9rem;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
            width: 48%;
        }

        .btn-secondary:hover {
            background-color: #e2e6ea;
        }
    </style>
</head>

<body>
    <div class="login-container">
        <h2>Login to your account</h2>
        <form action="/prosesloginadmin" method="POST">
            @csrf
            <div class="form-group">
                <label class="form-label">Email Address</label>
                <input type="text" name="email" class="form-control" placeholder="your@email.com" autocomplete="off">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <div class="password-wrapper">
                    <input type="password" id="password" name="password" placeholder="Your password" required>
                    <a href="#" class="show-password">👁️</a>
                </div>
                <a href="#" class="forgot-password">I forgot password</a>
            </div>
            <div class="form-group checkbox-group">
                <input type="checkbox" id="remember" name="remember">
                <label for="remember">Remember me on this device</label>
            </div>
            <button type="submit" class="btn-primary">Sign in</button>
        </form>
    </div>
</body>

</html>