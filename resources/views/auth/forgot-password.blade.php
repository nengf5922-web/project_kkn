<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password - Strideelle</title>
    
    <link href="{{ asset('assets/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            height: 100vh;
            overflow: hidden;
            background-image: url('https://images.unsplash.com/photo-1515347619252-60a6bf4fffce?q=80&w=2060&auto=format&fit=crop'); /* Background Elegan */
            background-size: cover;
            background-position: center;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* Overlay Gelap untuk Background */
        .bg-overlay {
            position: absolute;
            top: 0; left: 0; right: 0; bottom: 0;
            background: rgba(0, 0, 0, 0.6); /* Gelap transparan */
            backdrop-filter: blur(4px); /* Efek Blur Estetik */
            z-index: 0;
        }

        /* Kartu Tengah */
        .reset-card {
            background: rgba(255, 255, 255, 0.95);
            width: 100%;
            max-width: 450px;
            padding: 2.5rem;
            border-radius: 16px;
            position: relative;
            z-index: 10;
            box-shadow: 0 15px 35px rgba(0,0,0,0.3);
            text-align: center;
        }

        /* Typography */
        .brand-title {
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 2px;
            color: #121212;
            margin-bottom: 1.5rem;
            font-size: 1.2rem;
        }

        .page-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: #121212;
            margin-bottom: 0.5rem;
        }

        .page-desc {
            font-size: 0.9rem;
            color: #666;
            margin-bottom: 2rem;
            line-height: 1.5;
        }

        /* Input Floating */
        .form-floating > .form-control {
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            background-color: #f8f9fa;
        }
        .form-floating > .form-control:focus {
            border-color: #121212;
            background-color: #fff;
            box-shadow: 0 0 0 4px rgba(0,0,0,0.05);
        }
        .form-floating > label { color: #888; }

        /* Button */
        .btn-reset {
            background-color: #121212;
            color: #fff;
            padding: 14px;
            width: 100%;
            font-weight: 600;
            letter-spacing: 1px;
            border-radius: 8px;
            transition: all 0.3s;
            text-transform: uppercase;
            font-size: 0.85rem;
            border: none;
            margin-top: 1rem;
        }
        .btn-reset:hover {
            background-color: #b65822; /* Aksen Orange Bata */
            color: #fff;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(182, 88, 34, 0.3);
        }

        /* Back Link */
        .back-link {
            display: inline-block;
            margin-top: 1.5rem;
            color: #666;
            text-decoration: none;
            font-size: 0.85rem;
            font-weight: 500;
            transition: 0.2s;
        }
        .back-link:hover {
            color: #121212;
        }
        .back-link i { margin-right: 5px; }

    </style>
</head>
<body>

    <div class="bg-overlay"></div>

    <div class="container px-3">
        <div class="reset-card mx-auto">
            
            <div class="brand-title">Strideelle</div>
            
            <h1 class="page-title">Lupa Password?</h1>
            <p class="page-desc">
                Jangan khawatir. Masukkan email yang terdaftar dan kami akan mengirimkan link untuk mereset password Anda.
            </p>

            @if (session('status'))
                <div class="alert alert-success small p-2 mb-4 border-0 bg-success bg-opacity-10 text-success rounded-3">
                    <i class="bi bi-check-circle me-1"></i> {{ session('status') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger small p-2 mb-4 border-0 bg-danger bg-opacity-10 text-danger rounded-3 text-start">
                    <ul class="mb-0 ps-3">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <div class="form-floating mb-3">
                    <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com" value="{{ old('email') }}" required autofocus>
                    <label for="email">Alamat Email</label>
                </div>

                <button type="submit" class="btn-reset">
                    Kirim Link Reset
                </button>

            </form>

            <a href="{{ route('login') }}" class="back-link">
                <i class="bi bi-arrow-left"></i> Kembali ke Login
            </a>

        </div>
    </div>

</body>
</html>