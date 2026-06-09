@extends('layouts.app')

@section('title', 'URBAN VIBE | Home Street Style')

@section('content')
    <!-- 1. HERO SECTION -->
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

    <!-- 2. NEW ARRIVALS / FEATURED COLLECTION SECTION -->
    <section id="collection" class="py-5" style="background-color: #0b0b0b;">
        <div class="container py-4">
            <div class="section-title mb-5 reveal">
                <h2 class="fw-bold text-white">New <span class="text-primary">Arrivals</span></h2>
                <p class="text-secondary">Koleksi terbaru minggu ini</p>
            </div>

            <div class="row g-4">
                <!-- Product 1 -->
                <div class="col-md-6 col-lg-3 reveal">
                    <div class="product-card">
                        <!-- Link ke Detail Produk lewat id nomor 1 -->
                        <a href="{{ route('product.show', 1) }}" class="text-decoration-none">
                            <div class="product-img-container">
                                <img src="{{ asset('assets/kategori/product1.png') }}" alt="Oversized T-Shirt">
                            </div>
                        </a>
                        <div class="product-info">
                            <span class="product-category">T-SHIRTS</span>
                            <a href="{{ route('product.show', 1) }}" class="text-decoration-none text-white">
                                <h5 class="mt-2 product-title-hover">Oversized Black Minimalist</h5>
                            </a>
                            <div class="d-flex justify-content-between align-items-center mt-3">
                                <span class="fw-bold fs-5 text-primary">Rp 185.000</span>
                                <!-- Form Tambah ke Keranjang -->
                                <form action="{{ route('cart.add', 1) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-premium" title="Tambah ke Keranjang">
                                        <i class="bi bi-plus-lg"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Product 2 -->
                <div class="col-md-6 col-lg-3 reveal">
                    <div class="product-card">
                        <!-- Link ke Detail Produk lewat id nomor 2 -->
                        <a href="{{ route('product.show', 2) }}" class="text-decoration-none">
                            <div class="product-img-container">
                                <img src="{{ asset('assets/kategori/product2.png') }}" alt="Streetwear Hoodie">
                            </div>
                        </a>
                        <div class="product-info">
                            <span class="product-category">HOODIES</span>
                            <a href="{{ route('product.show', 2) }}" class="text-decoration-none text-white">
                                <h5 class="mt-2 product-title-hover">Navy Premium Street Hoodie</h5>
                            </a>
                            <div class="d-flex justify-content-between align-items-center mt-3">
                                <span class="fw-bold fs-5 text-primary">Rp 350.000</span>
                                <!-- Form Tambah ke Keranjang -->
                                <form action="{{ route('cart.add', 2) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-premium" title="Tambah ke Keranjang">
                                        <i class="bi bi-plus-lg"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Product 3 -->
                <div class="col-md-6 col-lg-3 reveal">
                    <div class="product-card">
                        <!-- Link ke Detail Produk lewat id nomor 3 -->
                        <a href="{{ route('product.show', 3) }}" class="text-decoration-none">
                             <div class="product-img-container">
                                <img src="{{ asset('assets/kategori/product3.png') }}" alt="Gothic Yellow Oversized">
                            </div>
                        </a>
                        <div class="product-info">
                            <span class="product-category">T-SHIRT</span>
                            <a href="{{ route('product.show', 3) }}" class="text-decoration-none text-white">
                                <h5 class="mt-2 product-title-hover">Gothic Yellow Oversized</h5>
                            </a>
                            <div class="d-flex justify-content-between align-items-center mt-3">
                                <span class="fw-bold fs-5 text-primary">Rp 189.000</span>
                                <!-- Form Tambah ke Keranjang -->
                                <form action="{{ route('cart.add', 3) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-premium" title="Tambah ke Keranjang">
                                        <i class="bi bi-plus-lg"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Product 4 -->
                <div class="col-md-6 col-lg-3 reveal">
                    <div class="product-card">
                        <!-- Link ke Detail Produk lewat id nomor 4 -->
                        <a href="{{ route('product.show', 4) }}" class="text-decoration-none">
                            <div class="product-img-container">
                                <img src="{{ asset('assets/kategori/product4.png') }}" alt="Minimalist Core White">
                            </div>
                        </a>
                        <div class="product-info">
                            <span class="product-category">T-SHIRTS</span>
                            <a href="{{ route('product.show', 4) }}" class="text-decoration-none text-white">
                                <h5 class="mt-2 product-title-hover">Minimalist Core White</h5>
                            </a>
                            <div class="d-flex justify-content-between align-items-center mt-3">
                                <span class="fw-bold fs-5 text-primary">Rp 175.000</span>
                                <!-- Form Tambah ke Keranjang -->
                                <form action="{{ route('cart.add', 4) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-premium" title="Tambah ke Keranjang">
                                        <i class="bi bi-plus-lg"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 3. SUBSCRIBE BANNER SECTION -->
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

    <!-- Tambahan CSS Kustom untuk mempercantik hover judul produk -->
    <style>
        .product-title-hover {
            transition: color 0.2s ease;
        }
        .product-title-hover:hover {
            color: #0d6efd !important;
        }
    </style>
@endsection
