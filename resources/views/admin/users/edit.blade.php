@extends('layouts.admin')

@section('content')
<div class="container-fluid p-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-dark">Edit Pengguna</h2>
        <a href="{{ route('admin.users.index') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body p-4">
            
            <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
                @csrf
                @method('PUT') {{-- Wajib untuk Update --}}

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Nama Lengkap</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Email Address</label>
                        <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Nomor Telepon</label>
                        <input type="text" name="phone" class="form-control" value="{{ old('phone', $user->phone) }}">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Role / Peran</label>
                        <select name="role" class="form-select">
                            <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>User (Pelanggan)</option>
                            <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin (Pengelola)</option>
                        </select>
                    </div>

                    <div class="col-md-12 mb-4">
                        <label class="form-label fw-bold">Password Baru <small class="text-muted fw-normal">(Kosongkan jika tidak ingin mengganti)</small></label>
                        <input type="password" name="password" class="form-control" placeholder="Masukkan password baru...">
                    </div>
                </div>

                <div class="d-flex justify-content-end gap-2">
                    <button type="reset" class="btn btn-light">Reset</button>
                    <button type="submit" class="btn btn-primary px-4">Simpan Perubahan</button>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection