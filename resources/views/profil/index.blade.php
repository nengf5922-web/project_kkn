@extends('layouts.admin')

@section('title', 'Pengaturan Akun')

@section('content')
<div class="container-fluid px-4">
    
    <div class="d-flex align-items-center justify-content-between mb-4 mt-4">
        <div>
            <h1 class="h3 fw-bold text-dark mb-0">Pengaturan Akun</h1>
            <p class="text-muted small">Kelola informasi profil dan keamanan akun Anda.</p>
        </div>
    </div>

    @if (session('status') === 'profile-updated')
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle me-2"></i> Profil berhasil diperbarui!
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row">
        
        <div class="col-lg-6 mb-4">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-header bg-white py-3 border-bottom-0">
                    <h6 class="mb-0 fw-bold text-primary"><i class="bi bi-person-lines-fill me-2"></i>Informasi Profil</h6>
                </div>
                <div class="card-body">
                    <form method="post" action="{{ route('profile.update') }}" class="mt-2">
                        @csrf
                        @method('patch')

                        <div class="mb-3">
                            <label class="form-label text-muted small fw-bold text-uppercase">Nama Lengkap</label>
                            <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name">
                            @error('name') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label text-muted small fw-bold text-uppercase">Email Address</label>
                            <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required autocomplete="username">
                            @error('email') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>

                        {{-- Input No HP (Jika ada di database) --}}
                        <div class="mb-4">
                            <label class="form-label text-muted small fw-bold text-uppercase">Nomor WhatsApp / HP</label>
                            <input type="text" name="phone" class="form-control" value="{{ old('phone', $user->phone ?? '') }}" placeholder="08xxxxxxxx">
                            @error('phone') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>

                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary px-4 fw-bold rounded-pill">
                                <i class="bi bi-save me-2"></i> Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-6 mb-4">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-header bg-white py-3 border-bottom-0">
                    <h6 class="mb-0 fw-bold text-danger"><i class="bi bi-shield-lock-fill me-2"></i>Keamanan Akun</h6>
                </div>
                <div class="card-body">
                    <p class="text-muted small mb-3">Pastikan menggunakan password yang panjang dan acak agar tetap aman.</p>

                    <form method="post" action="{{ route('password.update') }}">
                        @csrf
                        @method('put')

                        <div class="mb-3">
                            <label class="form-label text-muted small fw-bold text-uppercase">Password Saat Ini</label>
                            <input type="password" name="current_password" class="form-control" autocomplete="current-password">
                            @error('current_password', 'updatePassword') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label text-muted small fw-bold text-uppercase">Password Baru</label>
                            <input type="password" name="password" class="form-control" autocomplete="new-password">
                            @error('password', 'updatePassword') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>

                        <div class="mb-4">
                            <label class="form-label text-muted small fw-bold text-uppercase">Konfirmasi Password Baru</label>
                            <input type="password" name="password_confirmation" class="form-control" autocomplete="new-password">
                            @error('password_confirmation', 'updatePassword') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>

                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-danger px-4 fw-bold rounded-pill">
                                <i class="bi bi-key-fill me-2"></i> Update Password
                            </button>
                        </div>

                        @if (session('status') === 'password-updated')
                            <div class="alert alert-success mt-3 py-2 small">
                                <i class="bi bi-check-circle me-1"></i> Password berhasil diubah.
                            </div>
                        @endif
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection