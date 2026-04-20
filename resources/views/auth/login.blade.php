<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Masuk — Dear Seana</title>
    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;1,400&family=Jost:wght@300;400;500&display=swap"
        rel="stylesheet" />
    <style>
        *,
        *::before,
        *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        :root {
            --blush: #f9d6e0;
            --rose: #e8849a;
            --deep-rose: #c45b74;
            --petal: #fce8ef;
            --cream: #fff7f9;
            --white: #ffffff;
            --ink: #3a1c25;
            --muted: #9e6a78;
        }

        body {
            min-height: 100vh;
            display: grid;
            grid-template-columns: 1fr 1fr;
            font-family: 'Jost', sans-serif;
            background: var(--cream);
            overflow: hidden;
        }

        /* ── Left decorative panel ── */
        .panel-left {
            position: relative;
            background: linear-gradient(160deg, #f7c5d5 0%, #f0a0b8 50%, #d97093 100%);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 3rem;
            overflow: hidden;
        }

        /* Decorative circles */
        .panel-left::before {
            content: '';
            position: absolute;
            width: 420px;
            height: 420px;
            border-radius: 50%;
            border: 2px solid rgba(255, 255, 255, 0.25);
            top: -80px;
            left: -80px;
        }

        .panel-left::after {
            content: '';
            position: absolute;
            width: 300px;
            height: 300px;
            border-radius: 50%;
            border: 2px solid rgba(255, 255, 255, 0.18);
            bottom: -60px;
            right: -60px;
        }

        .deco-ring {
            position: absolute;
            width: 200px;
            height: 200px;
            border-radius: 50%;
            border: 1.5px solid rgba(255, 255, 255, 0.3);
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            animation: pulse-ring 4s ease-in-out infinite;
        }

        .deco-ring.r2 {
            width: 320px;
            height: 320px;
            animation-delay: 1s;
        }

        .deco-ring.r3 {
            width: 440px;
            height: 440px;
            animation-delay: 2s;
        }

        @keyframes pulse-ring {

            0%,
            100% {
                opacity: 0.3;
                transform: translate(-50%, -50%) scale(1);
            }

            50% {
                opacity: 0.6;
                transform: translate(-50%, -50%) scale(1.03);
            }
        }

        .brand-icon {
            font-size: 4.5rem;
            margin-bottom: 1.2rem;
            filter: drop-shadow(0 4px 12px rgba(180, 60, 90, 0.25));
            animation: float 3.5s ease-in-out infinite;
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-10px);
            }
        }

        .brand-name {
            font-family: 'Playfair Display', serif;
            font-size: 2.2rem;
            font-style: italic;
            color: var(--white);
            text-align: center;
            line-height: 1.2;
            text-shadow: 0 2px 12px rgba(160, 40, 70, 0.3);
            margin-bottom: 0.5rem;
        }

        .brand-tagline {
            font-size: 0.78rem;
            letter-spacing: 0.22em;
            text-transform: uppercase;
            color: rgba(255, 255, 255, 0.8);
        }

        /* Decorative dots */
        .dots {
            position: absolute;
            bottom: 2.5rem;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            gap: 8px;
        }

        .dot {
            width: 7px;
            height: 7px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.5);
        }

        .dot.active {
            background: #fff;
        }

        /* Cake illustration dots scattered */
        .sprinkle {
            position: absolute;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.45);
            animation: twinkle 3s ease-in-out infinite;
        }

        @keyframes twinkle {

            0%,
            100% {
                opacity: 0.4;
            }

            50% {
                opacity: 1;
            }
        }

        /* ── Right form panel ── */
        .panel-right {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 3rem 4rem;
            background: var(--white);
            position: relative;
        }

        .panel-right::before {
            content: '';
            position: absolute;
            left: 0;
            top: 15%;
            bottom: 15%;
            width: 3px;
            background: linear-gradient(to bottom, transparent, var(--rose), transparent);
            border-radius: 4px;
        }

        .form-wrapper {
            width: 100%;
            max-width: 380px;
            animation: slide-up 0.7s cubic-bezier(0.22, 1, 0.36, 1) both;
        }

        @keyframes slide-up {
            from {
                opacity: 0;
                transform: translateY(28px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .form-header {
            margin-bottom: 2.5rem;
        }

        .form-header h1 {
            font-family: 'Playfair Display', serif;
            font-size: 2rem;
            color: var(--ink);
            margin-bottom: 0.4rem;
        }

        .form-header p {
            font-size: 0.88rem;
            color: var(--muted);
            font-weight: 300;
        }

        /* Field group */
        .field {
            margin-bottom: 1.4rem;
            position: relative;
        }

        label {
            display: block;
            font-size: 0.75rem;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            color: var(--muted);
            font-weight: 500;
            margin-bottom: 0.5rem;
        }

        .input-wrap {
            position: relative;
            display: flex;
            align-items: center;
        }

        .input-icon {
            position: absolute;
            left: 14px;
            font-size: 1rem;
            color: var(--rose);
            pointer-events: none;
            transition: color 0.2s;
        }

        input[type="email"],
        input[type="password"],
        input[type="text"] {
            width: 100%;
            padding: 0.85rem 1rem 0.85rem 2.8rem;
            border: 1.5px solid #f0d0d8;
            border-radius: 12px;
            font-family: 'Jost', sans-serif;
            font-size: 0.95rem;
            color: var(--ink);
            background: var(--petal);
            outline: none;
            transition: border-color 0.25s, background 0.25s, box-shadow 0.25s;
        }

        input::placeholder {
            color: #c9a0ac;
        }

        input:focus {
            border-color: var(--rose);
            background: #fff;
            box-shadow: 0 0 0 4px rgba(232, 132, 154, 0.12);
        }

        .show-pwd {
            position: absolute;
            right: 14px;
            cursor: pointer;
            font-size: 0.85rem;
            color: var(--muted);
            user-select: none;
            transition: color 0.2s;
        }

        .show-pwd:hover {
            color: var(--deep-rose);
        }

        .row-opts {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin: 0.2rem 0 1.8rem;
        }

        .remember {
            display: flex;
            align-items: center;
            gap: 7px;
            font-size: 0.83rem;
            color: var(--muted);
            cursor: pointer;
        }

        .remember input[type="checkbox"] {
            display: none;
        }

        .check-box {
            width: 17px;
            height: 17px;
            border: 1.5px solid var(--rose);
            border-radius: 5px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background 0.2s;
            flex-shrink: 0;
        }

        .remember input:checked+.check-box {
            background: var(--rose);
        }

        .remember input:checked+.check-box::after {
            content: '✓';
            color: #fff;
            font-size: 0.7rem;
        }

        .forgot {
            font-size: 0.83rem;
            color: var(--deep-rose);
            text-decoration: none;
            font-weight: 500;
        }

        .forgot:hover {
            text-decoration: underline;
        }

        /* Login button */
        .btn-login {
            width: 100%;
            padding: 0.9rem;
            border: none;
            border-radius: 14px;
            background: linear-gradient(135deg, #e8849a 0%, #c45b74 100%);
            color: #fff;
            font-family: 'Jost', sans-serif;
            font-size: 1rem;
            font-weight: 500;
            letter-spacing: 0.06em;
            cursor: pointer;
            position: relative;
            overflow: hidden;
            transition: transform 0.15s, box-shadow 0.25s;
            box-shadow: 0 6px 20px rgba(196, 91, 116, 0.35);
        }

        .btn-login::after {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.18), transparent);
            border-radius: inherit;
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 28px rgba(196, 91, 116, 0.45);
        }

        .btn-login:active {
            transform: translateY(0);
        }

        /* Divider */
        .divider {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin: 1.6rem 0;
            color: #d4a0ac;
            font-size: 0.78rem;
        }

        .divider::before,
        .divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: #f0d0d8;
        }

        /* Social login */
        .socials {
            display: flex;
            gap: 0.8rem;
        }

        .btn-social {
            flex: 1;
            padding: 0.7rem;
            border: 1.5px solid #f0d0d8;
            border-radius: 12px;
            background: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            font-family: 'Jost', sans-serif;
            font-size: 0.83rem;
            color: var(--ink);
            cursor: pointer;
            transition: border-color 0.2s, box-shadow 0.2s;
        }

        .btn-social:hover {
            border-color: var(--rose);
            box-shadow: 0 3px 12px rgba(232, 132, 154, 0.18);
        }

        .btn-social .s-icon {
            font-size: 1.1rem;
        }

        .signup-cta {
            text-align: center;
            margin-top: 1.8rem;
            font-size: 0.85rem;
            color: var(--muted);
        }

        .signup-cta a {
            color: var(--deep-rose);
            font-weight: 600;
            text-decoration: none;
        }

        .signup-cta a:hover {
            text-decoration: underline;
        }

        /* Responsive */
        @media (max-width: 700px) {
            body {
                grid-template-columns: 1fr;
                overflow: auto;
            }

            .panel-left {
                padding: 2.5rem 2rem;
                min-height: 220px;
            }

            .panel-left::before,
            .panel-left::after {
                display: none;
            }

            .deco-ring {
                display: none;
            }

            .brand-name {
                font-size: 1.7rem;
            }

            .panel-right {
                padding: 2.5rem 1.8rem;
            }

            .panel-right::before {
                display: none;
            }
        }
    </style>
</head>

<body>

    <!-- ── Left Panel ── -->
    <div class="panel-left">
        <div class="deco-ring r1"></div>
        <div class="deco-ring r2"></div>
        <div class="deco-ring r3"></div>

        <!-- Scattered sprinkles -->
        <div class="sprinkle" style="width:8px;height:8px;top:18%;left:20%;animation-delay:0s"></div>
        <div class="sprinkle" style="width:5px;height:5px;top:30%;left:72%;animation-delay:0.8s"></div>
        <div class="sprinkle" style="width:10px;height:10px;top:65%;left:15%;animation-delay:1.5s"></div>
        <div class="sprinkle" style="width:6px;height:6px;top:72%;left:78%;animation-delay:0.4s"></div>
        <div class="sprinkle" style="width:7px;height:7px;top:12%;left:60%;animation-delay:2s"></div>
        <div class="sprinkle" style="width:4px;height:4px;top:80%;left:45%;animation-delay:1s"></div>

        <div class="brand-icon">🎂</div>
        <div class="brand-name">Dear<br>Seana</div>
        <div class="brand-tagline">Kue Manis · Sejak 2020</div>

        <div class="dots">
            <div class="dot active"></div>
            <div class="dot"></div>
            <div class="dot"></div>
        </div>
    </div>

    <!-- ── Right Panel ── -->
    <div class="panel-right">
        <div class="form-wrapper">

            <div class="form-header">
                <h1>Selamat Datang 🌸</h1>
                <p>Masuk ke akun Anda untuk memesan kue impian</p>
            </div>

            <div class="field">
                <label for="email">Email</label>
                <div class="input-wrap">
                    <span class="input-icon">✉️</span>
                    <input type="email" id="email" placeholder="nama@email.com" autocomplete="email" />
                </div>
            </div>

            <div class="field">
                <label for="password">Kata Sandi</label>
                <div class="input-wrap">
                    <span class="input-icon">🔒</span>
                    <input type="password" id="password" placeholder="Masukkan kata sandi" />
                    <span class="show-pwd" onclick="togglePwd()">👁</span>
                </div>
            </div>

            <div class="row-opts">
                <label class="remember">
                    <input type="checkbox" id="remember" />
                    <span class="check-box"></span>
                    Ingat saya
                </label>
                <a href="#" class="forgot">Lupa kata sandi?</a>
            </div>

            <button class="btn-login" onclick="handleLogin()">Masuk</button>

            <div class="divider">atau masuk dengan</div>

            <div class="socials">
                <button class="btn-social">
                    <span class="s-icon">🔵</span> Google
                </button>
                <button class="btn-social">
                    <span class="s-icon">📘</span> Facebook
                </button>
            </div>

            <div class="signup-cta">
                Belum punya akun? <a href="#">Daftar sekarang</a>
            </div>

        </div>
    </div>

    <script>
        function togglePwd() {
            const p = document.getElementById('password');
            p.type = p.type === 'password' ? 'text' : 'password';
        }

        function handleLogin() {
            const email = document.getElementById('email').value.trim();
            const pass = document.getElementById('password').value;
            if (!email || !pass) {
                shake();
                return;
            }
            const btn = document.querySelector('.btn-login');
            btn.textContent = '✓ Berhasil Masuk!';
            btn.style.background = 'linear-gradient(135deg,#a8d8b0,#5db87a)';
            btn.style.boxShadow = '0 6px 20px rgba(80,180,100,0.35)';
        }

        function shake() {
            const fw = document.querySelector('.form-wrapper');
            fw.style.animation = 'none';
            fw.offsetHeight; // reflow
            fw.style.animation = 'shake 0.4s ease';
        }

        const styleEl = document.createElement('style');
        styleEl.textContent = `
      @keyframes shake {
        0%,100%{transform:translateX(0)}
        20%{transform:translateX(-8px)}
        40%{transform:translateX(8px)}
        60%{transform:translateX(-5px)}
        80%{transform:translateX(5px)}
      }
    `;
        document.head.appendChild(styleEl);
    </script>
</body>

</html>
