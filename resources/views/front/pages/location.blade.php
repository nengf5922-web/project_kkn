@extends('layouts.main')

@section('title', 'Lokasi Toko - Strideelle')

@section('content')
<div class="container py-5" style="margin-top: 50px;">
    <div class="row align-items-center">
        
        <div class="col-md-6 mb-4">
            <h2 class="fw-bold mb-3 text-uppercase" style="letter-spacing: 1px;">Kunjungi Toko Kami</h2>
            <p class="text-muted mb-4">Ingin mencoba sepatu langsung? Datang ke lokasi kami dan buktikan kualitas produk Strideelle.</p>
            
            <div class="d-flex mb-4">
                <div class="me-3">
                    <div style="width: 45px; height: 45px; background: #f8f9fa; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                        <i class="bi bi-geo-alt-fill text-danger fs-5"></i>
                    </div>
                </div>
                <div>
                    <h5 class="fw-bold">Alamat Strideelle</h5>
                    <p class="mb-0 text-muted">Kp kubang buleud, Sinagar, Kec. Sukaratu,</p>
                    <p class="text-muted">Kabupaten Tasikmalaya, Jawa Barat 46415</p>
                </div>
            </div>

            <div class="d-flex mb-3">
                <div class="me-3">
                    <div style="width: 45px; height: 45px; background: #f8f9fa; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                        <i class="bi bi-clock-fill text-warning fs-5"></i>
                    </div>
                </div>
                <div>
                    <h5 class="fw-bold">Jam Operasional</h5>
                    <p class="mb-0 text-muted">Senin - Sabtu: 08.00 - 17.00 WIB</p>
                    <p class="text-muted">Minggu: Tutup</p>
                </div>
            </div>
        </div>
        
        <div class="col-md-6">
            <div class="card shadow-sm border-0 overflow-hidden rounded-4">
                <iframe 
                    src="https://maps.google.com/maps?q=Kp+kubang+buleud,+Sinagar,+Kec.+Sukaratu,+Kabupaten+Tasikmalaya,+Jawa+Barat+46415&t=&z=15&ie=UTF8&iwloc=&output=embed" 
                    width="100%" 
                    height="400" 
                    style="border:0;" 
                    allowfullscreen="" 
                    loading="lazy" 
                    referrerpolicy="no-referrer-when-downgrade">
                </iframe>
            </div>
        </div>

    </div>
</div>
@endsection