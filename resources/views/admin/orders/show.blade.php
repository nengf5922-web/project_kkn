@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    
    <a href="{{ route('admin.orders.index') }}" class="btn btn-outline-dark mb-4 btn-sm rounded-pill px-3">
        <i class="bi bi-arrow-left"></i> Kembali
    </a>

    <div class="row">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm rounded-4 mb-4">
                <div class="card-header bg-white py-3">
                    <h6 class="mb-0 fw-bold">Item Pesanan #{{ $order->id }}</h6>
                </div>
                <div class="card-body p-0">
                    <table class="table align-middle mb-0">
                        <thead class="bg-light text-muted small">
                            <tr>
                                <th class="ps-4">Produk</th>
                                <th>Harga</th>
                                <th class="text-center">Qty</th>
                                <th class="text-end pe-4">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($order->orderItems as $item)
                            <tr>
                                <td class="ps-4">
                                    <div class="d-flex align-items-center">
                                        @if($item->product->image)
                                            <img src="{{ asset('assets/products/' . $item->product->image) }}" width="40" height="40" class="rounded object-fit-cover me-3">
                                        @endif
                                        <span class="fw-bold text-dark">{{ $item->product->name }}</span>
                                    </div>
                                </td>
                                <td>Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                                <td class="text-center">{{ $item->quantity }}</td>
                                <td class="text-end pe-4 fw-bold">Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot class="bg-light">
                            <tr>
                                <td colspan="3" class="text-end fw-bold py-3">TOTAL BAYAR</td>
                                <td class="text-end fw-bold py-3 pe-4 text-primary fs-5">
                                    Rp {{ number_format($order->total_price, 0, ',', '.') }}
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            
            <div class="card border-0 shadow-sm rounded-4 mb-4">
                <div class="card-body">
                    <h6 class="fw-bold mb-3">Info Pembeli</h6>
                    <div class="d-flex align-items-center mb-3">
                        <div class="bg-light rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 45px; height: 45px;">
                            <i class="bi bi-person-fill text-secondary fs-5"></i>
                        </div>
                        <div>
                            <div class="fw-bold text-dark">{{ $order->user->name }}</div>
                            <div class="text-muted small">{{ $order->user->email }}</div>
                        </div>
                    </div>
                    
                    <hr class="border-dashed my-3">
                    
                    <div class="small">
                        <div class="mb-2">
                            <i class="bi bi-whatsapp text-success me-2"></i> 
                            {{ $order->user->phone ?? 'Tidak ada no HP' }}
                        </div>
                        <div>
                            <i class="bi bi-geo-alt-fill text-danger me-2"></i> 
                            {{ $order->address ?? 'Alamat tidak diisi' }}
                        </div>
                    </div>
                </div>
            </div>

            <div class="card border-0 shadow-sm rounded-4 bg-primary bg-opacity-10">
                <div class="card-body">
                    <h6 class="fw-bold mb-3 text-primary">Update Status Pesanan</h6>
                    
                    <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST">
                        @csrf
                        @method('PATCH')

                        <div class="mb-3">
                            <label class="form-label small text-muted fw-bold">Pilih Status Baru:</label>
                            <select name="status" class="form-select border-primary">
                                <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending (Menunggu)</option>
                                <option value="paid" {{ $order->status == 'paid' ? 'selected' : '' }}>Paid (Sudah Dibayar)</option>
                                <option value="shipped" {{ $order->status == 'shipped' ? 'selected' : '' }}>Shipped (Dikirim)</option>
                                <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Completed (Selesai)</option>
                                <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Cancelled (Batal)</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary w-100 fw-bold">
                            <i class="bi bi-whatsapp me-2"></i> Update & Kirim WA
                        </button>
                        <small class="d-block text-center mt-2 text-muted" style="font-size: 0.75rem">
                            *Otomatis membuka WhatsApp Web ke nomor pembeli
                        </small>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection