@extends('layouts.main')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="fw-bold">Semua Kategori</h4>
</div>

<div class="row">

<div class="col-6 col-md-4 col-lg-3 mb-4">
    <div class="card category-card h-100">
        <img src="..." class="card-img-top" alt="Flatshoes">
        <div class="card-body p-0 pt-2">
            <h6 class="card-title fw-bold mb-0">Flatshoes</h6>
        </div>
    </div>
</div>

<div class="col-6 col-md-4 col-lg-3 mb-4">
    <a href="{{ route('kategori.show', 'flatshoes') }}" class="text-decoration-none">
        <div class="card category-card h-100">
            <img src="https://placehold.co/300x200/ff6600/white?text=Flatshoes" class="card-img-top" alt="Flatshoes">
            <div class="card-body p-0 pt-2">
                <h6 class="card-title fw-bold mb-0 text-dark">Flatshoes</h6>
            </div>
        </div>
    </a>
</div>

<div class="col-6 col-md-4 col-lg-3 mb-4">
    <a href="{{ route('kategori.show', 'heels') }}" class="text-decoration-none">
        <div class="card category-card h-100">
            <img src="https://placehold.co/300x200/ff6600/white?text=Heels" class="card-img-top" alt="Heels">
            <div class="card-body p-0 pt-2">
                <h6 class="card-title fw-bold mb-0 text-dark">Heels</h6>
            </div>
        </div>
    </a>
</div>

<div class="col-6 col-md-4 col-lg-3 mb-4">
    <a href="{{ route('kategori.show', 'wedding-heels') }}" class="text-decoration-none">
        <div class="card category-card h-100">
            <img src="https://placehold.co/300x200/ff6600/white?text=Wedding+Heels" class="card-img-top" alt="Wedding Heels">
            <div class="card-body p-0 pt-2">
                <h6 class="card-title fw-bold mb-0 text-dark">Wedding Heels</h6>
            </div>
        </div>
    </a>
</div>
</div>

@endsection