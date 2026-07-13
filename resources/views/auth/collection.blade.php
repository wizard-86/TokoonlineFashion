@extends('layouts.app')

@section('title', 'URBAN VIBE | Premium Collection')

@section('content')
    <section class="py-5 my-5" style="background-color: #0b0b0b;">
        <div class="container pt-5 text-white">

            <div class="mb-5">
                <h2 class="fw-bold text-white tracking-wide">OUR <span class="text-primary">COLLECTION</span></h2>
                <p class="text-secondary small">Menampilkan 8 produk streetwear terlaris pilihan terbaik</p>
            </div>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show border-0 text-white rounded-3 mb-4" style="background-color: #198754;" role="alert">
                    <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="row g-4">
                @foreach($products as $product)
                    <div class="col-6 col-md-4 col-lg-3">
                        <div class="product-card">
                            <a href="{{ route('product.detail', $product->id) }}"
                               data-product-detail-url="{{ route('product.detail', $product->id) }}?modal=1"
                               class="d-block product-img-container product-detail-trigger">
                                <img src="{{ asset('assets/' . ($product->image ?? 'default.png')) }}" alt="{{ $product->name }}" class="product-img">
                            </a>
                            <div class="product-info">
                                <span class="product-category text-uppercase">{{ $product->category->name ?? 'STREETWEAR' }}</span>
                                <a href="{{ route('product.detail', $product->id) }}"
                                   data-product-detail-url="{{ route('product.detail', $product->id) }}?modal=1"
                                   class="text-decoration-none product-detail-trigger">
                                    <h5 class="fw-bold my-1 text-white product-title-hover text-truncate">{{ $product->name }}</h5>
                                </a>
                                <div class="d-flex justify-content-between align-items-center mt-3">
                                    <div>
                                        <span class="fw-bold fs-5 text-primary d-block">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                                        <span class="small text-secondary">Stok: {{ (int) ($product->stock ?? 0) }} pcs</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
    </section>
@endsection
