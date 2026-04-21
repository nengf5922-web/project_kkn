<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Strideelle</title>
    
    <link href="{{ asset('assets/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #ffffff;
            height: 100vh;
            overflow: hidden; /* Mencegah scroll */
        }

        .login-wrapper {
            height: 100vh;
            width: 100%;
        }

        /* --- BAGIAN KIRI (GAMBAR) --- */
        .login-image-side {
            background-image: url('{{ asset('assets/products/login.jpg') }}'); /* Gambar Sepatu Mewah */
            background-size: cover;
            background-position: center;
            position: relative;
            height: 100%;
        }
        
        /* Overlay Gelap di atas gambar agar teks terbaca (jika ada) */
        .login-overlay {
            position: absolute;
            top: 0; left: 0; right: 0; bottom: 0;
            background: linear-gradient(to bottom, rgba(0,0,0,0.2), rgba(0,0,0,0.6));
        }

        .brand-overlay {
            position: absolute;
            top: 40px;
            left: 40px;
            color: white;
            z-index: 10;
        }

        /* --- BAGIAN KANAN (FORM) --- */
        .login-form-side {
            background: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100%;
            padding: 2rem;
            position: relative;
        }

        .form-container {
            width: 100%;
            max-width: 420px;
        }

        /* Typography */
        .welcome-title {
            font-size: 2rem;
            font-weight: 700;
            color: #121212;
            margin-bottom: 0.5rem;
            letter-spacing: -0.5px;
        }
        .welcome-subtitle {
            color: #666;
            margin-bottom: 2.5rem;
            font-size: 0.95rem;
        }

        /* Input Styles (Floating Label) */
        .form-floating > .form-control {
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            background-color: #f9f9f9;
        }
        .form-floating > .form-control:focus {
            border-color: #121212;
            background-color: #fff;
            box-shadow: 0 0 0 4px rgba(0,0,0,0.05);
        }
        .form-floating > label {
            color: #888;
        }

        /* Checkbox */
        .form-check-input:checked {
            background-color: #121212;
            border-color: #121212;
        }

        /* Button */
        .btn-login {
            background-color: #121212;
            color: #fff;
            padding: 14px;
            width: 100%;
            font-weight: 600;
            letter-spacing: 0.5px;
            border-radius: 8px;
            transition: all 0.3s;
            text-transform: uppercase;
            font-size: 0.85rem;
            border: none;
        }
        .btn-login:hover {
            background-color: #b65822; /* Aksen Orange Bata */
            color: #fff;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(182, 88, 34, 0.3);
        }

        /* Links */
        .forgot-link {
            font-size: 0.85rem;
            color: #666;
            text-decoration: none;
            font-weight: 500;
        }
        .forgot-link:hover { color: #121212; text-decoration: underline; }

        .register-text {
            text-align: center;
            margin-top: 2rem;
            font-size: 0.9rem;
            color: #666;
        }
        .register-link {
            color: #121212;
            font-weight: 700;
            text-decoration: none;
        }
        .register-link:hover { text-decoration: underline; }

        /* Mobile Responsiveness */
        @media (max-width: 768px) {
            .login-image-side { display: none; } /* Sembunyikan gambar di HP */
            .login-form-side { padding: 1.5rem; }
        }
    </style>
</head>
<body>

    <div class="row g-0 login-wrapper">
        
        <div class="col-md-6 d-none d-md-block">
            <div class="login-image-side">
                <div class="login-overlay"></div>
                <div class="brand-overlay">
                    <h4 class="fw-bold text-uppercase ls-2">Strideelle</h4>
                    <p class="small text-white-50">Confidence in Every Step.</p>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="login-form-side">
                <div class="form-container">
                    
                    <div class="mb-4">
                        <h1 class="welcome-title">Welcome Back</h1>
                        <p class="welcome-subtitle">Masukan detail akun Anda untuk melanjutkan belanja.</p>
                    </div>

                    @if (session('status'))
                        <div class="alert alert-success mb-3 p-2 small">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if ($errors->any())
                        <div class="alert alert-danger mb-4 p-2 small border-0 bg-danger bg-opacity-10 text-danger rounded-3">
                            <ul class="mb-0 ps-3">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-floating mb-3">
                            <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com" value="{{ old('email') }}" required autofocus>
                            <label for="email">Email Address</label>
                        </div>

                        <div class="form-floating mb-3">
                            <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                            <label for="password">Password</label>
                        </div>

                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember_me">
                                <label class="form-check-label small text-muted" for="remember_me">
                                    Ingat Saya
                                </label>
                            </div>
                            
                            @if (Route::has('password.request'))
                                <a class="forgot-link" href="{{ route('password.request') }}">
                                    Lupa Password?
                                </a>
                            @endif
                        </div>

                        <button type="submit" class="btn-login">
                            Masuk Sekarang
                        </button>

                        <div class="register-text">
                            Belum punya akun? 
                            <a href="{{ route('register') }}" class="register-link">Daftar Disini</a>
                        </div>
                    </form>

                </div>
            </div>
        </div>

    </div>

</body>
</html>