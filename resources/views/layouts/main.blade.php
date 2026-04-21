<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Strideelle - Confidence in Every Step</title>
    
    <link href="{{ asset('assets/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
    /* --- 1. LAYOUT UTAMA --- */
    body {
        overflow-x: hidden; width: 100%; background-color: #ffffff;
        font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; color: #333;
        display: flex; flex-direction: column; min-height: 100vh;
    }

    /* --- 2. HEADER / NAVBAR (DARK THEME - SESUAI REQUEST GAMBAR) --- */
    .header-nav {
        background-color: #2c2c2c;
        border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        padding: 0.8rem 2rem;
        position: fixed; top: 0; left: 0; width: 100%; z-index: 1030;
    }

    .navbar-brand {
        color: #ffffff !important; font-weight: 800; font-size: 1.5rem; letter-spacing: 0.5px;
    }

    /* --- SEARCH BAR (MODEL PILL/LONJONG) --- */
    .search-container {
        flex-grow: 1; display: flex; justify-content: center;
    }
    .search-form-custom {
        position: relative; width: 100%; max-width: 500px;
    }
    .search-input-pill {
        background-color: #4f4f4f; /* Abu-abu terang */
        border: none; border-radius: 50px; padding: 10px 20px; padding-right: 45px;
        color: #ddd; width: 100%; outline: none; transition: 0.3s; font-size: 0.95rem;
    }
    .search-input-pill::placeholder { color: #aaa; }
    .search-input-pill:focus { background-color: #5a5a5a; color: #fff; }
    
    .search-btn-icon {
        position: absolute; right: 15px; top: 50%; transform: translateY(-50%);
        background: none; border: none; color: #ccc;
    }
    .search-btn-icon:hover { color: #fff; }

    /* --- ICONS & LINKS (KANAN) --- */
    .nav-icon-group { display: flex; align-items: center; gap: 20px; }
    
    .nav-icon-link {
        color: #ffffff !important; font-size: 1.3rem; text-decoration: none;
        position: relative; transition: 0.2s; background: none; border: none; padding: 0; cursor: pointer;
    }
    .nav-icon-link:hover { opacity: 0.8; transform: translateY(-2px); }

    .badge-dot {
        position: absolute; top: 0; right: -2px; width: 9px; height: 9px;
        background-color: #dc3545; border-radius: 50%; border: 1px solid #2c2c2c;
    }

    /* --- TOMBOL LOGIN / REGISTER (MODEL BARU) --- */
    .btn-auth-login {
        background-color: #ffffff; color: #000000; font-weight: 700;
        border-radius: 50px; padding: 6px 24px; text-decoration: none; transition: 0.3s;
        font-size: 0.9rem; border: 2px solid #ffffff;
    }
    .btn-auth-login:hover { background-color: #e0e0e0; border-color: #e0e0e0; }

    .btn-auth-register {
        background-color: transparent; color: #ffffff; font-weight: 600;
        border-radius: 50px; padding: 6px 24px; text-decoration: none; transition: 0.3s;
        font-size: 0.9rem; border: 1px solid #ffffff; margin-left: 10px;
    }
    .btn-auth-register:hover { background-color: rgba(255,255,255,0.1); }

    /* --- DROPDOWN CUSTOM --- */
    .dropdown-menu-custom {
        background-color: #ffffff; border: none; border-radius: 12px;
        box-shadow: 0 10px 40px rgba(0,0,0,0.2); margin-top: 20px !important; 
        min-width: 240px; padding: 10px 0;
    }
    .dropdown-item { padding: 10px 20px; font-size: 0.95rem; color: #333; display: flex; align-items: center; transition: 0.2s; }
    .dropdown-item:hover { background-color: #f8f9fa; color: #b65822; padding-left: 25px; }
    .dropdown-item i { margin-right: 12px; color: #777; font-size: 1.1rem; }
    .dropdown-item:hover i { color: #b65822; }

    /* ============================================================
       3. CSS RESTORATION: STYLE KHUSUS KONTEN DASHBOARD
       (Agar gambar sepatu dan teks tidak berantakan)
       ============================================================ */
    .content-area { 
        margin-left: 0; margin-right: 0; 
        padding-top: 110px; /* Jarak dari navbar */
        padding-left: 5%; padding-right: 5%; 
        min-height: 100vh; 
    }

    /* Style Editorial Header (Judul Halaman Depan) */
    .editorial-header { text-align: center; margin-top: 0; margin-bottom: 3rem; }
    .editorial-header h2 { font-weight: 900; letter-spacing: 2px; text-transform: uppercase; color: #1a1a1a; font-size: 2rem; margin-top: 0; }
    .editorial-header p { color: #8d6e63; font-family: serif; font-style: italic; }

    /* Style Bagian Teks & Gambar */
    .section-title { font-size: 0.85rem; font-weight: 800; text-transform: uppercase; margin-bottom: 1rem; color: #1a1a1a; letter-spacing: 1.5px; border-bottom: 2px solid #1a1a1a; display: inline-block; padding-bottom: 5px; }
    .text-content { font-size: 0.9rem; line-height: 1.8; color: #444; margin-bottom: 2rem; text-align: justify; }
    
    /* Agar Gambar Tidak Gepeng/Berantakan */
    .img-editorial { width: 100%; object-fit: cover; display: block; transition: filter 0.3s; }
    .img-editorial:hover { filter: brightness(90%); }
    .aspect-square { aspect-ratio: 1 / 1; object-fit: cover; }
    .aspect-portrait { aspect-ratio: 3 / 4; object-fit: cover; }
    .clean-link { text-decoration: none; color: inherit; }

    /* --- 4. FOOTER --- */
    .footer { background-color: #2b2b2b; border-top: none; padding: 4rem 0; margin-top: 6rem; width: 100%; color: #cccccc; }
    .footer h6 { color: #ffffff !important; text-transform: uppercase; letter-spacing: 1px; font-size: 0.85rem; margin-bottom: 1.5rem; }
    .footer a.fw-bold { color: #ffffff !important; letter-spacing: 1px; }
    .footer-links { list-style: none; padding-left: 0; }
    .footer-links li { margin-bottom: 0.8rem; }
    .footer-links a { text-decoration: none; color: #999; font-size: 0.9rem; transition: all 0.2s; }
    .footer-links a:hover { color: #ffffff; padding-left: 5px; }
    .footer-social-icons a { font-size: 1.2rem; color: #fff; margin-right: 1.2rem; opacity: 0.7; }
    .footer-social-icons a:hover { opacity: 1; }

    /* --- PRODUCT CARD --- */
    .product-card { transition: 0.3s; border: 1px solid #f0f0f0; background: #fff; position: relative; overflow: hidden; }
    .product-card:hover { transform: translateY(-5px); box-shadow: 0 10px 20px rgba(0,0,0,0.08); }
    .product-img-wrapper { position: relative; padding-top: 120%; background: #f9f9f9; overflow: hidden; }
    .product-img-wrapper img { position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover; transition: 0.5s; }
    .product-card:hover img { transform: scale(1.05); }
    .product-actions { position: absolute; bottom: 15px; right: 15px; display: flex; gap: 10px; opacity: 0; transform: translateY(20px); transition: 0.3s; }
    .product-card:hover .product-actions { opacity: 1; transform: translateY(0); }
    .btn-action { width: 35px; height: 35px; border-radius: 50%; background: #fff; display: flex; align-items: center; justify-content: center; border: none; box-shadow: 0 2px 5px rgba(0,0,0,0.1); transition: 0.2s; color: #000; }
    .btn-action:hover { background: #b65822; color: #fff; }
    </style>
</head>
<body>

    <nav class="navbar header-nav">
        <div class="container-fluid d-flex align-items-center justify-content-between">
            
            <a class="navbar-brand" href="{{ route('home') }}">
                Strideelle
            </a>

            <div class="search-container px-4 d-none d-md-flex">
                <form action="{{ route('products.search') }}" method="GET" class="search-form-custom">
                    <input type="search" name="query" class="search-input-pill" placeholder="Cari produk..." value="{{ request('query') }}">
                    <button type="submit" class="search-btn-icon">
                        <i class="bi bi-search"></i>
                    </button>
                </form>
            </div>

            <div class="nav-icon-group">
                
                {{-- [BARU] ICON DASHBOARD (Grid) --}}
                <a href="{{ route('dashboard') }}" class="nav-icon-link" title="Dashboard">
                    <i class="bi bi-grid-fill"></i> 
                </a>

                <div class="dropdown">
                    <button class="nav-icon-link" type="button" data-bs-toggle="dropdown" aria-expanded="false" title="Koleksi">
                        <i class="bi bi-collection"></i> 
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-custom">
                        <li class="px-3 py-2 text-muted small fw-bold text-uppercase" style="font-size: 0.75rem; letter-spacing: 1px;">Kategori</li>
                        
                        @if(isset($global_categories))
                            @foreach($global_categories as $category)
                                <li>
                                    <a class="dropdown-item" href="{{ route('kategori.show', $category->slug) }}">
                                        @if(Str::contains(strtolower($category->name), 'heels')) <i class="bi bi-gem"></i>
                                        @elseif(Str::contains(strtolower($category->name), 'sneaker')) <i class="bi bi-lightning-charge"></i>
                                        @elseif(Str::contains(strtolower($category->name), 'boot')) <i class="bi bi-layers"></i>
                                        @else <i class="bi bi-bag-heart"></i> @endif
                                        
                                        {{ $category->name }}
                                    </a>
                                </li>
                            @endforeach
                        @endif
                    </ul>
                </div>

                <a href="{{ route('keranjang') }}" class="nav-icon-link" title="Keranjang">
                    <i class="bi bi-bag"></i>
                </a>

                <a href="{{ route('notifikasi') }}" class="nav-icon-link" title="Notifikasi">
                    <i class="bi bi-bell"></i>
                    <span class="badge-dot"></span>
                </a>

                <a href="https://wa.me/6282321863102" target="_blank" class="nav-icon-link me-2" title="Chat">
                    <i class="bi bi-chat-dots"></i>
                </a>

                @auth
                    <div class="dropdown">
                        <a href="#" class="d-flex align-items-center text-decoration-none" data-bs-toggle="dropdown">
                            <div style="width: 35px; height: 35px; background: #fff; color: #000; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: bold; border: 2px solid rgba(255,255,255,0.5);">
                                {{ substr(Auth::user()->name, 0, 1) }}
                            </div>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-custom">
                            <li class="px-3 py-2 border-bottom mb-2">
                                <div class="fw-bold text-dark">{{ Auth::user()->name }}</div>
                                <small class="text-muted">{{ Auth::user()->email }}</small>
                            </li>
                            <li><a class="dropdown-item" href="{{ route('profile.edit') }}"><i class="bi bi-person"></i> Edit Profil</a></li>
                            @if(Auth::user()->role == 'admin')
                                <li><a class="dropdown-item" href="{{ route('admin.dashboard') }}"><i class="bi bi-speedometer2"></i> Dashboard Admin</a></li>
                            @endif
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger"><i class="bi bi-box-arrow-right"></i> Logout</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                @else
                    <div class="d-flex align-items-center">
                        <a href="{{ route('login') }}" class="btn-auth-login">Login</a>
                        <a href="{{ route('register') }}" class="btn-auth-register">Register</a>
                    </div>
                @endauth

            </div>
        </div>
    </nav>

    <main class="content-area">
        @yield('content')
    </main>

    <footer class="footer">
        <div class="container-fluid px-5">
            <div class="row">
                <div class="col-md-4 mb-3">
                    <a class="fw-bold fs-4 text-decoration-none" href="{{ route('home') }}">Strideelle</a>
                    <p class="mt-2" style="color: #888;">&copy; {{ date('Y') }} Strideelle. All rights reserved.</p>
                </div>
                <div class="col-md-2 offset-md-2 mb-3">
                    <h6>Kategori</h6>
                    <ul class="footer-links">
                        @if(isset($global_categories))
                            @foreach($global_categories->take(5) as $category)
                                <li><a href="{{ route('kategori.show', $category->slug) }}">{{ $category->name }}</a></li>
                            @endforeach
                        @endif
                    </ul>
                </div>
                <div class="col-md-2 mb-3">
                    <h6>Bantuan</h6>
                    <ul class="footer-links">
                        <li><a href="{{ route('page.faq') }}">FAQ</a></li>
                        <li><a href="{{ route('page.howToOrder') }}">Cara Pemesanan</a></li>
                    </ul>
                </div>
                <div class="col-md-2 mb-3">
                    <h6>Tentang Kami</h6>
                    <ul class="footer-links">
                        <li><a href="{{ route('page.location') }}">Lokasi Toko</a></li>
                        <li><a href="{{ route('page.contact') }}">Hubungi Kami</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>

    <script src="{{ asset('assets/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        @if(session('transaction_success'))
            Swal.fire({ title: 'Berhasil!', text: "{{ session('transaction_success') }}", icon: 'success', confirmButtonColor: '#1a1a1a', timer: 5000 });
        @endif
        @if(session('error'))
            Swal.fire({ title: 'Oops...', text: "{{ session('error') }}", icon: 'error', confirmButtonColor: '#d33' });
        @endif
        @if(session('success'))
            const Toast = Swal.mixin({ toast: true, position: 'top-end', showConfirmButton: false, timer: 3000, timerProgressBar: true });
            Toast.fire({ icon: 'success', title: "{{ session('success') }}" });
        @endif
    </script>
</body>
</html>