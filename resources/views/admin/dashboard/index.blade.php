@extends('layouts.admin')

@section('title', 'Dashboard Admin')

@section('content')
<div class="container-fluid px-4">
    
    <div class="d-flex align-items-center justify-content-between mb-4 mt-4">
        <div>
            <h1 class="h3 fw-bold text-dark mb-0">Dashboard Overview</h1>
            <p class="text-muted small">Ringkasan aktivitas toko Strideelle Anda hari ini.</p>
        </div>
        <a href="{{ route('admin.dashboard.report') }}" class="btn btn-dark btn-sm rounded-pill px-4">
            <i class="bi bi-download me-2"></i>Download Laporan
        </a>
    </div>

    <div class="row g-3 mb-4">
        <div class="col-sm-6 col-xl-3">
            <div class="card border-0 shadow-sm rounded-4 h-100" style="border-left: 5px solid #0d6efd !important;">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span class="text-muted small fw-bold text-uppercase">Total Kategori</span>
                        <div class="bg-primary bg-opacity-10 text-primary rounded-circle d-flex align-items-center justify-content-center" style="width: 35px; height: 35px;">
                            <i class="bi bi-tags-fill"></i>
                        </div>
                    </div>
                    <h3 class="fw-bold mb-0">{{ $totalCategories }}</h3>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-xl-3">
            <div class="card border-0 shadow-sm rounded-4 h-100" style="border-left: 5px solid #198754 !important;">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span class="text-muted small fw-bold text-uppercase">Total Produk</span>
                        <div class="bg-success bg-opacity-10 text-success rounded-circle d-flex align-items-center justify-content-center" style="width: 35px; height: 35px;">
                            <i class="bi bi-box-seam-fill"></i>
                        </div>
                    </div>
                    <h3 class="fw-bold mb-0">{{ $totalProducts }}</h3>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-xl-3">
            <div class="card border-0 shadow-sm rounded-4 h-100" style="border-left: 5px solid #ffc107 !important;">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span class="text-muted small fw-bold text-uppercase">Total Pesanan</span>
                        <div class="bg-warning bg-opacity-10 text-warning rounded-circle d-flex align-items-center justify-content-center" style="width: 35px; height: 35px;">
                            <i class="bi bi-cart-check-fill"></i>
                        </div>
                    </div>
                    <h3 class="fw-bold mb-0">{{ $totalOrders }}</h3>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-xl-3">
            <div class="card border-0 shadow-sm rounded-4 h-100" style="border-left: 5px solid #0dcaf0 !important;">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span class="text-muted small fw-bold text-uppercase">Total Pelanggan</span>
                        <div class="bg-info bg-opacity-10 text-info rounded-circle d-flex align-items-center justify-content-center" style="width: 35px; height: 35px;">
                            <i class="bi bi-people-fill"></i>
                        </div>
                    </div>
                    <h3 class="fw-bold mb-0">{{ $totalCustomers }}</h3>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-header bg-white border-bottom-0 py-3 d-flex justify-content-between align-items-center">
                    <h6 class="fw-bold mb-0"><i class="bi bi-graph-up-arrow me-2 text-primary"></i>Statistik Penjualan (Tahun Ini)</h6>
                    <span class="badge bg-light text-dark border">{{ date('Y') }}</span>
                </div>
                <div class="card-body">
                    <canvas id="salesChart" height="120"></canvas>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-header bg-white border-bottom-0 py-3 d-flex justify-content-between align-items-center">
                    <h6 class="fw-bold mb-0"><i class="bi bi-clock-history me-2 text-primary"></i>Pesanan Masuk</h6>
                    <a href="{{ route('admin.orders.index') }}" class="btn btn-xs btn-outline-primary rounded-pill py-0" style="font-size: 0.75rem;">Lihat Semua</a>
                </div>
                <div class="card-body p-0">
                    <div class="list-group list-group-flush">
                        @forelse($latestOrders as $order)
                            <div class="list-group-item d-flex justify-content-between align-items-center py-3 border-light">
                                <div>
                                    <div class="fw-bold text-dark small">#{{ $order->id }} - {{ $order->user->name ?? 'Guest' }}</div>
                                    <small class="text-muted d-block" style="font-size: 0.7rem;">
                                        {{ $order->created_at->diffForHumans() }}
                                    </small>
                                </div>
                                <div class="text-end">
                                    <span class="badge {{ $order->status == 'pending' ? 'bg-warning text-dark' : ($order->status == 'completed' ? 'bg-success' : 'bg-secondary') }} rounded-pill" style="font-size: 0.65rem;">
                                        {{ ucfirst($order->status) }}
                                    </span>
                                    <div class="fw-bold small mt-1 text-primary">Rp {{ number_format($order->total_price, 0, ',', '.') }}</div>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-5 text-muted">
                                <i class="bi bi-inbox fs-1 d-block mb-2 opacity-50"></i>
                                <span class="small">Belum ada pesanan masuk.</span>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const ctx = document.getElementById('salesChart').getContext('2d');
        
        // MENGAMBIL DATA DARI CONTROLLER (Laravel Blade Directive)
        const salesData = @json($chartValues);

        const salesChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
                datasets: [{
                    label: 'Pendapatan (Rp)',
                    data: salesData, // Data Dinamis dari Database
                    backgroundColor: 'rgba(26, 26, 26, 0.05)', 
                    borderColor: '#1a1a1a', 
                    borderWidth: 2,
                    tension: 0.4, 
                    fill: true,
                    pointBackgroundColor: '#fff',
                    pointBorderColor: '#1a1a1a',
                    pointBorderWidth: 2,
                    pointRadius: 4,
                    pointHoverRadius: 6
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                let label = context.dataset.label || '';
                                if (label) {
                                    label += ': ';
                                }
                                if (context.parsed.y !== null) {
                                    // Format Rupiah di Tooltip
                                    label += new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(context.parsed.y);
                                }
                                return label;
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: { borderDash: [5, 5] },
                        ticks: {
                            // Format K (Ribuan) di Sumbu Y
                            callback: function(value) {
                                return 'Rp ' + (value / 1000) + 'k';
                            }
                        }
                    },
                    x: {
                        grid: { display: false }
                    }
                }
            }
        });
    });
</script>
@endsection