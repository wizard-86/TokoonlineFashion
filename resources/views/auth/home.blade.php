@extends('layouts.app')

@section('title', 'URBAN VIBE | Home Street Style')

@section('content')
    <section id="home" class="hero-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 hero-content">
                    <h1 class="reveal">Elevate Your<br><span class="text-primary">Street Style</span></h1>
                    <p class="reveal">Temukan koleksi eksklusif distro fashion premium yang dirancang untuk ekspresi diri yang tak terbatas.</p>
                    <div class="mt-4 reveal">
                        <a href="{{ route('collection') }}" class="btn btn-premium me-3">Shop Now</a>
                        <a href="#" class="btn btn-outline-premium">View Lookbook</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="collection" class="py-5" style="background-color: #0b0b0b;">
        <div class="container py-4">

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show border-0 text-white rounded-3 mb-4" style="background-color: #198754;" role="alert">
                    <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="section-title mb-5 reveal">
                <h2 class="fw-bold text-white">Featured <span class="text-primary">Collection</span></h2>
                <p class="text-secondary">Pilihan item streetwear terbaik untuk menunjang penampilan harianmu.</p>
            </div>

            <div class="row g-4">
                @foreach($products->take(4) as $product)
                    <div class="col-md-6 col-lg-3 reveal">
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

                <div class="col-md-6 col-lg-3 reveal">
                    <div class="product-card">
                        <div class="product-img-container">
                            <img src="{{ asset('assets/image_70c8a6.png') }}" alt="Heavyweight Hoodie" class="product-img">
                        </div>
                        <div class="product-info">
                            <span class="product-category">HOODIE</span>
                            <a href="{{ route('product.detail', 10) }}" class="text-decoration-none">
                                <h5 class="fw-bold my-1 text-white product-title-hover">Heavyweight Hoodie Black</h5>
                            </a>
                            @if($c10)
                                <div class="d-flex justify-content-between align-items-center mt-3">
                                    <span class="fw-bold fs-5 text-primary">Rp {{ number_format($c10->price, 0, ',', '.') }}</span>
                                    <form action="{{ route('cart.add', $c10->id) }}" method="POST" class="m-0">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-premium"><i class="bi bi-plus-lg"></i></button>
                                    </form>
                                </div>
                            @else
                                <div class="p-2 border border-secondary rounded text-muted text-center small mt-2">Item Belum Ada di DB</div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-3 reveal">
                    <div class="product-card">
                        <div class="product-img-container">
                            <img src="{{ asset('assets/image_6bb185.png') }}" alt="Cargo Pants" class="product-img">
                        </div>
                        <div class="product-info">
                            <span class="product-category">PANTS</span>
                            <a href="{{ route('product.detail', 11) }}" class="text-decoration-none">
                                <h5 class="fw-bold my-1 text-white product-title-hover">Cyber Cargo Pants V2</h5>
                            </a>
                            @if($c11)
                                <div class="d-flex justify-content-between align-items-center mt-3">
                                    <span class="fw-bold fs-5 text-primary">Rp {{ number_format($c11->price, 0, ',', '.') }}</span>
                                    <form action="{{ route('cart.add', $c11->id) }}" method="POST" class="m-0">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-premium"><i class="bi bi-plus-lg"></i></button>
                                    </form>
                                </div>
                            @else
                                <div class="p-2 border border-secondary rounded text-muted text-center small mt-2">Item Belum Ada di DB</div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-3 reveal">
                    <div class="product-card">
                        <div class="product-img-container">
                            <img src="{{ asset('assets/image_037d45.png') }}" alt="Minimalist Core Tee" class="product-img">
                        </div>
                        <div class="product-info">
                            <span class="product-category">T-SHIRT</span>
                            <a href="{{ route('product.detail', 12) }}" class="text-decoration-none">
                                <h5 class="fw-bold my-1 text-white product-title-hover">Minimalist Core Oversized</h5>
                            </a>
                            @if($c12)
                                <div class="d-flex justify-content-between align-items-center mt-3">
                                    <span class="fw-bold fs-5 text-primary">Rp {{ number_format($c12->price, 0, ',', '.') }}</span>
                                    <form action="{{ route('cart.add', $c12->id) }}" method="POST" class="m-0">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-premium"><i class="bi bi-plus-lg"></i></button>
                                    </form>
                                </div>
                            @else
                                <div class="p-2 border border-secondary rounded text-muted text-center small mt-2">Item Belum Ada di DB</div>
                            @endif
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <section class="py-5" style="background-color: #0b0b0b;">
        <div class="container py-2">
            <div class="bg-primary p-5 rounded-4 d-flex flex-column flex-md-row justify-content-between align-items-center text-white reveal">
                <div>
                    <h2 class="fw-bold m-0">JOIN OUR COMMUNITY</h2>
                    <p class="m-0 opacity-75">Dapatkan diskon 15% untuk pembelian pertama Anda.</p>
                </div>
                <div class="mt-4 mt-md-0 d-flex gap-2 w-50-md">
                    <input type="email" class="form-control form-control-lg border-0 rounded-pill px-4" placeholder="Email Anda">
                    <button class="btn btn-dark rounded-pill px-4 fw-bold">SUBSCRIBE</button>
                </div>
            </div>
        </div>
    </section>

    <style>
        .product-title-hover { transition: color 0.2s ease; }
        .product-title-hover:hover { color: #0d6efd !important; }
    </style>
@endsection
