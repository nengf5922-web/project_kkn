@extends('layouts.main')

@section('content')

<div class="container py-5">
    <h4 class="fw-bold mb-4">Keranjang Saya</h4>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="row">
        <div class="col-lg-8">
            <div class="cart-table bg-white p-4 rounded shadow-sm">
                @if(session('cart') && count(session('cart')) > 0)
                    <table class="table align-middle">
                        <thead>
                            <tr>
                                <th style="width: 40%">Produk</th>
                                <th style="width: 20%">Harga</th>
                                <th style="width: 20%">Jumlah</th>
                                <th style="width: 20%" class="text-end">Subtotal</th>
                                <th style="width: 10%"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $total = 0; @endphp
                            @foreach(session('cart') as $id => $details)
                                @php $total += $details['price'] * $details['quantity']; @endphp
                                <tr data-id="{{ $id }}">
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="{{ isset($details['image']) ? asset('assets/products/' . $details['image']) : 'https://placehold.co/100' }}" class="img-fluid rounded me-3" style="width: 70px; height: 70px; object-fit: cover;">
                                            <h6 class="fw-bold mb-0 text-dark">{{ $details['name'] }}</h6>
                                        </div>
                                    </td>
                                    <td>Rp {{ number_format($details['price'], 0, ',', '.') }}</td>
                                    <td>
                                        <input type="number" value="{{ $details['quantity'] }}" class="form-control quantity update-cart" min="1" style="width: 80px;">
                                    </td>
                                    <td class="text-end fw-bold">Rp {{ number_format($details['price'] * $details['quantity'], 0, ',', '.') }}</td>
                                    <td class="text-end">
                                        <form action="{{ route('keranjang.remove') }}" method="POST">
                                            @csrf @method('DELETE')
                                            <input type="hidden" name="id" value="{{ $id }}">
                                            <button type="submit" class="btn btn-sm text-danger border-0 bg-transparent"><i class="bi bi-trash fs-5"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="text-center py-5">
                        <i class="bi bi-cart-x fs-1 text-muted"></i>
                        <h5 class="mt-3">Keranjang Anda kosong</h5>
                        <a href="{{ route('home') }}" class="btn btn-primary mt-3">Belanja Sekarang</a>
                    </div>
                @endif
            </div>
        </div>

        <div class="col-lg-4 mt-4 mt-lg-0">
            <div class="cart-summary bg-white p-4 rounded shadow-sm">
                <h5 class="fw-bold mb-3">Ringkasan Pesanan</h5>
                <div class="d-flex justify-content-between mb-3">
                    <span class="text-muted">Total Belanja</span>
                    <span class="fw-bold fs-5">Rp {{ number_format($total ?? 0, 0, ',', '.') }}</span>
                </div>
                <hr>
                <a href="{{ route('checkout.index') }}" class="btn btn-primary w-100 py-2 fw-bold text-decoration-none {{ (empty(session('cart'))) ? 'disabled' : '' }}">Lanjut ke Checkout</a>
                <a href="{{ route('home') }}" class="btn btn-outline-secondary w-100 mt-2 py-2">Lanjut Belanja</a>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="text/javascript">
    $(".update-cart").change(function (e) {
        e.preventDefault();
        var ele = $(this);
        $.ajax({
            url: '{{ route('keranjang.update') }}',
            method: "PATCH",
            data: {
                _token: '{{ csrf_token() }}', 
                id: ele.parents("tr").attr("data-id"), 
                quantity: ele.val()
            },
            success: function (response) {
                window.location.reload();
            }
        });
    });
</script>
@endsection