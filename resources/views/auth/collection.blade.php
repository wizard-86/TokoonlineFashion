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
                <h2 class="fw-bold text-white">Our <span class="text-primary">Collection</span></h2>
                <p class="text-secondary">Temukan streetwear kualitas premium terbaik untuk mengekspresikan gayamu.</p>
            </div>

            @php
                // Menangkap ID Database asli berdasarkan nama produk di katalog collection Anda
                $c1 = \App\Models\Product::where('name', 'like', '%Clarity%')->first();
                $c2 = \App\Models\Product::where('name', 'like', '%Vintage Red%')->first();
                $c3 = \App\Models\Product::where('name', 'like', '%Retro Blue%')->first();
                $c4 = \App\Models\Product::where('name', 'like', '%bloom%')->first();
                $c5 = \App\Models\Product::where('name', 'like', '%Coach Jacket%')->first();
                $c6 = \App\Models\Product::where('name', 'like', '%Denim Rebel%')->first();
                $c8 = \App\Models\Product::where('name', 'like', '%Boxy Hoodie%')->first();
                $c9 = \App\Models\Product::where('name', 'like', '%Gothic Yellow%')->first();
                $c10 = \App\Models\Product::where('name', 'like', '%Ranger Gold%')->first();
                $c11 = \App\Models\Product::where('name', 'like', '%Neo Vulcanized%')->first();
                $c12 = \App\Models\Product::where('name', 'like', '%Snapback%')->first();
            @endphp

            {{-- BARIS 1 --}}
            <div class="row g-4 mb-5">
                <div class="col-md-6 col-lg-3 product-card-wrapper" data-category="perfume">
                    <div class="product-card">
                        <div class="product-img-container">
                            <img src="{{ asset('assets/parfum/perfume2.png') }}" alt="Urban Vibe Clarity">
                        </div>
                        <div class="product-info">
                            <span class="product-category">PERFUME</span>
                            <h5 class="mt-2 text-truncate">Urban Vibe Clarity</h5>
                            <div class="d-flex justify-content-between align-items-center mt-3">
                                <span class="fw-bold fs-5 text-primary">Rp 295.000</span>
                                <form action="{{ route('cart.add', $c1 ? $c1->id : 1) }}" method="POST" class="m-0">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-premium"><i class="bi bi-plus-lg"></i></button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-3 product-card-wrapper" data-category="t-shirt">
                    <div class="product-card">
                        <div class="product-img-container">
                            <img src="{{ asset('assets/kaos/t-shirt2.png') }}" alt="Urban Vibe Vintage Red">
                        </div>
                        <div class="product-info">
                            <span class="product-category">T-SHIRT</span>
                            <h5 class="mt-2 text-truncate">Vintage Red</h5>
                            <div class="d-flex justify-content-between align-items-center mt-3">
                                <span class="fw-bold fs-5 text-primary">Rp 199.000</span>
                                <form action="{{ route('cart.add', $c2 ? $c2->id : 2) }}" method="POST" class="m-0">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-premium"><i class="bi bi-plus-lg"></i></button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-3 product-card-wrapper" data-category="sock">
                    <div class="product-card">
                        <div class="product-img-container">
                            <img src="{{ asset('assets/kaoskaki/sock1.png') }}" alt="Urban Vibe Retro Blue Aesthetic">
                        </div>
                        <div class="product-info">
                            <span class="product-category">SOCK</span>
                            <h5 class="mt-2 text-truncate">Retro Blue Aesthetic</h5>
                            <div class="d-flex justify-content-between align-items-center mt-3">
                                <span class="fw-bold fs-5 text-primary">Rp 55.000</span>
                                <form action="{{ route('cart.add', $c3 ? $c3->id : 3) }}" method="POST" class="m-0">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-premium"><i class="bi bi-plus-lg"></i></button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-3 product-card-wrapper" data-category="perfume">
                    <div class="product-card">
                        <div class="product-img-container">
                            <img src="{{ asset('assets/parfum/perfume1.png') }}" alt="Urban Vibe Bloom">
                        </div>
                        <div class="product-info">
                            <span class="product-category">PERFUME</span>
                            <h5 class="mt-2 text-truncate">Urban Vibe bloom</h5>
                            <div class="d-flex justify-content-between align-items-center mt-3">
                                <span class="fw-bold fs-5 text-primary">Rp 265.000</span>
                                <form action="{{ route('cart.add', $c4 ? $c4->id : 4) }}" method="POST" class="m-0">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-premium"><i class="bi bi-plus-lg"></i></button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- BARIS 2 --}}
            <div class="row g-4 mb-5">
                <div class="col-md-6 col-lg-3 product-card-wrapper" data-category="jacket">
                    <div class="product-card">
                        <div class="product-img-container">
                            <img src="{{ asset('assets/jaket/jacket4.png') }}" alt="Urban Vibe Minimalist Coach Jacket">
                        </div>
                        <div class="product-info">
                            <span class="product-category">JACKET</span>
                            <h5 class="mt-2 text-truncate">Minimalist Coach Jacket</h5>
                            <div class="d-flex justify-content-between align-items-center mt-3">
                                <span class="fw-bold fs-5 text-primary">Rp 349.000</span>
                                <form action="{{ route('cart.add', $c5 ? $c5->id : 5) }}" method="POST" class="m-0">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-premium"><i class="bi bi-plus-lg"></i></button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-3 product-card-wrapper" data-category="jacket">
                    <div class="product-card">
                        <div class="product-img-container">
                            <img src="{{ asset('assets/jaket/jacket1.png') }}" alt="Urban Vibe Vintage Denim Rebel Jacket">
                        </div>
                        <div class="product-info">
                            <span class="product-category">JACKET</span>
                            <h5 class="mt-2 text-truncate">Vintage Denim Rebel Jacket</h5>
                            <div class="d-flex justify-content-between align-items-center mt-3">
                                <span class="fw-bold fs-5 text-primary">Rp 449.000</span>
                                <form action="{{ route('cart.add', $c6 ? $c6->id : 6) }}" method="POST" class="m-0">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-premium"><i class="bi bi-plus-lg"></i></button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-3 product-card-wrapper" data-category="sock">
                    <div class="product-card">
                        <div class="product-img-container">
                            <img src="{{ asset('assets/kaoskaki/sock1.png') }}" alt="Urban Vibe Retro Blue Aesthetic">
                        </div>
                        <div class="product-info">
                            <span class="product-category">SOCK</span>
                            <h5 class="mt-2 text-truncate">Retro Blue Aesthetic</h5>
                            <div class="d-flex justify-content-between align-items-center mt-3">
                                <span class="fw-bold fs-5 text-primary">Rp 55.000</span>
                                <form action="{{ route('cart.add', $c3 ? $c3->id : 7) }}" method="POST" class="m-0">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-premium"><i class="bi bi-plus-lg"></i></button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-3 product-card-wrapper" data-category="hoodie">
                    <div class="product-card">
                        <div class="product-img-container">
                            <img src="{{ asset('assets/hodie/hoodies1.png') }}" alt="Urban Vibe Heavyweight Boxy Hoodie">
                        </div>
                        <div class="product-info">
                            <span class="product-category">HOODIE</span>
                            <h5 class="mt-2 text-truncate">Heavyweight Boxy Hoodie</h5>
                            <div class="d-flex justify-content-between align-items-center mt-3">
                                <span class="fw-bold fs-5 text-primary">Rp 379.000</span>
                                <form action="{{ route('cart.add', $c8 ? $c8->id : 8) }}" method="POST" class="m-0">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-premium"><i class="bi bi-plus-lg"></i></button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- BARIS 3 --}}
            <div class="row g-4">
                <div class="col-md-6 col-lg-3 product-card-wrapper" data-category="t-shirt">
                    <div class="product-card">
                        <div class="product-img-container">
                            <img src="{{ asset('assets/kaos/t-shirt1.png') }}" alt="Urban Vibe Gothic Yellow Oversized">
                        </div>
                        <div class="product-info">
                            <span class="product-category">T-SHIRT</span>
                            <h5 class="mt-2 text-truncate">Gothic Yellow Oversized</h5>
                            <div class="d-flex justify-content-between align-items-center mt-3">
                                <span class="fw-bold fs-5 text-primary">Rp 189.000</span>
                                <form action="{{ route('cart.add', $c9 ? $c9->id : 9) }}" method="POST" class="m-0">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-premium"><i class="bi bi-plus-lg"></i></button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-3 product-card-wrapper" data-category="shoes">
                    <div class="product-card">
                        <div class="product-img-container">
                            <img src="{{ asset('assets/sepatu/shoes2.png') }}" alt="Urban Vibe Street Ranger Gold">
                        </div>
                        <div class="product-info">
                            <span class="product-category">SHOES</span>
                            <h5 class="mt-2 text-truncate">Street Ranger Gold</h5>
                            <div class="d-flex justify-content-between align-items-center mt-3">
                                <span class="fw-bold fs-5 text-primary">Rp 999.000</span>
                                <form action="{{ route('cart.add', $c10 ? $c10->id : 10) }}" method="POST" class="m-0">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-premium"><i class="bi bi-plus-lg"></i></button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-3 product-card-wrapper" data-category="shoes">
                    <div class="product-card">
                        <div class="product-img-container">
                            <img src="{{ asset('assets/sepatu/shoes4.png') }}" alt="Urban Vibe Neo Vulcanized White">
                        </div>
                        <div class="product-info">
                            <span class="product-category">SHOES</span>
                            <h5 class="mt-2 text-truncate">Neo Vulcanized White</h5>
                            <div class="d-flex justify-content-between align-items-center mt-3">
                                <span class="fw-bold fs-5 text-primary">Rp 425.000</span>
                                <form action="{{ route('cart.add', $c11 ? $c11->id : 11) }}" method="POST" class="m-0">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-premium"><i class="bi bi-plus-lg"></i></button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-3 product-card-wrapper" data-category="hat">
                    <div class="product-card">
                        <div class="product-img-container">
                            <img src="{{ asset('assets/topi/hat4.png') }}" alt="Urban Vibe Industrial Typography Snapback">
                        </div>
                        <div class="product-info">
                            <span class="product-category">HAT</span>
                            <h5 class="mt-2 text-truncate">Industrial Typography Snapback</h5>
                            <div class="d-flex justify-content-between align-items-center mt-3">
                                <span class="fw-bold fs-5 text-primary">Rp 145.000</span>
                                <form action="{{ route('cart.add', $c12 ? $c12->id : 12) }}" method="POST" class="m-0">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-premium"><i class="bi bi-plus-lg"></i></button>
                                </form>
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
                    <button class="btn btn-dark rounded-pill px-4 fw-bold">SUBSCRIBE</button>
                </div>
            </div>
        </div>
    </section>
@endsection
