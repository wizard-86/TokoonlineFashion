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
                <div class="col-md-6 col-lg-3 reveal">
                    <div class="product-card">
                        <div class="product-img-container">
                            <img src="{{ asset('assets/kategori/product1.png') }}" alt="Oversized T-Shirt">
                        </div>
                        <div class="product-info">
                            <span class="product-category">T-SHIRTS</span>
                            <h5 class="mt-2 text-white">Oversized Black Minimalist</h5>
                            <div class="d-flex justify-content-between align-items-center mt-3">
                                <span class="fw-bold fs-5 text-primary">Rp 185.000</span>
                                <a href="{{ route('login') }}" class="btn btn-sm btn-outline-secondary" title="Login untuk membeli">
                                    <i class="bi bi-lock-fill"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-3 reveal">
                    <div class="product-card">
                        <div class="product-img-container">
                            <img src="{{ asset('assets/kategori/product2.png') }}" alt="Streetwear Hoodie">
                        </div>
                        <div class="product-info">
                            <span class="product-category">HOODIES</span>
                            <h5 class="mt-2 text-white">Navy Premium Street Hoodie</h5>
                            <div class="d-flex justify-content-between align-items-center mt-3">
                                <span class="fw-bold fs-5 text-primary">Rp 350.000</span>
                                <a href="{{ route('login') }}" class="btn btn-sm btn-outline-secondary" title="Login untuk membeli">
                                    <i class="bi bi-lock-fill"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-3 reveal">
                    <div class="product-card">
                         <div class="product-img-container">
                            <img src="{{ asset('assets/kategori/product3.png') }}" alt="Gothic Yellow Oversized">
                        </div>
                        <div class="product-info">
                            <span class="product-category">T-SHIRT</span>
                            <h5 class="mt-2 text-white">Gothic Yellow Oversized</h5>
                            <div class="d-flex justify-content-between align-items-center mt-3">
                                <span class="fw-bold fs-5 text-primary">Rp 189.000</span>
                                <a href="{{ route('login') }}" class="btn btn-sm btn-outline-secondary" title="Login untuk membeli">
                                    <i class="bi bi-lock-fill"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-3 reveal">
                    <div class="product-card">
                        <div class="product-img-container">
                            <img src="{{ asset('assets/kategori/product4.png') }}" alt="Minimalist Core White">
                        </div>
                        <div class="product-info">
                            <span class="product-category">T-SHIRTS</span>
                            <h5 class="mt-2 text-white">Minimalist Core White</h5>
                            <div class="d-flex justify-content-between align-items-center mt-3">
                                <span class="fw-bold fs-5 text-primary">Rp 175.000</span>
                                <a href="{{ route('login') }}" class="btn btn-sm btn-outline-secondary" title="Login untuk membeli">
                                    <i class="bi bi-lock-fill"></i>
                                </a>
                            </div>
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
                    <a href="{{ route('login') }}" class="btn btn-dark rounded-pill px-4 fw-bold d-flex align-items-center justify-content-center">SUBSCRIBE</a>
                </div>
            </div>
        </div>
    </section>
@endsection
