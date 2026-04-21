@extends('layouts.admin')

@section('title', 'Manajemen Pengguna')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold text-dark mb-1">Daftar Pengguna</h2>
            <p class="text-muted mb-0">Kelola data pengguna dan hak akses (role).</p>
        </div>

        <div class="bg-white px-4 py-2 rounded-pill shadow-sm border">
            <i class="bi bi-people-fill text-primary me-2"></i>
            <span class="fw-bold text-dark">{{ $users->count() }}</span> <span class="text-muted small">User Terdaftar</span>
        </div>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm" role="alert">
            <i class="bi bi-exclamation-triangle-fill me-2"></i> {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card border-0 shadow-sm" style="border-radius: 12px; overflow: hidden;">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0" style="min-width: 800px;">
                    <thead class="bg-light">
                        <tr>
                            <th class="py-3 ps-4 text-uppercase text-muted small fw-bold" style="width: 5%;">#</th>
                            <th class="py-3 text-uppercase text-muted small fw-bold" style="width: 25%;">User Info</th>
                            <th class="py-3 text-uppercase text-muted small fw-bold" style="width: 20%;">Kontak</th>
                            <th class="py-3 text-uppercase text-muted small fw-bold" style="width: 15%;">Role</th>
                            <th class="py-3 text-uppercase text-muted small fw-bold" style="width: 20%;">Bergabung</th>
                            <th class="py-3 pe-4 text-end text-uppercase text-muted small fw-bold" style="width: 15%;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- TAMBAHAN: Loop foreach untuk menampilkan setiap user --}}
                        @forelse ($users as $index => $user)
                            <tr>
                                <td class="ps-4 fw-bold text-muted">{{ $loop->iteration }}</td>
                                
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="bg-light rounded-circle d-flex align-items-center justify-content-center text-primary fw-bold me-3" 
                                             style="width: 40px; height: 40px; font-size: 1.2rem;">
                                            {{ substr($user->name, 0, 1) }}
                                        </div>
                                        <div>
                                            <div class="fw-bold text-dark">{{ $user->name }}</div>
                                            <div class="text-muted small">{{ $user->email }}</div>
                                        </div>
                                    </div>
                                </td>

                                <td>
                                    @if ($user->phone)
                                        <div class="text-dark small">
                                            <i class="bi bi-telephone me-1 text-muted"></i> {{ $user->phone }}
                                        </div>
                                    @else
                                        <span class="text-muted small fst-italic">-</span>
                                    @endif
                                </td>

                                <td>
                                    @if ($user->role == 'admin')
                                        <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2 rounded-pill fw-bold border border-primary border-opacity-25">
                                            <i class="bi bi-shield-lock-fill me-1"></i> Admin
                                        </span>
                                    @else
                                        <span class="badge bg-secondary bg-opacity-10 text-secondary px-3 py-2 rounded-pill fw-bold border border-secondary border-opacity-25">
                                            <i class="bi bi-person-fill me-1"></i> User
                                        </span>
                                    @endif
                                </td>

                                <td>
                                    <div class="text-muted small">
                                        <i class="bi bi-calendar3 me-1"></i> {{ $user->created_at->format('d M Y') }}
                                    </div>
                                </td>

                                <td class="pe-4 text-end">
                                    <div class="d-flex justify-content-end gap-2">
                                        <a href="{{ route('admin.users.edit', $user->id) }}" 
                                           class="btn btn-sm btn-outline-warning d-flex align-items-center" 
                                           title="Edit User">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>

                                        <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="btn btn-sm btn-outline-danger d-flex align-items-center" 
                                                    title="Hapus User"
                                                    @if(auth()->id() == $user->id) disabled style="opacity: 0.5; cursor: not-allowed;" @endif
                                                    onclick="return confirm('Apakah Anda yakin ingin menghapus pengguna ini? Data tidak bisa dikembalikan.')">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            {{-- Tampilan jika data kosong --}}
                            <tr>
                                <td colspan="6" class="text-center py-5">
                                    <div class="mb-3 text-muted opacity-50">
                                        <i class="bi bi-people display-1"></i>
                                    </div>
                                    <h5 class="text-muted">Belum ada pengguna terdaftar.</h5>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection