@extends('layouts.main')

@section('content')
<div class="container py-5" style="max-width: 800px;">
    
    <div class="d-flex align-items-center mb-4">
        <h2 class="fw-bold text-dark mb-0">Notifikasi</h2>
        <span class="badge bg-danger rounded-pill ms-2">2 Baru</span>
    </div>

    <div class="list-group shadow-sm rounded-3 border-0">
        
        <a href="#" class="list-group-item list-group-item-action p-4 border-bottom bg-light">
            <div class="d-flex w-100 justify-content-between align-items-center mb-1">
                <h6 class="mb-0 fw-bold text-primary">
                    <i class="bi bi-gift-fill me-2"></i> Selamat Datang!
                </h6>
                <small class="text-muted">Baru saja</small>
            </div>
            <p class="mb-1 text-dark">Terima kasih telah bergabung dengan Strideelle. Nikmati pengalaman belanja sepatu terbaik.</p>
        </a>

        <a href="#" class="list-group-item list-group-item-action p-4 border-bottom">
            <div class="d-flex w-100 justify-content-between align-items-center mb-1">
                <h6 class="mb-0 fw-bold text-dark">
                    <i class="bi bi-box-seam me-2"></i> Koleksi Baru
                </h6>
                <small class="text-muted">2 jam yang lalu</small>
            </div>
            <p class="mb-1 text-muted">Cek koleksi "Wedding Heels" terbaru kami yang baru saja rilis hari ini.</p>
        </a>

    </div>

    <div class="text-center mt-4">
        <p class="text-muted small">Tidak ada notifikasi lainnya.</p>
    </div>

</div>
@endsection