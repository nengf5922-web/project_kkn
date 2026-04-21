<!doctype html>
<html lang="id">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>@yield('title', 'Strideelle - Jual Beli Mobil Terpercaya')</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
        /* Membuat Footer selalu di bawah (Sticky Footer) */
        .card-img-top {
            height: 200px;
            object-fit: cover;
        }
        /* Tambahan CSS agar efek hover-white berfungsi */
        .hover-white:hover {
            color: #ffffff !important;
            text-decoration: underline !important;
        }
    </style>
  </head>
  
  <body class="d-flex flex-column min-vh-100 bg-light">

    {{-- NAVBAR --}}
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top shadow-sm">
      <div class="container">
        <a class="navbar-brand fw-bold fst-italic" href="{{ route('home') }}">
            <i class="bi bi-car-front-fill me-2"></i>STRIDEELLE
        </a>
        
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
          <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav ms-auto align-items-center">
            
            <li class="nav-item">
              <a class="nav-link {{ request()->routeIs('home') ? 'active fw-bold' : '' }}" href="{{ route('home') }}">Beranda</a>
            </li>
            
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('page.howToOrder') ? 'active fw-bold' : '' }}" href="{{ route('page.howToOrder') }}">Cara Pesan</a>
            </li>

            {{-- LOGIKA AUTH --}}
            @auth
                <li class="nav-item dropdown ms-lg-3">
                    <a class="nav-link dropdown-toggle btn btn-outline-secondary px-3 text-white border-0" href="#" role="button" data-bs-toggle="dropdown">
                        Hi, {{ Auth::user()->name }}
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end shadow">
                        
                        @if(Auth::user()->role === 'admin')
                            <li>
                                <a class="dropdown-item fw-bold text-primary" href="{{ route('dashboard') }}">
                                    <i class="bi bi-speedometer2 me-2"></i> Dashboard Admin
                                </a>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                        @endif

                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="dropdown-item text-danger">
                                    <i class="bi bi-box-arrow-right me-2"></i> Logout
                                </button>
                            </form>
                        </li>
                    </ul>
                </li>
            @else
                <li class="nav-item ms-lg-2">
                    <a href="{{ route('login') }}" class="btn btn-outline-light btn-sm px-3 ms-2">Masuk</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('register') }}" class="btn btn-primary btn-sm px-3 ms-2 fw-bold">Daftar</a>
                </li>
            @endauth
            
          </ul>
        </div>
      </div>
    </nav>

    {{-- KONTEN UTAMA --}}
    <main class="flex-grow-1">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show container mt-3" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @yield('content')
    </main>

    {{-- FOOTER --}}
    <footer class="bg-dark text-white py-5 mt-5 border-top border-secondary">
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-4">
                    <h4 class="fw-bold fst-italic"><i class="bi bi-car-front me-2"></i>Strideelle</h4>
                    <p class="small text-secondary mt-3">
                        Platform jual beli mobil terpercaya dengan kualitas terbaik.
                    </p>
                    <div class="mt-3">
                        <a href="javascript:void(0)" class="text-white me-3"><i class="bi bi-facebook fs-5"></i></a>
                        <a href="javascript:void(0)" class="text-white me-3"><i class="bi bi-instagram fs-5"></i></a>
                        <a href="javascript:void(0)" class="text-white me-3"><i class="bi bi-whatsapp fs-5"></i></a>
                    </div>
                </div>
    
                <div class="col-md-2 mb-4 offset-md-2">
                    <h6 class="fw-bold text-uppercase mb-3 text-primary">Bantuan</h6>
                    <ul class="list-unstyled">
                        <li class="mb-2">
                            <a href="{{ route('page.faq') }}" class="text-secondary text-decoration-none hover-white">FAQ</a>
                        </li>
                        <li class="mb-2">
                            <a href="{{ route('page.howToOrder') }}" class="text-secondary text-decoration-none hover-white">Cara Pemesanan</a>
                        </li>
                    </ul>
                </div>
    
                <div class="col-md-3 mb-4">
                    <h6 class="fw-bold text-uppercase mb-3 text-primary">Tentang Kami</h6>
                    <ul class="list-unstyled">
                        <li class="mb-2">
                            <a href="{{ route('page.location') }}" class="text-secondary text-decoration-none hover-white">Lokasi Toko</a>
                        </li>
                        <li class="mb-2">
                            <a href="{{ route('page.contact') }}" class="text-secondary text-decoration-none hover-white">Hubungi Kami</a>
                        </li>
                    </ul>
                </div>
    
                <div class="col-12 text-center mt-4 border-top border-secondary pt-4">
                    <p class="small text-secondary mb-0">
                        &copy; {{ date('Y') }} Strideelle. All Rights Reserved.
                    </p>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>