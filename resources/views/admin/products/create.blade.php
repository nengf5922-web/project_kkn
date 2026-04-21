@extends('layouts.admin')

@section('title', 'Tambah Produk')

@section('content')
    <h1>Tambah Produk Baru</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Nama Produk</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
        </div>

        <div class="mb-3">
            <label for="category_id" class="form-label">Kategori</label>
            <select class="form-select" id="category_id" name="category_id">
    <option value="" selected disabled>Pilih Kategori</option>

    @forelse($categories as $category)
        <option value="{{ $category->id }}">{{ $category->name }}</option>
    @empty
        <option value="" disabled>Tidak ada kategori (Buat dulu di menu Kategori)</option>
    @endforelse

</select>
            </select>
        </div>

        <div class="mb-3">
            <label for="price" class="form-label">Harga (cth: 50000)</label>
            <input type="number" class="form-control" id="price" name="price" value="{{ old('price') }}">
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Deskripsi</label>
            <textarea class="form-control" id="description" name="description" rows="3">{{ old('description') }}</textarea>
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Gambar Produk</label>
            <input class="form-control" type="file" id="image" name="image">
        </div>

        <div class="mb-3">
    <label class="form-label">Ukuran Tersedia</label>
    <input type="text" name="sizes" class="form-control" placeholder="Contoh: 36, 37, 38, 39, 40" value="{{ old('sizes') }}">
    <small class="text-muted">Pisahkan ukuran dengan koma.</small>
</div>
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">Batal</a>
    </form>
@endsection