@extends('layouts.app')

@section('title', 'URBAN VIBE | Premium Collection')

@section('content')
    <section class="py-5 my-5" style="background-color: #0b0b0b;">
        <div class="container pt-5 text-white">

            <div class="mb-4">
                <h2 class="fw-bold text-white tracking-wide">OUR <span class="text-primary">COLLECTION</span></h2>
                <p class="text-secondary small">Menampilkan produk streetwear terbaik khusus untuk kamu</p>
            </div>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show border-0 text-white rounded-3 mb-4" style="background-color: #198754;" role="alert">
                    <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="row mb-4">
                <div class="col-12">
                    <div class="d-flex gap-2 flex-wrap">
                        <a href="{{ route('collection') }}" class="btn btn-sm btn-outline-secondary rounded-pill px-3 {{ !request('category') ? 'active bg-primary border-primary text-white' : '' }}">All Items</a>
                        @foreach($categories as $category)
                            <a href="{{ route('collection', ['category' => $category->id]) }}" class="btn btn-sm btn-outline-secondary rounded-pill px-3 {{ request('category') == $category->id ? 'active bg-primary border-primary text-white' : '' }}">
                                {{ $category->name }}
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="row g-4">
                @foreach($products as $product)
                    <div class="col-md-6 col-lg-3">
                        <div class="product-card">
                            <div class="product-img-container">
                                <img src="{{ asset('assets/' . ($product->image ?? 'default.png')) }}" alt="{{ $product->name }}" class="product-img">
                            </div>
                            <div class="product-info">
                                <span class="product-category text-uppercase">{{ $product->category->name ?? 'STREETWEAR' }}</span>
                                <a href="{{ route('product.detail', $product->id) }}" class="text-decoration-none">
                                    <h5 class="fw-bold my-1 text-white product-title-hover text-truncate">{{ $product->name }}</h5>
                                </a>
                                <div class="d-flex justify-content-between align-items-center mt-3">
                                    <span class="fw-bold fs-5 text-primary">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                                    <form action="{{ route('cart.add', $product->id) }}" method="POST" class="m-0">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-premium"><i class="bi bi-plus-lg"></i></button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
    </section>
@endsection
