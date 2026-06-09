@extends('layouts.app')

@section('title', 'URBAN VIBE | Pencarian Barang')

@section('content')
    <section class="py-5 my-5" style="background-color: #0b0b0b;">
        <div class="container pt-5 text-white">

            <!-- Judul Halaman -->
            <h2 class="fw-bold mb-4"><i class="bi bi-search text-primary"></i> Pencarian Barang</h2>

            <!-- 1. KOLOM PENCARIAN -->
            <div class="row mb-5">
                <div class="col-12">
                    <div class="input-group input-group-lg shadow-sm">
                        <input type="text" id="searchInput" class="form-control bg-dark text-white border-secondary py-3 px-4 focus-primary" placeholder="Cari produk distro favoritmu...">
                        <button class="btn btn-primary px-5 fw-bold"><i class="bi bi-search me-2"></i> Cari</button>
                    </div>
                </div>
            </div>

            <!-- 2. KATEGORI 2026 (7 KATEGORI UTAMA) -->
            <h5 class="mb-3 text-secondary small fw-bold tracking-wide">KATEGORI POPULER</h5>
            <div class="d-flex gap-2 flex-wrap mb-5">
                <button class="btn btn-sm btn-category active-category" onclick="filterCategory('all', this)">All Kategori</button>
                <button class="btn btn-sm btn-category" onclick="filterCategory('shoes', this)">Shoes</button>
                <button class="btn btn-sm btn-category" onclick="filterCategory('perfume', this)">Perfume</button>
                <button class="btn btn-sm btn-category" onclick="filterCategory('t-shirt', this)">T-Shirt</button>
                <button class="btn btn-sm btn-category" onclick="filterCategory('hoodie', this)">Hoodie</button>
                <button class="btn btn-sm btn-category" onclick="filterCategory('sock', this)">sock</button>
                <button class="btn btn-sm btn-category" onclick="filterCategory('jacket', this)">Jacket</button>
                <button class="btn btn-sm btn-category" onclick="filterCategory('hat', this)">hat</button>
            </div>

            <hr class="border-secondary my-5 opacity-25">

            <!-- 3. JUDUL DINAMIS GRID -->
            <div class="mb-4">
                <h4 class="fw-bold m-0" id="gallery-title">Semua <span class="text-primary">Kategori</span></h4>
                <p class="text-secondary small m-0" id="gallery-desc">Menampilkan semua koleksi produk terbaik</p>
            </div>

            <!-- 4. GRID UTAMA (TOTAL 28 PRODUK URBAN VIBE) -->
            <div class="row g-4" id="productContainer">

                <!-- KATEGORI: SEPATU (4 Produk) -->
                <div class="col-md-6 col-lg-3 product-card-wrapper" data-category="shoes">
                    <div class="product-card">
                       <div class="product-img-container">
                       <img src="{{ asset('assets/sepatu/shoes1.png') }}" alt="Urban Vibe Phantom Sneakers Red"></div>
                       <div class="product-info">
                            <span class="product-category">SHOES</span>
                            <h5 class="mt-2 text-truncate">Phantom Sneakers Red </h5>
                            <div class="d-flex justify-content-between align-items-center mt-3"><span class="fw-bold fs-5 text-primary">Rp 549.000</span><button class="btn btn-sm btn-premium"><i class="bi bi-plus-lg"></i></button></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 product-card-wrapper" data-category="shoes">
                    <div class="product-card">
                        <div class="product-img-container">
                        <img src="{{ asset('assets/sepatu/shoes2.png') }}" alt="Urban Vibe Street Ranger Gold"></div>
                        <div class="product-info">
                            <span class="product-category">SHOES</span>
                            <h5 class="mt-2 text-truncate">Street Ranger Gold </h5>
                            <div class="d-flex justify-content-between align-items-center mt-3"><span class="fw-bold fs-5 text-primary">Rp 999.000</span><button class="btn btn-sm btn-premium"><i class="bi bi-plus-lg"></i></button></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 product-card-wrapper" data-category="shoes">
                    <div class="product-card">
                        <div class="product-img-container">
                        <img src="{{ asset('assets/sepatu/shoes3.png') }}" alt="Urban Vibe Cyber Black"> </div>
                    <div class="product-info">
                            <span class="product-category">SHOES</span>
                            <h5 class="mt-2 text-truncate">Cyber Black</h5>
                            <div class="d-flex justify-content-between align-items-center mt-3"><span class="fw-bold fs-5 text-primary">Rp 599.000</span><button class="btn btn-sm btn-premium"><i class="bi bi-plus-lg"></i></button></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 product-card-wrapper" data-category="shoes">
                    <div class="product-card">
                        <div class="product-img-container">
                        <img src="{{ asset('assets/sepatu/shoes4.png') }}" alt="Urban Vibe Neo Vulcanized White"> </div>
                    <div class="product-info">
                            <span class="product-category">SHOES</span>
                            <h5 class="mt-2 text-truncate">Neo Vulcanized White</h5>
                            <div class="d-flex justify-content-between align-items-center mt-3"><span class="fw-bold fs-5 text-primary">Rp 425.000</span><button class="btn btn-sm btn-premium"><i class="bi bi-plus-lg"></i></button></div>
                        </div>
                    </div>
                </div>

                <!-- KATEGORI: PARFUM (4 Produk) -->
                <div class="col-md-6 col-lg-3 product-card-wrapper" data-category="perfume">
                    <div class="product-card">
                        <div class="product-img-container">
                        <img src="{{ asset('assets/parfum/perfume1.png') }}" alt="Urban Vibe Bloom "> </div>
                    <div class="product-info">
                            <span class="product-category">PERFUME</span>
                            <h5 class="mt-2 text-truncate">Urban Vibe bloom </h5>
                            <div class="d-flex justify-content-between align-items-center mt-3"><span class="fw-bold fs-5 text-primary">Rp 265.000</span><button class="btn btn-sm btn-premium"><i class="bi bi-plus-lg"></i></button></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 product-card-wrapper" data-category="perfume">
                    <div class="product-card">
                       <div class="product-img-container">
                        <img src="{{ asset('assets/parfum/perfume2.png') }}" alt="Urban Vibe Clarity "> </div>
                    <div class="product-info">
                            <span class="product-category">PERFUME</span>
                            <h5 class="mt-2 text-truncate">Urban Vibe Clarity</h5>
                            <div class="d-flex justify-content-between align-items-center mt-3"><span class="fw-bold fs-5 text-primary">Rp 295.000</span><button class="btn btn-sm btn-premium"><i class="bi bi-plus-lg"></i></button></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 product-card-wrapper" data-category="perfume">
                    <div class="product-card">
                        <div class="product-img-container">
                        <img src="{{ asset('assets/parfum/perfume3.png') }}" alt="Urban Vibe Noir"> </div>
                    <div class="product-info">
                            <span class="product-category">PERFUME</span>
                            <h5 class="mt-2 text-truncate">Urban Vibe Noir</h5>
                            <div class="d-flex justify-content-between align-items-center mt-3"><span class="fw-bold fs-5 text-primary">Rp 195.000</span><button class="btn btn-sm btn-premium"><i class="bi bi-plus-lg"></i></button></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 product-card-wrapper" data-category="perfume">
                    <div class="product-card">
                         <div class="product-img-container">
                        <img src="{{ asset('assets/parfum/perfume4.png') }}" alt="Urban Vibe Edge"> </div>
                    <div class="product-info">
                            <span class="product-category">PERFUME</span>
                            <h5 class="mt-2 text-truncate"> Urban Vibe Edge  </h5>
                            <div class="d-flex justify-content-between align-items-center mt-3"><span class="fw-bold fs-5 text-primary">Rp 280.000</span><button class="btn btn-sm btn-premium"><i class="bi bi-plus-lg"></i></button></div>
                        </div>
                    </div>
                </div>

                <!-- KATEGORI: KAOS (4 Produk) -->
                <div class="col-md-6 col-lg-3 product-card-wrapper" data-category="t-shirt">
                    <div class="product-card">
                       <div class="product-img-container">
                        <img src="{{ asset('assets/kaos/t-shirt1.png') }}" alt="Urban Vibe Gothic Yellow Oversized "></div>
                       <div class="product-info">
                            <span class="product-category">T-SHIRT</span>
                            <h5 class="mt-2 text-truncate">Gothic Yellow Oversized</h5>
                            <div class="d-flex justify-content-between align-items-center mt-3"><span class="fw-bold fs-5 text-primary">Rp 189.000</span><button class="btn btn-sm btn-premium"><i class="bi bi-plus-lg"></i></button></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 product-card-wrapper" data-category="t-shirt">
                    <div class="product-card">
                       <div class="product-img-container">
                        <img src="{{ asset('assets/kaos/t-shirt2.png') }}" alt="Urban Vibe Vintage  Red "></div>
                       <div class="product-info">
                            <span class="product-category">T-SHIRT</span>
                            <h5 class="mt-2 text-truncate">Vintage  Red </h5>
                            <div class="d-flex justify-content-between align-items-center mt-3"><span class="fw-bold fs-5 text-primary">Rp 199.000</span><button class="btn btn-sm btn-premium"><i class="bi bi-plus-lg"></i></button></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 product-card-wrapper" data-category="t-shirt">
                    <div class="product-card">
                        <div class="product-img-container">
                        <img src="{{ asset('assets/kaos/t-shirt3.png') }}" alt="Urban Vibe Acid Wash Black "></div>
                       <div class="product-info">
                            <span class="product-category">T-SHIRT</span>
                            <h5 class="mt-2 text-truncate"> Acid Wash Black </h5>
                            <div class="d-flex justify-content-between align-items-center mt-3"><span class="fw-bold fs-5 text-primary">Rp 185.000</span><button class="btn btn-sm btn-premium"><i class="bi bi-plus-lg"></i></button></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 product-card-wrapper" data-category="t-shirt">
                    <div class="product-card">
                        <div class="product-img-container">
                        <img src="{{ asset('assets/kaos/t-shirt4.png') }}" alt="Urban Vibe Minimalist Core White "></div>
                       <div class="product-info">
                            <span class="product-category">T-SHIRT</span>
                            <h5 class="mt-2 text-truncate">Minimalist Core White </h5>
                            <div class="d-flex justify-content-between align-items-center mt-3"><span class="fw-bold fs-5 text-primary">Rp 175.000</span><button class="btn btn-sm btn-premium"><i class="bi bi-plus-lg"></i></button></div>
                        </div>
                    </div>
                </div>

                <!-- KATEGORI: HOODIE (4 Produk) -->
                <div class="col-md-6 col-lg-3 product-card-wrapper" data-category="hoodie">
                    <div class="product-card">
                        <div class="product-img-container"><img src="{{ asset('assets/hodie/hoodies1.png') }}" alt="Urban Vibe Heavyweight Boxy Hoodie"></div>
                        <div class="product-info">
                            <span class="product-category">HOODIE</span>
                            <h5 class="mt-2 text-truncate">Heavyweight Boxy Hoodie</h5>
                            <div class="d-flex justify-content-between align-items-center mt-3"><span class="fw-bold fs-5 text-primary">Rp 379.000</span><button class="btn btn-sm btn-premium"><i class="bi bi-plus-lg"></i></button></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 product-card-wrapper" data-category="hoodie">
                    <div class="product-card">
                        <div class="product-img-container"><img src="{{ asset('assets/hodie/hoodies2.png') }}" alt="Urban Vibe Raw Edge Cropped Sage"></div>
                        <div class="product-info">
                            <span class="product-category">HOODIE</span>
                            <h5 class="mt-2 text-truncate">Raw Edge Cropped Sage</h5>
                            <div class="d-flex justify-content-between align-items-center mt-3"><span class="fw-bold fs-5 text-primary">Rp 365.000</span><button class="btn btn-sm btn-premium"><i class="bi bi-plus-lg"></i></button></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 product-card-wrapper" data-category="hoodie">
                    <div class="product-card">
                        <div class="product-img-container"><img src="{{ asset('assets/hodie/hoodies3.png') }}" alt="Urban Vibe Street Graffity Pullover"></div>
                        <div class="product-info">
                            <span class="product-category">HOODIE</span>
                            <h5 class="mt-2 text-truncate">Street Graffity Pullover</h5>
                            <div class="d-flex justify-content-between align-items-center mt-3"><span class="fw-bold fs-5 text-primary">Rp 395.000</span><button class="btn btn-sm btn-premium"><i class="bi bi-plus-lg"></i></button></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 product-card-wrapper" data-category="hoodie">
                    <div class="product-card">
                        <div class="product-img-container"><img src="{{ asset('assets/hodie/hoodies4.png') }}" alt="Urban Vibe Cyber Glitch Zipper"></div>
                        <div class="product-info">
                            <span class="product-category">HOODIE</span>
                            <h5 class="mt-2 text-truncate">Cyber Glitch Full Zipper</h5>
                            <div class="d-flex justify-content-between align-items-center mt-3"><span class="fw-bold fs-5 text-primary">Rp 410.000</span><button class="btn btn-sm btn-premium"><i class="bi bi-plus-lg"></i></button></div>
                        </div>
                    </div>
                </div>

                <!-- KATEGORI: KAOS KAKI (4 Produk) -->
                <div class="col-md-6 col-lg-3 product-card-wrapper" data-category="sock">
                    <div class="product-card">
                        <div class="product-img-container"><img src="{{ asset('assets/kaoskaki/sock1.png') }}" alt="Urban Vibe Retro Blue Aesthetic"></div>
                        <div class="product-info">
                            <span class="product-category">SOCK</span>
                            <h5 class="mt-2 text-truncate">Retro Blue Aesthetic</h5>
                            <div class="d-flex justify-content-between align-items-center mt-3"><span class="fw-bold fs-5 text-primary">Rp 55.000</span><button class="btn btn-sm btn-premium"><i class="bi bi-plus-lg"></i></button></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 product-card-wrapper" data-category="sock">
                    <div class="product-card">
                        <div class="product-img-container"><img src="{{ asset('assets/kaoskaki/sock2.png') }}" alt="Urban Vibe Retro light green Aesthetic"></div>
                        <div class="product-info">
                            <span class="product-category">SOCK</span>
                            <h5 class="mt-2 text-truncate">Retro light green Aesthetic</h5>
                            <div class="d-flex justify-content-between align-items-center mt-3"><span class="fw-bold fs-5 text-primary">Rp 55.000</span><button class="btn btn-sm btn-premium"><i class="bi bi-plus-lg"></i></button></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 product-card-wrapper" data-category="sock">
                    <div class="product-card">
                        <div class="product-img-container"><img src="{{ asset('assets/kaoskaki/sock3.png') }}" alt="Urban Vibe Retro Stripe Aesthetic"></div>
                        <div class="product-info">
                            <span class="product-category">SOCK</span>
                            <h5 class="mt-2 text-truncate">Retro Stripe Aesthetic</h5>
                            <div class="d-flex justify-content-between align-items-center mt-3"><span class="fw-bold fs-5 text-primary">Rp 45.000</span><button class="btn btn-sm btn-premium"><i class="bi bi-plus-lg"></i></button></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 product-card-wrapper" data-category="sock">
                    <div class="product-card">
                        <div class="product-img-container"><img src="{{ asset('assets/kaoskaki/sock4.png') }}" alt="Urban Vibe Cyber Neon Reflective"></div>
                        <div class="product-info">
                            <span class="product-category">SOCK</span>
                            <h5 class="mt-2 text-truncate">Cyber Neon Reflective</h5>
                            <div class="d-flex justify-content-between align-items-center mt-3"><span class="fw-bold fs-5 text-primary">Rp 59.000</span><button class="btn btn-sm btn-premium"><i class="bi bi-plus-lg"></i></button></div>
                        </div>
                    </div>
                </div>

                <!-- KATEGORI: JAKET (4 Produk) -->
                <div class="col-md-6 col-lg-3 product-card-wrapper" data-category="jacket">
                    <div class="product-card">
                        <div class="product-img-container"><img src="{{ asset('assets/jaket/jacket1.png') }}" alt="Urban Vibe Vintage Denim Rebel Jacket"></div>
                        <div class="product-info">
                            <span class="product-category">JACKET</span>
                            <h5 class="mt-2 text-truncate">Vintage Denim Rebel Jacket</h5>
                            <div class="d-flex justify-content-between align-items-center mt-3"><span class="fw-bold fs-5 text-primary">Rp 449.000</span><button class="btn btn-sm btn-premium"><i class="bi bi-plus-lg"></i></button></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 product-card-wrapper" data-category="jacket">
                    <div class="product-card">
                        <div class="product-img-container"><img src="{{ asset('assets/jaket/jacket2.png') }}" alt="Urban Vibe Technical Waterproof Bomber"></div>
                        <div class="product-info">
                            <span class="product-category">JACKET</span>
                            <h5 class="mt-2 text-truncate">Technical Waterproof Bomber</h5>
                            <div class="d-flex justify-content-between align-items-center mt-3"><span class="fw-bold fs-5 text-primary">Rp 415.000</span><button class="btn btn-sm btn-premium"><i class="bi bi-plus-lg"></i></button></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 product-card-wrapper" data-category="jacket">
                    <div class="product-card">
                        <div class="product-img-container"><img src="{{ asset('assets/jaket/jacket3.png') }}" alt="Urban Vibe Classic Leather Varsity"></div>
                        <div class="product-info">
                            <span class="product-category">JACKET</span>
                            <h5 class="mt-2 text-truncate">Classic Leather Varsity</h5>
                            <div class="d-flex justify-content-between align-items-center mt-3"><span class="fw-bold fs-5 text-primary">Rp 575.000</span><button class="btn btn-sm btn-premium"><i class="bi bi-plus-lg"></i></button></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 product-card-wrapper" data-category="jacket">
                    <div class="product-card">
                        <div class="product-img-container"><img src="{{ asset('assets/jaket/jacket4.png') }}" alt="Urban Vibe Minimalist Coach Jacket"></div>
                        <div class="product-info">
                            <span class="product-category">JACKET</span>
                            <h5 class="mt-2 text-truncate">Minimalist Coach Jacket</h5>
                            <div class="d-flex justify-content-between align-items-center mt-3"><span class="fw-bold fs-5 text-primary">Rp 349.000</span><button class="btn btn-sm btn-premium"><i class="bi bi-plus-lg"></i></button></div>
                        </div>
                    </div>
                </div>

                <!-- KATEGORI: TOPI (4 Produk) -->
                <div class="col-md-6 col-lg-3 product-card-wrapper" data-category="hat">
                    <div class="product-card">
                        <div class="product-img-container"><img src="{{ asset('assets/topi/hat1.png') }}" alt="Urban Vibe Urban Cream Distro Cap"></div>
                        <div class="product-info">
                            <span class="product-category">HAT</span>
                            <h5 class="mt-2 text-truncate">Urban Cream Distro Cap</h5>
                            <div class="d-flex justify-content-between align-items-center mt-3"><span class="fw-bold fs-5 text-primary">Rp 125.000</span><button class="btn btn-sm btn-premium"><i class="bi bi-plus-lg"></i></button></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 product-card-wrapper" data-category="hat">
                    <div class="product-card">
                        <div class="product-img-container"><img src="{{ asset('assets/topi/hat2.png') }}" alt="Urban Vibe Street Reversible Bucket Hat"></div>
                        <div class="product-info">
                            <span class="product-category">HAT</span>
                            <h5 class="mt-2 text-truncate">Street Reversible Bucket Hat</h5>
                            <div class="d-flex justify-content-between align-items-center mt-3"><span class="fw-bold fs-5 text-primary">Rp 135.000</span><button class="btn btn-sm btn-premium"><i class="bi bi-plus-lg"></i></button></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 product-card-wrapper" data-category="hat">
                    <div class="product-card">
                        <div class="product-img-container"><img src="{{ asset('assets/topi/hat3.png') }}" alt="Urban Vibe Premium Knit Beanie Black"></div>
                        <div class="product-info">
                            <span class="product-category">HAT</span>
                            <h5 class="mt-2 text-truncate">Premium Knit Beanie Black</h5>
                            <div class="d-flex justify-content-between align-items-center mt-3"><span class="fw-bold fs-5 text-primary">Rp 99.000</span><button class="btn btn-sm btn-premium"><i class="bi bi-plus-lg"></i></button></div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-3 product-card-wrapper" data-category="hat">
                    <div class="product-card">
                        <div class="product-img-container"><img src="{{ asset('assets/topi/hat4.png') }}" alt="Urban Vibe Industrial Typography Snapback"></div>
                        <div class="product-info">
                            <span class="product-category">HAT</span>
                            <h5 class="mt-2 text-truncate">Industrial Typography Snapback</h5>
                            <div class="d-flex justify-content-between align-items-center mt-3"><span class="fw-bold fs-5 text-primary">Rp 145.000</span><button class="btn btn-sm btn-premium"><i class="bi bi-plus-lg"></i></button></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CSS STYLING -->
    <style>
        .btn-category {
            background-color: #111111;
            color: #b3b3b3;
            border: 1px solid #2d2d2d;
            padding: 8px 20px;
            border-radius: 8px;
            transition: all 0.3s ease;
            font-weight: 500;
        }
        .btn-category:hover {
            color: #ffffff;
            border-color: #0d6efd;
            background-color: rgba(13, 110, 253, 0.1);
        }
        .active-category {
            background-color: #0d6efd !important;
            border-color: #0d6efd !important;
            color: #ffffff !important;
            box-shadow: 0 0 12px rgba(13, 110, 253, 0.4);
        }
        .product-card {
            background: #111;
            border: 1px solid #222;
            border-radius: 16px;
            padding: 12px;
            height: 100%;
            transition: all 0.3s ease;
        }
        .product-card:hover {
            border-color: #333;
            transform: translateY(-4px);
        }
        .product-img-container {
            width: 100%;
            height: 260px;
            overflow: hidden;
            border-radius: 12px;
            background-color: #1a1a1a;
        }
        .product-img-container img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }
        .product-card:hover .product-img-container img {
            transform: scale(1.05);
        }
        .product-info {
            padding: 12px 4px 4px 4px;
        }
        .product-category {
            font-size: 0.75rem;
            color: #0d6efd;
            font-weight: 700;
            letter-spacing: 1px;
        }
        .btn-premium {
            background-color: #222;
            border: 1px solid #333;
            color: #fff;
            border-radius: 8px;
            width: 32px;
            height: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s;
        }
        .product-card:hover .btn-premium {
            background-color: #0d6efd;
            border-color: #0d6efd;
        }
    </style>

    <!-- JS FILTER LOGIC -->
    <script>
        function filterCategory(category, buttonElement) {
            document.querySelectorAll('.btn-category').forEach(btn => {
                btn.classList.remove('active-category');
            });
            buttonElement.classList.add('active-category');

            const products = document.querySelectorAll('.product-card-wrapper');
            const titleElement = document.getElementById('gallery-title');
            const descElement = document.getElementById('gallery-desc');

            if (category === 'all') {
                titleElement.innerHTML = 'Semua <span class="text-primary">Kategori</span>';
                descElement.innerText = 'Menampilkan semua koleksi produk terbaik';
            } else {
                const categoryName = buttonElement.innerText;
                titleElement.innerHTML = `Koleksi <span class="text-primary">${categoryName}</span>`;
                descElement.innerText = `Menampilkan produk khusus dalam kategori ${categoryName}`;
            }

            products.forEach(product => {
                const productCategory = product.getAttribute('data-category');
                if (category === 'all' || productCategory === category) {
                    product.style.display = 'block';
                } else {
                    product.style.display = 'none';
                }
            });
        }
    </script>
@endsection
