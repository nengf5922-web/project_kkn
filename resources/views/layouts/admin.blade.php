<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Strideelle Admin</title>
    
    <link href="{{ asset('assets/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        /* --- GLOBAL STYLE --- */
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #f3f5f9;
            overflow-x: hidden;
        }

        /* --- MODERN SIDEBAR STYLE --- */
        #sidebar {
            min-width: 270px;
            max-width: 270px;
            background: #111c43; /* Warna Deep Navy Modern */
            color: #fff;
            transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
            height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            z-index: 1000;
            display: flex;
            flex-direction: column;
            box-shadow: 5px 0 15px rgba(0,0,0,0.05);
            border-right: 1px solid rgba(255,255,255,0.05);
        }

        /* Brand Area */
        .sidebar-header {
            padding: 2rem 1.5rem;
            display: flex;
            align-items: center;
            gap: 12px;
            border-bottom: 1px solid rgba(255,255,255,0.05);
            background: rgba(0,0,0,0.1);
        }
        .brand-logo {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, #3a7bd5, #00d2ff); /* Gradient Biru */
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.2rem;
            box-shadow: 0 4px 10px rgba(0,210,255,0.3);
        }
        .brand-text {
            font-size: 1.25rem;
            font-weight: 700;
            letter-spacing: -0.5px;
            color: white;
            text-decoration: none;
        }

        /* Menu Area */
        .components {
            padding: 1.5rem 1rem;
            flex-grow: 1; /* Isi ruang kosong */
            overflow-y: auto;
        }
        
        /* Label Kategori Kecil */
        .nav-label {
            font-size: 0.7rem;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            color: #636b8c;
            font-weight: 700;
            margin: 1.5rem 0 0.5rem 1rem;
        }

        /* Menu Item Styles */
        .nav-link-modern {
            display: flex;
            align-items: center;
            padding: 12px 16px;
            color: #a0aec0;
            text-decoration: none;
            border-radius: 12px;
            margin-bottom: 5px;
            transition: all 0.2s ease;
            font-weight: 500;
            font-size: 0.95rem;
            position: relative;
        }
        
        .nav-link-modern i {
            font-size: 1.1rem;
            margin-right: 12px;
            transition: all 0.2s;
            color: #718096;
        }

        /* Hover State */
        .nav-link-modern:hover {
            background-color: rgba(255,255,255,0.05);
            color: #fff;
            transform: translateX(3px);
        }
        .nav-link-modern:hover i {
            color: #fff;
        }

        /* Active State */
        .nav-link-modern.active {
            background: linear-gradient(90deg, rgba(58, 123, 213, 0.15), transparent);
            color: #fff;
            font-weight: 600;
            border-left: 4px solid #3a7bd5; /* Garis aksen biru */
        }
        .nav-link-modern.active i {
            color: #3a7bd5; /* Ikon jadi biru */
        }

        /* Badge Styles */
        .menu-badge {
            background: #ff4757;
            color: white;
            font-size: 0.7rem;
            padding: 2px 8px;
            border-radius: 6px;
            font-weight: 700;
            box-shadow: 0 2px 5px rgba(255, 71, 87, 0.4);
        }

        /* --- USER PROFILE CARD (BOTTOM) --- */
        .user-profile-card {
            margin: 1rem;
            padding: 12px;
            background: rgba(255,255,255,0.05);
            border-radius: 12px;
            border: 1px solid rgba(255,255,255,0.05);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .user-info {
            display: flex;
            align-items: center;
            gap: 10px;
            overflow: hidden;
        }
        .user-avatar {
            width: 36px;
            height: 36px;
            background: #2d3748;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #a0aec0;
        }
        .user-details h6 {
            margin: 0;
            font-size: 0.85rem;
            font-weight: 600;
            color: #fff;
            white-space: nowrap;
        }
        .user-details small {
            font-size: 0.7rem;
            color: #718096;
        }
        .btn-logout-icon {
            background: transparent;
            border: none;
            color: #ff4757;
            padding: 5px;
            border-radius: 6px;
            transition: 0.2s;
            cursor: pointer;
        }
        .btn-logout-icon:hover {
            background: rgba(255, 71, 87, 0.1);
        }

        /* --- CONTENT AREA --- */
        #content {
            margin-left: 270px;
            padding: 2rem;
            min-height: 100vh;
            transition: all 0.3s;
        }

        /* Mobile Responsive */
        @media (max-width: 768px) {
            #sidebar { margin-left: -270px; }
            #sidebar.active { margin-left: 0; }
            #content { margin-left: 0; padding-top: 5rem; }
            .sidebar-overlay { display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.5); z-index: 999; }
            .sidebar-overlay.active { display: block; }
        }
        
        .mobile-toggle {
            display: none;
            position: fixed; top: 1rem; left: 1rem; z-index: 1050;
            background: #111c43; color: white; border: none; padding: 0.5rem; border-radius: 8px;
        }
        @media (max-width: 768px) { .mobile-toggle { display: block; } }

    </style>
</head>
<body>

    <div class="sidebar-overlay" onclick="toggleSidebar()"></div>
    <button class="mobile-toggle shadow" onclick="toggleSidebar()">
        <i class="bi bi-list fs-4"></i>
    </button>

    <nav id="sidebar">
        <div class="sidebar-header">
            <div class="brand-logo">
                <i class="bi bi-shield-check"></i>
            </div>
            <div>
                <a href="{{ route('admin.dashboard') }}" class="brand-text">Strideelle</a>
                <small style="display:block; font-size: 0.65rem; color: #636b8c; letter-spacing: 1px;">ADMINISTRATOR</small>
            </div>
        </div>

        <div class="components">
            
            <div class="nav-label">Main Menu</div>
            
            <a href="{{ route('admin.dashboard') }}" class="nav-link-modern {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>

            <div class="nav-label">Manajemen Toko</div>

            <a href="{{ route('admin.categories.index') }}" class="nav-link-modern {{ request()->routeIs('admin.categories*') ? 'active' : '' }}">
                <i class="bi bi-tags"></i>
                <span>Kategori</span>
            </a>

            <a href="{{ route('admin.products.index') }}" class="nav-link-modern {{ request()->routeIs('admin.products*') ? 'active' : '' }}">
                <i class="bi bi-box-seam"></i>
                <span>Produk</span>
            </a>

            <a href="{{ route('admin.users.index') }}" class="nav-link-modern {{ request()->routeIs('admin.users*') ? 'active' : '' }}">
                <i class="bi bi-people"></i>
                <span>Pengguna</span>
            </a>

            <a href="{{ route('admin.orders.index') }}" class="nav-link-modern {{ request()->routeIs('admin.orders*') ? 'active' : '' }}">
                <i class="bi bi-cart-check"></i>
                <span>Pesanan</span>
                
                @if(isset($pendingOrders) && $pendingOrders > 0)
                    <span class="menu-badge ms-auto">{{ $pendingOrders }}</span>
                @endif
            </a>

        </div>

        <div class="user-profile-card">
            <div class="user-info">
                <div class="user-avatar">
                    <i class="bi bi-person-fill"></i>
                </div>
                <div class="user-details">
                    <h6>{{ Auth::user()->name }}</h6>
                    <small class="text-truncate" style="max-width: 100px;">Online</small>
                </div>
            </div>
            
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn-logout-icon" title="Logout">
                    <i class="bi bi-box-arrow-right"></i>
                </button>
            </form>
        </div>
    </nav>

    <div id="content">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show shadow-sm border-0 mb-4" role="alert" style="border-radius: 10px;">
                <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @yield('content')
    </div>

    <script src="{{ asset('assets/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function toggleSidebar() {
            document.getElementById('sidebar').classList.toggle('active');
            document.querySelector('.sidebar-overlay').classList.toggle('active');
        }
    </script>
</body>
</html>