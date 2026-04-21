@extends('layouts.admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold text-dark">Kelola Pesanan</h2>
</div>

<div class="card border-0 shadow-sm rounded-4">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light">
                    <tr>
                        <th class="ps-4 py-3">Order ID</th>
                        <th>Pelanggan</th>
                        <th>Total Harga</th>
                        <th>Status</th>
                        <th>Tanggal</th>
                        <th class="text-end pe-4">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($orders as $order)
                    <tr>
                        <td class="ps-4 fw-bold">#{{ $order->id }}</td>
                        <td>
                            <div class="fw-bold">{{ $order->user->name }}</div>
                            <small class="text-muted">{{ $order->user->phone ?? '-' }}</small>
                        </td>
                        <td class="fw-bold text-primary">Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
                        <td>
                            @if($order->status == 'pending')
                                <span class="badge bg-warning text-dark">Pending</span>
                            @elseif($order->status == 'paid')
                                <span class="badge bg-info text-dark">Sudah Dibayar</span>
                            @elseif($order->status == 'shipped')
                                <span class="badge bg-primary">Dikirim</span>
                            @elseif($order->status == 'completed')
                                <span class="badge bg-success">Selesai</span>
                            @else
                                <span class="badge bg-danger">Dibatalkan</span>
                            @endif
                        </td>
                        <td>{{ $order->created_at->format('d M Y') }}</td>
                        <td class="text-end pe-4">
                            <a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-sm btn-light border">
                                <i class="bi bi-eye"></i> Detail
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-5 text-muted">Belum ada pesanan masuk.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection