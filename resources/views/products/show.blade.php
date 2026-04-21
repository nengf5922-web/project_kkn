@extends('layouts.main')

@section('content')
<div class="container py-5" style="margin-top: 50px;">
    
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-decoration-none text-muted">Home</a></li>
            <li class="breadcrumb-item active text-dark fw-bold">{{ $product->name }}</li>
        </ol>
    </nav>

    <div class="row g-5">
        <div class="col-md-6">
            <div class="bg-light rounded overflow-hidden border position-relative" style="padding-top: 100%;">
                @if($product->image)
                    <img src="{{ asset('assets/products/' . $product->image) }}" class="position-absolute top-0 start-0 w-100 h-100" style="object-fit: cover;" alt="{{ $product->name }}">
                @else
                    <img src="https://via.placeholder.com/600" class="position-absolute top-0 start-0 w-100 h-100" style="object-fit: cover;">
                @endif
            </div>
        </div>

        <div class="col-md-6">
            <div class="ps-lg-3">
                <h1 class="fw-bold text-dark mb-2">{{ $product->name }}</h1>
                
                <h3 class="text-danger fw-bold mb-4">
                    Rp {{ number_format($product->price, 0, ',', '.') }}
                </h3>

                <hr class="opacity-25 my-4">

                <form action="{{ route('keranjang.add') }}" method="POST">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">

                    <div class="mb-4">
                        <label class="fw-bold d-block mb-2 text-uppercase small text-muted">Pilih Ukuran</label>
                        <div class="d-flex flex-wrap gap-2">
                            {{-- Cek kolom 'sizes' atau 'ukuran' --}}
                            @php 
                                $sizes = $product->sizes ?? $product->ukuran ?? '37,38,39,40'; 
                            @endphp
                            
                            @foreach(explode(',', $sizes) as $size)
                                <input type="radio" class="btn-check" name="size" id="size-{{ trim($size) }}" value="{{ trim($size) }}" required>
                                <label class="btn btn-outline-dark px-4 py-2" for="size-{{ trim($size) }}">
                                    {{ trim($size) }}
                                </label>
                            @endforeach
                        </div>
                    </div>

                   <div class="mb-5">
    <label class="fw-bold d-block mb-2 text-uppercase small text-muted">Deskripsi</label>
    <div class="text-muted" style="line-height: 1.6;">
        
        {{-- Menggunakan {!! !!} agar jika ada Enter (baris baru) tetap terbaca --}}
        {!! nl2br(e($product->description)) !!}

        {{-- JIKA MASIH KOSONG, TAMPILKAN PESAN DEBUG INI --}}
        @if(empty($product->description))
            <div class="alert alert-warning mt-2 small">
                Data deskripsi kosong. Silakan edit produk ini di Admin dan isi kolom 'Description'.
            </div>
        @endif
        
    </div>
</div>

                    <div class="d-flex gap-3 mt-4">
                        <button type="submit" name="action" value="cart" class="btn btn-outline-dark flex-grow-1 py-3 fw-bold">
                            <i class="bi bi-cart-plus me-2"></i> + Keranjang
                        </button>
                        <button type="submit" name="action" value="buy_now" class="btn btn-dark flex-grow-1 py-3 fw-bold">
                            Beli Sekarang
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

<style>
    .btn-check:checked + .btn-outline-dark {
        background-color: #000;
        color: #fff;
    }
</style>
@endsection