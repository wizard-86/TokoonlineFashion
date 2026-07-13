@extends('layouts.app')

@section('title', 'URBAN VIBE | Search Product')

@section('content')
    <section class="py-5 my-5" style="background-color: #0b0b0b;">
        <div class="container pt-5 text-white">

            <!-- Notifikasi berhasil ditambahkan ke keranjang -->
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show border-0 mb-4" role="alert" style="background-color: #198754; color: white;">
                    <i class="bi bi-check-circle me-2"></i> {{ session('success') }}
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="mb-4">
                <h2 class="fw-bold text-white tracking-wide">SEARCH <span class="text-primary">PRODUCT</span></h2>
                <p class="text-secondary small">Ketik nama produk distro dan pilih kotak kategori favoritmu</p>
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

            <div class="row mb-5">
                <div class="col-12">
                    <div class="d-flex gap-2 flex-wrap w-100">
                        <button class="btn btn-sm btn-category active-category" onclick="filterCategory('all', this)">All Kategori</button>
                        @foreach($categories as $category)
                            <button class="btn btn-sm btn-category" onclick="filterCategory('{{ $category->id }}', this)">{{ $category->name }}</button>
                        @endforeach
                    </div>
                    <p id="categoryDescription" class="text-secondary small mt-3 italic text-muted">Menampilkan semua item koleksi pakaian.</p>
                </div>
            </div>

            <div class="row g-4" id="productsGrid">
                @foreach($products as $product)
                    <div class="col-6 col-md-4 col-lg-3 product-card-wrapper" data-category="{{ $product->category_id }}">
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

    <style>
        .btn-category { background-color: #1a1a1a; color: #b3b3b3; border: 1px solid #333; padding: 10px 20px; border-radius: 8px; font-weight: 500; transition: all 0.2s ease; }
        .btn-category:hover { border-color: #0d6efd; color: #fff; }
        .active-category { background-color: #0d6efd !important; border-color: #0d6efd !important; color: #fff !important; }
        .focus-primary:focus { background-color: #1a1a1a !important; border-color: #0d6efd !important; box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25); color: #fff; }
    </style>

    <script>
        function filterCategory(categoryId, button) {
            document.querySelectorAll('.btn-category').forEach(btn => btn.classList.remove('active-category'));
            button.classList.add('active-category');
            const products = document.querySelectorAll('.product-card-wrapper');
            const descElement = document.getElementById('categoryDescription');
            descElement.innerText = categoryId === 'all' ? "Menampilkan semua item koleksi pakaian." : `Menampilkan produk khusus dalam kategori ${button.innerText}`;
            products.forEach(product => {
                const productCategory = product.getAttribute('data-category');
                product.classList.toggle('d-none', !(categoryId === 'all' || String(productCategory) === String(categoryId)));
            });
        }

        document.getElementById('searchInput').addEventListener('input', function() {
            const searchValue = this.value.toLowerCase();
            document.querySelectorAll('.product-card-wrapper').forEach(product => {
                const productName = product.querySelector('h5').innerText.toLowerCase();
                product.classList.toggle('d-none', !productName.includes(searchValue));
            });
        });
    </script>
@endsection
