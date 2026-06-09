@extends('layouts.app')

@section('title', 'URBAN VIBE | Premium Collection')

@section('content')
    <section class="py-5 my-5" style="background-color: #0b0b0b;">
        <div class="container pt-5 text-white">

            <div class="mb-4">
                <h2 class="fw-bold text-white tracking-wide">OUR <span class="text-primary">COLLECTION</span></h2>
                <p class="text-secondary small">Menampilkan produk streetwear terbaik khusus untuk kamu</p>
            </div>

            <div class="row mb-5">
                <div class="col-12">
                    <div class="input-group input-group-lg shadow-sm">
                        <input type="text" id="searchInput" class="form-control bg-dark text-white border-secondary py-3 px-4 focus-primary" placeholder="Cari produk distro favoritmu...">
                        <button class="btn btn-primary px-5 fw-bold"><i class="bi bi-search me-2"></i> Cari</button>
                    </div>
                </div>
            </div>

            <h5 class="mb-3 text-secondary small fw-bold tracking-wide">KATEGORI POPULER</h5>
            <div class="d-flex gap-2 flex-wrap mb-5">
                <button class="btn btn-sm btn-category active-category" onclick="filterCategory('all', this)">All Kategori</button>
                @foreach($categories as $category)
                    <button class="btn btn-sm btn-category" onclick="filterCategory('{{ $category->id }}', this)">
                        {{ ucfirst($category->name) }}
                    </button>
                @endforeach
            </div>

            <hr class="border-secondary my-5 opacity-25">

            <div class="mb-4">
                <h4 class="fw-bold m-0" id="gallery-title">Semua <span class="text-primary">Kategori</span></h4>
                <p class="text-secondary small m-0" id="gallery-desc">Menampilkan semua koleksi produk terbaik</p>
            </div>

            <div class="row g-4" id="productContainer">
                @if($products->isEmpty())
                    <div class="col-12 text-center py-5">
                        <i class="bi bi-box-seam fs-1 text-secondary"></i>
                        <p class="text-secondary mt-3">Belum ada produk yang tersedia saat ini.</p>
                    </div>
                @else
                    @foreach($products as $product)
                        <div class="col-md-6 col-lg-3 product-card-wrapper" data-category="{{ $product->category_id }}">
                            <div class="product-card">

                                <div class="product-img-container">
                                    <a href="{{ route('product.show', $product->id) }}">
                                        <img src="{{ $product->image ? asset('assets/' . $product->image) : asset('assets/kategori/product1.png') }}" alt="{{ $product->name }}">
                                    </a>
                                </div>

                                <div class="product-info">
                                    <span class="product-category">
                                        {{ $product->category ? strtoupper($product->category->name) : 'STREETWEAR' }}
                                    </span>

                                    <h5 class="mt-2 text-truncate" title="{{ $product->name }}">
                                        <a href="{{ route('product.show', $product->id) }}" class="text-white text-decoration-none">
                                            {{ $product->name }}
                                        </a>
                                    </h5>

                                    <div class="d-flex justify-content-between align-items-center mt-3">
                                        <span class="fw-bold fs-5 text-primary">
                                            Rp {{ number_format($product->price, 0, ',', '.') }}
                                        </span>

                                        <form action="{{ route('cart.add', $product->id) }}" method="POST" class="m-0">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-premium" title="Tambah ke Keranjang">
                                                <i class="bi bi-plus-lg"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>

                            </div>
                        </div>
                    @endforeach
                @endif
            </div>

        </div>
    </section>

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
        .focus-primary:focus {
            background-color: #1f1f1f !important;
            border-color: #0d6efd !important;
            box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25) !important;
            color: #fff !important;
        }
    </style>

    <script>
        function filterCategory(categoryId, buttonElement) {
            // 1. Ubah status aktif tombol
            document.querySelectorAll('.btn-category').forEach(btn => {
                btn.classList.remove('active-category');
            });
            buttonElement.classList.add('active-category');

            const products = document.querySelectorAll('.product-card-wrapper');
            const titleElement = document.getElementById('gallery-title');
            const descElement = document.getElementById('gallery-desc');

            // 2. Ubah teks judul galeri secara dinamis
            if (categoryId === 'all') {
                titleElement.innerHTML = 'Semua <span class="text-primary">Kategori</span>';
                descElement.innerText = 'Menampilkan semua koleksi produk terbaik';
            } else {
                const categoryName = buttonElement.innerText;
                titleElement.innerHTML = `Koleksi <span class="text-primary">${categoryName}</span>`;
                descElement.innerText = `Menampilkan produk khusus dalam kategori ${categoryName}`;
            }

            // 3. Filter produk berdasarkan ID Kategori (Akurat & Pasti Cocok)
            products.forEach(product => {
                const productCategory = product.getAttribute('data-category');

                // Pastikan konversi string ke string untuk perbandingan javascript aman
                if (categoryId === 'all' || String(productCategory) === String(categoryId)) {
                    product.style.display = 'block';
                } else {
                    product.style.display = 'none';
                }
            });
        }

        // Live Search Real-time bawaan kolom teks pencarian
        document.getElementById('searchInput').addEventListener('input', function() {
            const searchValue = this.value.toLowerCase();
            const products = document.querySelectorAll('.product-card-wrapper');

            products.forEach(product => {
                const productName = product.querySelector('h5').innerText.toLowerCase();
                if (productName.includes(searchValue)) {
                    product.style.display = 'block';
                } else {
                    product.style.display = 'none';
                }
            });
        });
    </script>
@endsection
