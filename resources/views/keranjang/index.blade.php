@extends('layouts.main')

@section('content')
<div class="container py-5" style="margin-top: 60px;">
    
    <h2 class="fw-bold mb-4">Keranjang Belanja</h2>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row">
       <div class="col-lg-8">
    {{-- PERBAIKAN DI SINI: Gunakan $cart --}}
    @if(isset($cart) && count($cart) > 0)
        <div class="card border-0 shadow-sm">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th scope="col" class="py-3 ps-4">Produk</th>
                                <th scope="col" class="py-3">Harga</th>
                                <th scope="col" class="py-3">Jumlah</th>
                                <th scope="col" class="py-3">Subtotal</th>
                                <th scope="col" class="py-3 text-end pe-4">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- PERBAIKAN DI SINI: Gunakan $cart --}}
                            @foreach($cart as $key => $details)
                                <tr>
                                    <td class="ps-4">
                                        <div class="d-flex align-items-center">
                                            <div style="width: 60px; height: 60px;" class="rounded overflow-hidden bg-light me-3 border">
                                                @if($details['image'])
                                                    <img src="{{ asset('assets/products/' . $details['image']) }}" class="w-100 h-100 object-fit-cover">
                                                @else
                                                    <img src="https://via.placeholder.com/60" class="w-100 h-100 object-fit-cover">
                                                @endif
                                            </div>
                                            <div>
                                                <h6 class="mb-0 text-dark fw-bold">{{ $details['name'] }}</h6>
                                                <small class="text-muted">Size: {{ $details['size'] }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>Rp {{ number_format($details['price'], 0, ',', '.') }}</td>
                                    <td>
                                        <span class="badge bg-light text-dark border px-3 py-2">
                                            {{ $details['quantity'] }}
                                        </span>
                                    </td>
                                    <td class="fw-bold">
                                        Rp {{ number_format($details['price'] * $details['quantity'], 0, ',', '.') }}
                                    </td>
                                    <td class="text-end pe-4">
                                        <form action="{{ route('keranjang.remove') }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <input type="hidden" name="id" value="{{ $key }}">
                                            <button type="submit" class="btn btn-sm btn-outline-danger border-0">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @else
        <div class="text-center py-5 border rounded bg-light">
            <i class="bi bi-cart-x display-1 text-muted mb-3"></i>
            <h4>Keranjang Kosong</h4>
            <p class="text-muted">Belum ada barang yang Anda pilih.</p>
            <a href="{{ route('home') }}" class="btn btn-dark mt-3">Mulai Belanja</a>
        </div>
    @endif
</div>
        <div class="col-lg-4 mt-4 mt-lg-0">
            <div class="card border-0 shadow-sm bg-light">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-4">Ringkasan Pesanan</h5>
                    
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">Total Item</span>
                        <span>{{ count(session('cart', [])) }} Barang</span>
                    </div>
                    <div class="d-flex justify-content-between mb-4">
                        <span class="text-muted">Total Harga</span>
                        <span class="fw-bold fs-5">Rp {{ number_format($total ?? 0, 0, ',', '.') }}</span>
                    </div>

                    <hr class="mb-4">

                    @if(session('cart') && count(session('cart')) > 0)
                        @auth
                            <a href="{{ route('checkout.index') }}" class="btn btn-dark w-100 py-3 fw-bold mb-2">Checkout Sekarang</a>
                        @else
                            <a href="{{ route('login') }}" class="btn btn-dark w-100 py-3 fw-bold mb-2">Login untuk Checkout</a>
                        @endauth
                    @else
                        <button class="btn btn-secondary w-100 py-3 fw-bold" disabled>Checkout Sekarang</button>
                    @endif
                    
                    <a href="{{ route('home') }}" class="btn btn-outline-dark w-100 py-3 mt-2">Lanjut Belanja</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection