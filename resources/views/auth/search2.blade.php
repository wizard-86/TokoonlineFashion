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

            <div class="row mb-5">
                <div class="col-12">
                    <div class="d-flex gap-2 flex-wrap w-100">
                        <button class="btn btn-sm btn-category active-category" onclick="filterCategory('all', this)">All Kategori</button>
                        @foreach($categories as $category)
                            <button class="btn btn-sm btn-category" onclick="filterCategory('{{ $category->id }}', this)">{{ $category->name }}</button>
                        @endforeach
                    </div>
                    <p id="categoryDescription" class="text-muted small mt-3 italic mb-0">Menampilkan semua item koleksi pakaian.</p>
                </div>
            </div>

            <div class="row g-4" id="productGrid">
                @foreach($products as $product)
                    <div class="col-md-6 col-lg-3 product-card-wrapper" data-category="{{ $product->category_id }}">
                        <div class="product-card">
                            <div class="product-img-container">
                                <img src="{{ asset('assets/' . ($product->image ?? 'default.png')) }}" alt="{{ $product->name }}" class="product-img">
                            </div>
                            <div class="product-info">
                                <span class="product-category text-uppercase">{{ $product->category->name ?? 'STREETWEAR' }}</span>
                                <a href="{{ route('product.detail', $product->id) }}" class="text-decoration-none">
                                    <h5 class="fw-bold my-1 text-white text-truncate">{{ $product->name }}</h5>
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

    <script>
        function filterCategory(categoryId, button) {
            document.querySelectorAll('.btn-category').forEach(btn => btn.classList.remove('active-category'));
            button.classList.add('active-category');

            const products = document.querySelectorAll('.product-card-wrapper');
            const descElement = document.getElementById('categoryDescription');

            if (categoryId === 'all') {
                descElement.innerText = "Menampilkan semua item koleksi pakaian.";
            } else {
                const categoryName = button.innerText;
                descElement.innerText = `Menampilkan produk khusus dalam kategori ${categoryName}`;
            }

            products.forEach(product => {
                const productCategory = product.getAttribute('data-category');
                if (categoryId === 'all' || String(productCategory) === String(categoryId)) {
                    product.classList.remove('d-none');
                } else {
                    product.classList.add('d-none');
                }
            });
        }

        document.getElementById('searchInput').addEventListener('input', function() {
            const searchValue = this.value.toLowerCase();
            const products = document.querySelectorAll('.product-card-wrapper');

            products.forEach(product => {
                const productName = product.querySelector('h5').innerText.toLowerCase();
                if (productName.includes(searchValue)) {
                    product.classList.remove('d-none');
                } else {
                    product.classList.add('d-none');
                }
            });
        });
    </script>
@endsection
