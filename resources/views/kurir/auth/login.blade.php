<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Kurir - Dear Seana</title>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&family=Titan+One&family=Dancing+Script:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        :root {
            --primary: #f06292;
            --primary-dark: #ec407a;
            --secondary: #6d4c41;
            --background: #fffcfd;
            --card-bg: #ffffff;
            --text-main: #4e342e;
            --text-muted: #8d6e63;
        }

        body {
            font-family: 'Outfit', sans-serif;
            background: linear-gradient(135deg, #fce4ec, #fff8f8, #f8bbd0);
            color: var(--text-main);
            margin: 0;
            padding: 0;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .login-box {
            background: var(--card-bg);
            padding: 40px;
            border-radius: 28px;
            box-shadow: 0 15px 35px rgba(240, 98, 146, 0.15);
            width: 100%;
            max-width: 420px;
            box-sizing: border-box;
            border: 1px solid rgba(240, 98, 146, 0.1);
            text-align: center;
        }

        .logo-section {
            margin-bottom: 30px;
        }

        .logo-icon {
            font-size: 45px;
            color: var(--primary);
            margin-bottom: 10px;
            display: inline-block;
            animation: floatIcon 3s ease-in-out infinite alternate;
        }

        @keyframes floatIcon {
            0% { transform: translateY(0); }
            100% { transform: translateY(-6px); }
        }

        .logo-text {
            font-size: 26px;
            font-weight: 800;
            color: var(--secondary);
            margin: 0;
        }

        .logo-sub {
            font-family: 'Dancing Script', cursive;
            color: var(--primary);
            font-size: 22px;
            margin-top: -5px;
        }

        .welcome-text {
            font-size: 14.5px;
            color: var(--text-muted);
            margin-bottom: 25px;
            font-weight: 600;
        }

        .form-group {
            margin-bottom: 20px;
            text-align: left;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: var(--secondary);
            font-weight: 700;
            font-size: 14px;
        }

        .input-wrapper {
            position: relative;
        }

        .input-wrapper i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-muted);
            font-size: 16px;
        }

        .form-group input {
            width: 100%;
            padding: 14px 15px 14px 45px;
            border: 1.5px solid #f8bbd0;
            border-radius: 16px;
            box-sizing: border-box;
            font-family: 'Outfit', sans-serif;
            font-size: 15px;
            font-weight: 600;
            color: var(--text-main);
            outline: none;
            transition: all 0.3s;
            background: #fffcfd;
        }

        .form-group input:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 4px rgba(240, 98, 146, 0.15);
            background: white;
        }

        .btn-submit {
            width: 100%;
            padding: 14px;
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: white;
            border: none;
            border-radius: 50px;
            cursor: pointer;
            font-size: 16px;
            font-weight: 800;
            box-shadow: 0 4px 15px rgba(240, 98, 146, 0.25);
            transition: all 0.3s;
            margin-top: 10px;
        }

        .btn-submit:hover {
            box-shadow: 0 6px 20px rgba(240, 98, 146, 0.35);
            filter: brightness(1.05);
        }

        .error-message {
            background: #ffebee;
            color: #c62828;
            padding: 12px 15px;
            border-radius: 16px;
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 20px;
            border: 1px solid #ffcdd2;
            display: flex;
            align-items: center;
            gap: 8px;
            text-align: left;
        }

        .back-link {
            display: inline-block;
            margin-top: 25px;
            color: var(--text-muted);
            text-decoration: none;
            font-size: 14px;
            font-weight: 700;
            transition: color 0.3s;
        }

        .back-link:hover {
            color: var(--primary);
        }
    </style>
</head>
<body>

    <div class="login-box">
        <div class="logo-section">
            <div class="logo-icon"><i class="fas fa-motorcycle"></i></div>
            <h1 class="logo-text">Dear Seana</h1>
            <div class="logo-sub">Portal Kurir</div>
        </div>

        <p class="welcome-text">Silakan masuk menggunakan akun Kurir Anda untuk mengelola pengiriman kue manis.</p>

        @if($errors->any())
            <div class="error-message">
                <i class="fas fa-exclamation-circle"></i>
                <span>{{ $errors->first() }}</span>
            </div>
        @endif

        <form action="{{ route('kurir.login.submit') }}" method="POST">
            @csrf
            
            <div class="form-group">
                <label for="email">Alamat Email</label>
                <div class="input-wrapper">
                    <i class="fas fa-envelope"></i>
                    <input type="email" name="email" id="email" value="{{ old('email') }}" placeholder="contoh@tokokue.com" required autofocus>
                </div>
            </div>

            <div class="form-group">
                <label for="password">Kata Sandi</label>
                <div class="input-wrapper">
                    <i class="fas fa-lock"></i>
                    <input type="password" name="password" id="password" placeholder="••••••••" required>
                </div>
            </div>

            <button type="submit" class="btn-submit">Masuk Panel Kurir</button>
        </form>

        <a href="{{ url('/') }}" class="back-link">
            <i class="fas fa-arrow-left"></i> Kembali ke Website Utama
        </a>
    </div>

</body>
</html>
