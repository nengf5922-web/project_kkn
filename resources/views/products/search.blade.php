@extends('layouts.main')

@section('content')
<div class="container py-5">

    <div class="mb-4">
        <h4>Hasil pencarian untuk: "<strong>{{ $keyword }}</strong>"</h4>
        <p class="text-muted">{{ $products->count() }} produk ditemukan</p>
    </div>

    @if($products->count() > 0)
        <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 g-4">
            @foreach($products as $product)
            <div class="col">
                <div class="card h-100 border-0 shadow-sm">
                    <a href="{{ route('products.show', $product->slug) }}" class="text-decoration-none">
                        <div style="height: 250px; overflow: hidden; background: #f8f9fa;">
                            @if($product->image)
                                <img src="{{ asset('assets/products/' . $product->image) }}" 
                                     alt="{{ $product->name }}" 
                                     class="w-100 h-100" 
                                     style="object-fit: cover;">
                            @else
                                <img src="https://via.placeholder.com/300x400" 
                                     alt="{{ $product->name }}" 
                                     class="w-100 h-100" 
                                     style="object-fit: cover;">
                            @endif
                        </div>
                    </a>

                    <div class="card-body text-center">
                        <a href="{{ route('products.show', $product->slug) }}" class="text-decoration-none text-dark">
                            <h6 class="fw-bold mb-1">{{ $product->name }}</h6>
                            <p class="text-danger fw-bold mb-2">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                        </a>
                        
                        <div class="d-flex justify-content-center gap-2 mt-2">
                           <a href="{{ route('products.show', $product->slug) }}" class="btn btn-sm btn-dark">
                               <i class="bi bi-eye me-1"></i> Detail
                           </a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    @else
        <div class="alert alert-warning text-center">
            Produk dengan kata kunci "<strong>{{ $keyword }}</strong>" tidak ditemukan.
        </div>
    @endif

</div>
@endsection