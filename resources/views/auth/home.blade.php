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
                <h2 class="fw-bold text-white">New <span class="text-primary">Arrivals</span></h2>
                <p class="text-secondary">Koleksi terbaru minggu ini. Jangan sampai kehabisan!</p>
            </div>

            <div class="row g-4">
                @php
                    // MENGOPTIMALKAN PENCARIAN AGAR JAUH LEBIH FLEKSIBEL DAN TIDAK MUDAH NULL
                    $p1 = \App\Models\Product::where('name', 'like', '%Acid Wash Black%')->first();
                    $p2 = \App\Models\Product::where('name', 'like', '%Heavyweight Boxy Hoodie%')->first();
                    $p3 = \App\Models\Product::where('name', 'like', '%Gothic Yellow%')->first();
                    $p4 = \App\Models\Product::where('name', 'like', '%Minimalist Core%')->first();
                @endphp

                {{-- PRODUK 1 --}}
                <div class="col-md-6 col-lg-3 reveal">
                    <div class="product-card">
                        @if($p1)
                            <a href="{{ route('product.show', $p1->id) }}" class="text-decoration-none">
                                <div class="product-img-container">
                                    <img src="{{ asset('assets/kaos/t-shirt3.png') }}" alt="Acid Wash Black">
                                </div>
                            </a>
                            <div class="product-info">
                                <span class="product-category">T-SHIRTS</span>
                                <a href="{{ route('product.show', $p1->id) }}" class="text-decoration-none text-white">
                                    <h5 class="mt-2 product-title-hover">{{ $p1->name }}</h5>
                                </a>
                                <div class="d-flex justify-content-between align-items-center mt-3">
                                    <span class="fw-bold fs-5 text-primary">Rp {{ number_format($p1->price, 0, ',', '.') }}</span>
                                    <form action="{{ route('cart.add', $p1->id) }}" method="POST" class="m-0">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-premium" title="Tambah ke Keranjang">
                                            <i class="bi bi-plus-lg"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @else
                            <div class="p-3 border border-secondary rounded text-muted text-center small">Produk "Acid Wash Black" Belum Ada di DB</div>
                        @endif
                    </div>
                </div>

                {{-- PRODUK 2 --}}
                <div class="col-md-6 col-lg-3 reveal">
                    <div class="product-card">
                        @if($p2)
                            <a href="{{ route('product.show', $p2->id) }}" class="text-decoration-none">
                                <div class="product-img-container">
                                    <img src="{{ asset('assets/hodie/hoodies1.png') }}" alt="Heavyweight Boxy Hoodie">
                                </div>
                            </a>
                            <div class="product-info">
                                <span class="product-category">HOODIES</span>
                                <a href="{{ route('product.show', $p2->id) }}" class="text-decoration-none text-white">
                                    <h5 class="mt-2 product-title-hover">{{ $p2->name }}</h5>
                                </a>
                                <div class="d-flex justify-content-between align-items-center mt-3">
                                    <span class="fw-bold fs-5 text-primary">Rp {{ number_format($p2->price, 0, ',', '.') }}</span>
                                    <form action="{{ route('cart.add', $p2->id) }}" method="POST" class="m-0">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-premium" title="Tambah ke Keranjang">
                                            <i class="bi bi-plus-lg"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @else
                            <div class="p-3 border border-secondary rounded text-muted text-center small">Produk "Heavyweight Boxy Hoodie" Belum Ada di DB</div>
                        @endif
                    </div>
                </div>

                {{-- PRODUK 3 --}}
                <div class="col-md-6 col-lg-3 reveal">
                    <div class="product-card">
                        @if($p3)
                            <a href="{{ route('product.show', $p3->id) }}" class="text-decoration-none">
                                 <div class="product-img-container">
                                    <img src="{{ asset('assets/kaos/t-shirt1.png') }}" alt="Gothic Yellow Oversized">
                                </div>
                            </a>
                            <div class="product-info">
                                <span class="product-category">T-SHIRT</span>
                                <a href="{{ route('product.show', $p3->id) }}" class="text-decoration-none text-white">
                                    <h5 class="mt-2 product-title-hover">{{ $p3->name }}</h5>
                                </a>
                                <div class="d-flex justify-content-between align-items-center mt-3">
                                    <span class="fw-bold fs-5 text-primary">Rp {{ number_format($p3->price, 0, ',', '.') }}</span>
                                    <form action="{{ route('cart.add', $p3->id) }}" method="POST" class="m-0">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-premium" title="Tambah ke Keranjang">
                                            <i class="bi bi-plus-lg"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @else
                            <div class="p-3 border border-secondary rounded text-muted text-center small">Produk "Gothic Yellow" Belum Ada di DB</div>
                        @endif
                    </div>
                </div>

                {{-- PRODUK 4 --}}
                <div class="col-md-6 col-lg-3 reveal">
                    <div class="product-card">
                        @if($p4)
                            <a href="{{ route('product.show', $p4->id) }}" class="text-decoration-none">
                                <div class="product-img-container">
                                    <img src="{{ asset('assets/kaos/t-shirt2.png') }}" alt="Minimalist Core White">
                                </div>
                            </a>
                            <div class="product-info">
                                <span class="product-category">T-SHIRTS</span>
                                <a href="{{ route('product.show', $p4->id) }}" class="text-decoration-none text-white">
                                    <h5 class="mt-2 product-title-hover">{{ $p4->name }}</h5>
                                </a>
                                <div class="d-flex justify-content-between align-items-center mt-3">
                                    <span class="fw-bold fs-5 text-primary">Rp {{ number_format($p4->price, 0, ',', '.') }}</span>
                                    <form action="{{ route('cart.add', $p4->id) }}" method="POST" class="m-0">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-premium" title="Tambah ke Keranjang">
                                            <i class="bi bi-plus-lg"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @else
                            <div class="p-3 border border-secondary rounded text-muted text-center small">Produk "Minimalist Core" Belum Ada di DB</div>
                        @endif
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
        .product-title-hover {
            transition: color 0.2s ease;
        }
        .product-title-hover:hover {
            color: #0d6efd !important;
        }
    </style>
@endsection
