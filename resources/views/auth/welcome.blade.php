@extends('layouts.app')

@section('title', 'URBAN VIBE | Welcome Street Style')

@section('content')
    <section id="home" class="hero-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 hero-content">
                    <h1 class="reveal">Elevate Your<br><span class="text-primary">Street Style</span></h1>
                    <p class="reveal">Temukan koleksi eksklusif distro fashion premium yang dirancang untuk ekspresi diri yang tak terbatas.</p>
                    <div class="mt-4 reveal">
                        <a href="{{ route('login') }}" class="btn btn-premium me-3">Shop Now</a>
                        <a href="{{ route('login') }}" class="btn btn-outline-premium">View Lookbook</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="collection" class="py-5" style="background-color: #0b0b0b;">
        <div class="container py-4">
            <div class="section-title mb-5 reveal">
                <h2 class="fw-bold text-white">New <span class="text-primary">Arrivals</span></h2>
                <p class="text-secondary">Koleksi terbaru minggu ini (Silakan masuk akun untuk membeli)</p>
            </div>

            <div class="row g-4">
                @if(isset($products) && count($products) > 0)
                    @foreach($products as $product)
                        <div class="col-md-3">
                            <div class="product-card border border-secondary p-3 rounded-4 bg-dark h-100 d-flex flex-column justify-content-between position-relative reveal">
                                <div class="product-img-container rounded-3 overflow-hidden mb-3">
                                    <img src="{{ asset('assets/' . ($product->image ?? 'default.png')) }}" alt="{{ $product->name }}" class="img-fluid product-img w-100 object-fit-cover" style="height: 280px;">
                                </div>
                                <div class="product-info flex-grow-1 d-flex flex-column justify-content-between">
                                    <div>
                                        <span class="text-primary fw-bold tracking-wide text-uppercase small" style="font-size: 0.75rem;">
                                            {{ $product->category->name ?? 'STREETWEAR' }}
                                        </span>
                                        <h5 class="fw-bold my-1 text-white text-truncate product-title-hover" title="{{ $product->name }}">
                                            {{ $product->name }}
                                        </h5>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center mt-3 pt-2 border-top border-secondary border-opacity-25">
                                        <span class="fw-bold fs-5 text-primary">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                                        <a href="{{ route('login') }}" class="btn btn-sm btn-outline-primary rounded-circle p-2 d-flex align-items-center justify-content-center" style="width: 35px; height: 35px;" title="Login untuk membeli">
                                            <i class="bi bi-lock-fill"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="col-12 text-center py-5">
                        <p class="text-muted fs-5">Belum ada data produk yang tersedia saat ini.</p>
                    </div>
                @endif
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
                    <a href="{{ route('login') }}" class="btn btn-dark rounded-pill px-4 fw-bold d-flex align-items-center justify-content-center text-decoration-none">SUBSCRIBE</a>
                </div>
            </div>
        </div>
    </section>

    <style>
        .product-title-hover { transition: color 0.2s ease; }
        .product-title-hover:hover { color: #0d6efd !important; }
    </style>
@endsection
