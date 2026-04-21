@extends('layouts.main') {{-- Sesuaikan dengan layout utama Anda --}}

@section('content')
<div class="container py-5">
    <div class="row align-items-center">
        
        <div class="col-md-6 d-none d-md-block">
            <img src="{{ asset('assets/products/regis.jpg') }}" alt="Register" class="img-fluid rounded-3 shadow-sm">
        </div>

        <div class="col-md-6">
            <div class="card border-0">
                <div class="card-body p-4">
                    <h2 class="fw-bold text-dark mb-2">Create Account</h2>
                    <p class="text-muted mb-4">Lengkapi data diri Anda untuk memulai pengalaman belanja yang lebih baik.</p>

                    <form action="{{ url('/register') }}" method="POST">
                        @csrf
                        
                        <div class="mb-3">
                            <input type="text" name="name" class="form-control py-3 @error('name') is-invalid @enderror" 
                                   placeholder="Nama Lengkap" value="{{ old('name') }}" required>
                            @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-3">
                            <input type="email" name="email" class="form-control py-3 @error('email') is-invalid @enderror" 
                                   placeholder="Alamat Email" value="{{ old('email') }}" required>
                            @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-3">
                            <input type="number" name="phone" class="form-control py-3 @error('phone') is-invalid @enderror" 
                                   placeholder="Nomor Telepon" value="{{ old('phone') }}" required>
                            @error('phone') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-3">
                            <textarea name="address" class="form-control py-3 @error('address') is-invalid @enderror" 
                                      placeholder="Alamat Lengkap" rows="3" required>{{ old('address') }}</textarea>
                            @error('address') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <input type="password" name="password" class="form-control py-3 @error('password') is-invalid @enderror" 
                                       placeholder="Password" required>
                                @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <input type="password" name="password_confirmation" class="form-control py-3" 
                                       placeholder="Ulangi Password" required>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-dark w-100 py-3 fw-bold mt-2">Daftar Sekarang</button>
                        
                        <p class="text-center mt-3 small">
                            Sudah punya akun? <a href="{{ route('login') }}" class="text-decoration-none fw-bold">Login disini</a>
                        </p>
                    </form>
                    </div>
            </div>
        </div>
    </div>
</div>
@endsection