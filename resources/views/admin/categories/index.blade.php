@extends('layouts.admin')

@section('title', 'Categories')

@section('content')
<div class="container-fluid px-4">

    {{-- Header & Tombol --}}
    <div class="d-flex align-items-center gap-3 mb-4 mt-4">
        <h1 class="h3 fw-bold text-dark mb-0">Daftar Kategori</h1>
        <a href="{{ route('admin.categories.create') }}" class="btn btn-primary rounded-pill px-4 shadow-sm">
            <i class="bi bi-plus-lg me-2"></i> Tambah Kategori
        </a>
    </div>

    <div class="row">
        <div class="col-10">
            
            <div class="card border-0 shadow-sm rounded-4 w-100">
                <div class="card-body p-3">
                    <div class="table-responsive">
                        <table class="table table-hover table-sm align-middle mb-0 w-100">
                            <thead class="bg-light text-secondary">
                                <tr>
                                    {{-- TRIK: width 1% + nowrap memaksa kolom mengecil sesuai konten --}}
                                    <th class="ps-3 py-2 small fw-bold text-center" style="width: 1%; white-space: nowrap;">#</th>
                                    
                                    {{-- Kolom UTAMA tidak diberi width agar mengisi sisa ruang --}}
                                    <th class="py-2 small fw-bold" >Nama Kategori</th>
                                    
                                    <th class="py-2 small fw-bold" >Slug</th>
                                    
                                    {{-- Kolom AKSI juga dipaksa mengecil --}}
                                    <th class="pe-3 py-2 text-end small fw-bold" style="width: 1%; white-space: nowrap;">Aksi</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse($categories as $category)
                                    <tr>
                                        <td class="ps-3 fw-bold text-center">{{ $loop->iteration }}</td>
                                        
                                        <td><span class="fw-semibold text-dark">{{ $category->name }}</span></td>
                                        
                                        <td>
                                            <span class="badge rounded-pill text-truncate slug-badge text-dark"
                                                  title="{{ $category->slug }}"
                                                  style="max-width: 200px; display: inline-block; vertical-align: middle;">
                                                {{ $category->slug }}
                                            </span>
                                        </td>
                                        
                                        <td class="pe-3 text-end" style="white-space: nowrap;">
                                            <div class="btn-group shadow-sm">
                                                <a href="{{ route('admin.categories.edit', $category->id) }}"
                                                   class="btn btn-sm btn-light text-primary border-end"
                                                   data-bs-toggle="tooltip" title="Edit">
                                                    <i class="bi bi-pencil-square"></i>
                                                </a>
                                                <form action="{{ route('admin.categories.destroy', $category->id) }}"
                                                      method="POST" class="d-inline"
                                                      onsubmit="return confirm('Hapus kategori ini?');">
                                                    @csrf @method('DELETE')
                                                    <button type="submit"
                                                            class="btn btn-sm btn-light text-danger"
                                                            data-bs-toggle="tooltip" title="Hapus">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center py-5">
                                            <div class="opacity-50">
                                                <i class="bi bi-folder-x fs-1 mb-2"></i>
                                                <p class="mb-0">Belum ada kategori ditemukan.</p>
                                            </div>
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