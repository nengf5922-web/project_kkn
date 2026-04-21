{{-- LOGIKA PEMILIHAN LAYOUT OTOMATIS --}}
@extends(Auth::user()->role === 'admin' ? 'layouts.admin' : 'layouts.main')

@section('title', 'Pengaturan Akun')

@section('content')
{{-- Jarak tambahan jika User Biasa agar tidak tertutup Navbar --}}
<div class="{{ Auth::user()->role === 'admin' ? 'container-fluid px-4' : 'container py-5' }}" style="{{ Auth::user()->role !== 'admin' ? 'margin-top: 60px;' : '' }}">

    <div class="d-flex align-items-center justify-content-between mb-4 mt-4">
        <div>
            <h1 class="h3 fw-bold text-dark mb-0">Pengaturan Akun</h1>
            <p class="text-muted small">Kelola informasi profil, alamat, dan keamanan akun Anda.</p>
        </div>
    </div>

    @if (session('status') === 'profile-updated')
        <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
            <i class="bi bi-check-circle me-2"></i> Profil berhasil diperbarui!
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row">
        
        <div class="col-lg-6 mb-4">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-header bg-white py-3 border-bottom-0">
                    <h6 class="mb-0 fw-bold text-primary"><i class="bi bi-person-lines-fill me-2"></i>Informasi Pribadi</h6>
                </div>
                <div class="card-body">
                    <form method="post" action="{{ route('profile.update') }}">
                        @csrf
                        @method('patch')

                        <div class="mb-3">
                            <label class="form-label text-muted small fw-bold text-uppercase">Nama Lengkap</label>
                            <input type="text" name="name" class="form-control bg-light" value="{{ old('name', $user->name) }}" required>
                            @error('name') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label text-muted small fw-bold text-uppercase">Email Address</label>
                            <input type="email" name="email" class="form-control bg-light" value="{{ old('email', $user->email) }}" required>
                            @error('email') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label text-muted small fw-bold text-uppercase">Nomor WhatsApp / HP</label>
                            <input type="number" name="phone" class="form-control bg-light" value="{{ old('phone', $user->phone ?? '') }}" placeholder="08xxxxxxxx">
                            @error('phone') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>

                        {{-- KOLOM ALAMAT (Penting untuk User) --}}
                        <div class="mb-4">
                            <label class="form-label text-muted small fw-bold text-uppercase">Alamat Lengkap</label>
                            <textarea name="address" class="form-control bg-light" rows="3" placeholder="Masukkan alamat lengkap pengiriman...">{{ old('address', $user->address ?? '') }}</textarea>
                            @error('address') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>

                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary px-4 fw-bold rounded-pill shadow-sm">
                                <i class="bi bi-save me-2"></i> Simpan Profil
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
                    <div class="alert alert-light border-0 small text-muted mb-4">
                        <i class="bi bi-info-circle me-1"></i> Gunakan password minimal 8 karakter untuk keamanan maksimal.
                    </div>

                    <form method="post" action="{{ route('password.update') }}">
                        @csrf
                        @method('put')

                        <div class="mb-3">
                            <label class="form-label text-muted small fw-bold text-uppercase">Password Saat Ini</label>
                            <input type="password" name="current_password" class="form-control bg-light" autocomplete="current-password">
                            @error('current_password', 'updatePassword') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label text-muted small fw-bold text-uppercase">Password Baru</label>
                            <input type="password" name="password" class="form-control bg-light" autocomplete="new-password">
                            @error('password', 'updatePassword') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>

                        <div class="mb-4">
                            <label class="form-label text-muted small fw-bold text-uppercase">Konfirmasi Password Baru</label>
                            <input type="password" name="password_confirmation" class="form-control bg-light" autocomplete="new-password">
                            @error('password_confirmation', 'updatePassword') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>

                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-danger px-4 fw-bold rounded-pill shadow-sm">
                                <i class="bi bi-key-fill me-2"></i> Update Password
                            </button>
                        </div>

                        @if (session('status') === 'password-updated')
                            <div class="alert alert-success mt-3 py-2 small rounded-3">
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