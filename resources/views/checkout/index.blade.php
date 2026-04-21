@extends('layouts.main')

@section('content')
<div class="container py-5" style="margin-top: 60px;">
    
    <div class="d-flex align-items-center mb-4">
        <a href="{{ route('keranjang') }}" class="text-decoration-none text-muted me-3">
            <i class="bi bi-arrow-left"></i> Kembali ke Keranjang
        </a>
        <h2 class="fw-bold mb-0">Checkout Pengiriman</h2>
    </div>

    <form action="{{ route('checkout.store') }}" method="POST">
        @csrf
        <div class="row">
            
            <div class="col-lg-7 mb-4">
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-white py-3">
                        <h6 class="mb-0 fw-bold"><i class="bi bi-geo-alt me-2"></i> Alamat Pengiriman</h6>
                    </div>
                    <div class="card-body p-4">
                        <div class="mb-3">
                            <label class="form-label text-muted small text-uppercase fw-bold">Nama Penerima</label>
                            <input type="text" name="name" class="form-control py-2 bg-light" value="{{ $user->name }}" readonly>
                        </div>

                        <div class="mb-3">
                            <label class="form-label text-muted small text-uppercase fw-bold">Nomor Telepon</label>
                            <input type="number" name="phone" class="form-control py-2" value="{{ $user->phone ?? '' }}" placeholder="08xxxxxxxx" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label text-muted small text-uppercase fw-bold">Alamat Lengkap</label>
                            <textarea name="address" class="form-control" rows="4" placeholder="Jalan, No. Rumah, RT/RW, Kecamatan, Kota" required>{{ $user->address ?? '' }}</textarea>
                            <div class="form-text">Pastikan alamat lengkap agar kurir mudah menemukan lokasi.</div>
                        </div>
                    </div>
                </div>

                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white py-3">
                        <h6 class="mb-0 fw-bold"><i class="bi bi-box-seam me-2"></i> Rincian Barang</h6>
                    </div>
                    <div class="card-body p-0">
                        <ul class="list-group list-group-flush">
                            @foreach($cart as $item)
                                <li class="list-group-item p-3 d-flex align-items-center">
                                    <div style="width: 60px; height: 60px;" class="rounded overflow-hidden bg-light me-3 border">
                                        @if(isset($item['image']))
                                            <img src="{{ asset('storage/' . $item['image']) }}" class="w-100 h-100 object-fit-cover" onerror="this.src='https://via.placeholder.com/60'">
                                        @else
                                            <img src="https://via.placeholder.com/60" class="w-100 h-100 object-fit-cover">
                                        @endif
                                    </div>
                                    
                                    <div class="flex-grow-1">
                                        <h6 class="mb-0 fw-bold small">{{ $item['name'] }}</h6>
                                        <small class="text-muted">Size: {{ $item['size'] }} | Qty: {{ $item['quantity'] }}</small>
                                    </div>

                                    <div class="fw-bold text-end">
                                        Rp {{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-lg-5">
                <div class="card border-0 shadow-sm bg-light sticky-top" style="top: 100px; z-index: 1;">
                    <div class="card-body p-4">
                        <h5 class="fw-bold mb-4">Ringkasan Biaya</h5>

                        <div class="d-flex justify-content-between mb-2 small">
                            <span class="text-muted">Total Harga Barang</span>
                            <span class="fw-bold">Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                        </div>
                        <div class="d-flex justify-content-between mb-3 small border-bottom pb-3">
                            <span class="text-muted">Ongkos Kirim (Flat)</span>
                            <span class="fw-bold">Rp {{ number_format($ongkir, 0, ',', '.') }}</span>
                        </div>

                        <div class="d-flex justify-content-between mb-4">
                            <span class="fw-bold fs-5">Total Tagihan</span>
                            <span class="fw-bold fs-4 text-danger">Rp {{ number_format($grand_total, 0, ',', '.') }}</span>
                        </div>

                        <div class="mb-4">
                            <label class="fw-bold d-block mb-2 small text-uppercase text-muted">Metode Pembayaran</label>
                            
                            <div class="form-check p-3 bg-white border rounded mb-2 cursor-pointer" onclick="document.getElementById('pay_transfer').click()">
                                <input class="form-check-input mt-1" type="radio" name="payment_method" id="pay_transfer" value="transfer" checked onchange="toggleBankDetails()">
                                <label class="form-check-label w-100 ps-2" for="pay_transfer" style="cursor: pointer;">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="fw-bold">Transfer Bank</span>
                                        <i class="bi bi-bank text-muted fs-5"></i>
                                    </div>
                                    <small class="text-muted d-block">BCA, Mandiri, BRI, BNI</small>
                                </label>
                            </div>

                            <div id="bankDetails" class="alert alert-info border-0 small mb-3">
                                <p class="mb-2 fw-bold"><i class="bi bi-info-circle me-1"></i> Silakan transfer ke salah satu rekening berikut:</p>
                                <ul class="list-unstyled mb-0 ps-2 border-start border-3 border-primary">
                                    <li class="mb-1"><strong>BCA:</strong> 123-456-7890 (a.n Strideelle)</li>
                                    <li class="mb-1"><strong>Mandiri:</strong> 123-000-456-789 (a.n Strideelle)</li>
                                    <li><strong>BRI:</strong> 0000-01-000000-50-0 (a.n Strideelle)</li>
                                </ul>
                                <p class="mt-2 mb-0 text-muted fst-italic">*Bukti transfer tidak perlu diupload, admin akan memverifikasi otomatis.</p>
                            </div>

                            <div class="form-check p-3 bg-white border rounded cursor-pointer" onclick="document.getElementById('pay_cod').click()">
                                <input class="form-check-input mt-1" type="radio" name="payment_method" id="pay_cod" value="cod" onchange="toggleBankDetails()">
                                <label class="form-check-label w-100 ps-2" for="pay_cod" style="cursor: pointer;">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="fw-bold">COD (Bayar di Tempat)</span>
                                        <i class="bi bi-cash-coin text-muted fs-5"></i>
                                    </div>
                                    <small class="text-muted d-block">Bayar tunai saat kurir datang</small>
                                </label>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-dark w-100 py-3 fw-bold fs-6 shadow-sm">
                            Buat Pesanan Sekarang <i class="bi bi-arrow-right ms-2"></i>
                        </button>
                        
                    </div>
                </div>
            </div>

        </div>
    </form>
</div>

<script>
    function toggleBankDetails() {
        var transferRadio = document.getElementById('pay_transfer');
        var bankDetails = document.getElementById('bankDetails');
        
        if (transferRadio.checked) {
            bankDetails.style.display = 'block';
        } else {
            bankDetails.style.display = 'none';
        }
    }

    // Jalankan saat halaman pertama kali dimuat
    document.addEventListener("DOMContentLoaded", function() {
        toggleBankDetails();
    });
</script>
@endsection