@extends('layouts.main')

@section('title', 'Cara Pemesanan - Strideelle')

@section('content')
<div class="container py-5" style="margin-top: 50px;">
    <div class="text-center mb-5">
        <h2 class="fw-bold text-uppercase" style="letter-spacing: 2px;">Cara Pemesanan</h2>
        <p class="text-muted">Dapatkan sepatu cantik impianmu hanya dalam 4 langkah mudah</p>
    </div>

    <div class="row text-center">
        
        <div class="col-md-3 mb-4">
            <div class="card h-100 border-0 shadow-sm p-4 hover-effect">
                <div class="mb-3 text-dark">
                    <i class="bi bi-search fs-1"></i>
                </div>
                <h5 class="fw-bold">1. Pilih Produk</h5>
                <p class="small text-muted">Jelajahi koleksi Heels, Sneakers, atau Boots kami. Pastikan cek <strong>Size Chart</strong> agar ukuran pas di kaki.</p>
            </div>
        </div>

        <div class="col-md-3 mb-4">
            <div class="card h-100 border-0 shadow-sm p-4 hover-effect">
                <div class="mb-3 text-dark">
                    <i class="bi bi-bag-plus fs-1"></i>
                </div>
                <h5 class="fw-bold">2. Masukkan Keranjang</h5>
                <p class="small text-muted">Klik tombol <strong>"Masukkan Keranjang"</strong> pada produk yang kamu suka. Kamu bisa belanja beberapa item sekaligus.</p>
            </div>
        </div>

        <div class="col-md-3 mb-4">
            <div class="card h-100 border-0 shadow-sm p-4 hover-effect">
                <div class="mb-3 text-dark">
                    <i class="bi bi-credit-card fs-1"></i>
                </div>
                <h5 class="fw-bold">3. Checkout & Bayar</h5>
                <p class="small text-muted">Isi alamat pengiriman dengan lengkap, pilih metode pembayaran, dan selesaikan transaksi.</p>
            </div>
        </div>

        <div class="col-md-3 mb-4">
            <div class="card h-100 border-0 shadow-sm p-4 hover-effect">
                <div class="mb-3 text-dark">
                    <i class="bi bi-box-seam fs-1"></i>
                </div>
                <h5 class="fw-bold">4. Barang Dikirim</h5>
                <p class="small text-muted">Duduk manis! Pesananmu akan kami proses dan segera dikirim ke depan pintu rumahmu.</p>
            </div>
        </div>

    </div>
</div>

{{-- Sedikit CSS Tambahan untuk file ini --}}
<style>
    .hover-effect { transition: transform 0.3s; }
    .hover-effect:hover { transform: translateY(-5px); }
</style>
@endsection