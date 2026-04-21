@extends('layouts.admin')

@section('title', 'Daftar Produk')

@section('content')
    <div class="container-fluid px-4">

        <div class="d-flex align-items-center gap-3 mb-4 mt-4">
            <h1 class="h3 fw-bold text-dark mb-0">Daftar Produk</h1>

            <a href="{{ route('admin.products.create') }}" class="btn btn-primary rounded-pill px-3 btn-sm">
                <i class="bi bi-plus-lg me-1"></i> Tambah Baru
            </a>
        </div>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show rounded-4 mb-4" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-body p-0"> 
                <div class="row">
                    <div class="col-10"> {{-- Gunakan col-12 agar tabel penuh --}}
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0" style="min-width: 600px;">
                                <thead class="bg-light">
                                    <tr>
                                        <th scope="col" class="ps-4 py-3">Gambar</th>
                                        <th scope="col" class="py-3">Nama Produk</th>
                                        <th scope="col" class="py-3">Kategori</th>
                                        <th scope="col" class="py-3">Harga</th>
                                        <th scope="col" class="text-end pe-4 py-3">Aksi</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @forelse($products as $product)
                                        <tr>
                                            <td class="ps-4">
                                                @if ($product->image)
                                                    {{-- PERBAIKAN DI SINI: Gunakan 'assets/products/' --}}
                                                    <img src="{{ asset('assets/products/' . $product->image) }}"
                                                        class="rounded-3 border"
                                                        style="width: 40px; height: 40px; object-fit: cover;">
                                                @else
                                                    <div class="bg-secondary bg-opacity-10 rounded-3 d-flex align-items-center justify-content-center text-secondary"
                                                        style="width: 40px; height: 40px;">
                                                        <i class="bi bi-image"></i>
                                                    </div>
                                                @endif
                                            </td>
                                            <td class="fw-semibold text-dark">{{ $product->name }}</td>
                                            <td>
                                                <span class="badge bg-light text-dark border rounded-pill px-2">
                                                    {{ $product->category->name ?? '-' }}
                                                </span>
                                            </td>
                                            <td class="fw-bold text-primary">
                                                Rp {{ number_format($product->price, 0, ',', '.') }}
                                            </td>
                                            <td class="text-end pe-4">
                                                <div class="d-flex justify-content-end gap-1">
                                                    <a href="{{ route('admin.products.edit', $product->id) }}"
                                                        class="btn btn-sm btn-warning text-white py-1 px-2">
                                                        <i class="bi bi-pencil-square"></i>
                                                    </a>
                                                    <form action="{{ route('admin.products.destroy', $product->id) }}"
                                                        method="POST" onsubmit="return confirm('Hapus produk ini?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger py-1 px-2">
                                                            <i class="bi bi-trash"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center py-5 text-muted">
                                                <div class="mb-2"><i class="bi bi-box-seam fs-1 opacity-50"></i></div>
                                                Belum ada produk tersedia.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection