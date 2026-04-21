@extends('layouts.admin')

@section('title', 'Tambah Kategori')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">Tambah Kategori Baru</h1>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            
            <form action="{{ route('admin.categories.store') }}" method="POST">
                @csrf
                
                <div class="mb-3">
                    <label for="name" class="form-label fw-bold">Nama Kategori</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Contoh: Sepatu Lari" required>
                    <div class="form-text">Nama kategori akan otomatis dibuatkan slug-nya.</div>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary px-4">Simpan</button>
                    <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary px-4">Batal</a>
                </div>
            </form>

        </div>
    </div>
@endsection