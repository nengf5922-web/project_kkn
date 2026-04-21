@extends('layouts.main')

@section('content')

<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="fw-bold">{{ $category->name ?? 'Kategori' }}</h4>
    </div>

    <div class="row">
        @forelse($products as $product)
            <div class="col-6 col-md-4 col-lg-3 mb-4">
                <div class="card product-card h-100 border-0 rounded-3">
                    <a href="{{ route('products.show', $product->slug) }}" class="text-decoration-none">
                        <div class="product-img-wrapper rounded-top-3">
                            @if($product->image)
                                <img src="{{ asset('assets/products/' . $product->image) }}" alt="{{ $product->name }}">
                            @else
                                <img src="https://placehold.co/300x400?text={{ $product->name }}" alt="No Image">
                            @endif
                        </div>

                        <div class="card-body p-3">
                            <h6 class="card-title fw-bold text-dark mb-1">{{ $product->name }}</h6>
                            <div class="product-card-price price-tag">Rp {{ number_format($product->price, 0, ',', '.') }}</div>
                        </div>
                    </a>
                </div>
            </div>
        @empty
            <div class="col-12">
                <p class="text-center text-muted py-5">Belum ada produk di kategori ini.</p>
            </div>
        @endforelse
    </div>
</div>

@endsection