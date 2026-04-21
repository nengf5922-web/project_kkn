@extends('layouts.admin')

@section('title', 'Edit Produk')

@section('content')
<div class="container-fluid px-4">
    
    <div class="d-flex align-items-center justify-content-between mb-4 mt-4">
        <h1 class="h3 fw-bold text-dark mb-0">Edit Produk</h1>
        <a href="{{ route('admin.products.index') }}" class="btn btn-outline-secondary rounded-pill px-3 btn-sm">
            <i class="bi bi-arrow-left me-1"></i> Kembali
        </a>
    </div>

    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body p-4">
            
            {{-- Form Update ke rute 'admin.products.update' --}}
            <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT') {{-- Wajib ada untuk proses update --}}

                <div class="row g-3">
                    
                    {{-- Nama Produk --}}
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Nama Produk</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name', $product->name) }}" required>
                    </div>

                    {{-- Kategori --}}
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Kategori</label>
                        <select name="category_id" class="form-select" required>
                            <option value="">-- Pilih Kategori --</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Harga --}}
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Harga (Rp)</label>
                        <input type="number" name="price" class="form-control" value="{{ old('price', $product->price) }}" required>
                    </div>

                    {{-- Gambar --}}
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Gambar Produk</label>
                        <input type="file" name="image" class="form-control">
                        <div class="form-text text-muted">Kosongkan jika tidak ingin mengubah gambar.</div>
                        
                        {{-- Preview Gambar Lama --}}
                        @if($product->image)
                            <div class="mt-2">
                                <img src="{{ asset('assets/products/' . $product->image) }}" 
                                     alt="Current Image" 
                                     class="img-thumbnail rounded-3" 
                                     style="height: 80px; width: 80px; object-fit: cover;">
                                <small class="d-block text-muted mt-1">Gambar saat ini</small>
                            </div>
                        @endif
                    </div>

                    {{-- Deskripsi --}}
                    <div class="col-12">
                        <label class="form-label fw-semibold">Deskripsi</label>
                        <textarea name="description" class="form-control" rows="4">{{ old('description', $product->description) }}</textarea>
                    </div>

                    {{-- Tombol Simpan --}}
                    <div class="col-12 mt-4 d-flex gap-2">
                        <button type="submit" class="btn btn-primary px-4 py-2 fw-bold">
                            <i class="bi bi-save me-1"></i> Simpan Perubahan
                        </button>
                    </div>

                </div>
            </form>

        </div>
    </div>
</div>
@endsection