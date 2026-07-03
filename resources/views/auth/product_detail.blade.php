@extends('layouts.app')

@section('title', 'URBAN VIBE | ' . $product->name)

@section('content')
<section class="py-5 my-5" style="background-color: #0b0b0b;">
    <div class="container pt-5 text-white">

        <div class="mb-4">
            <a href="{{ route('collection') }}" class="text-decoration-none text-secondary small fw-bold back-link">
                <i class="bi bi-arrow-left me-2"></i> BACK TO COLLECTION
            </a>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show border-0 text-white rounded-3 mb-4" style="background-color: #198754;" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="row g-5">
            <div class="col-md-12 col-lg-6">
                <div class="detail-img-container shadow">
                    <img src="{{ asset('assets/' . ($product->image ?? 'default.png')) }}" alt="{{ $product->name }}" class="img-fluid detail-img">
                </div>
            </div>

            <div class="col-md-12 col-lg-6 d-flex flex-column justify-content-between">
                <div>
                    <span class="text-primary fw-bold tracking-wide text-uppercase small">{{ $product->category->name ?? 'STREETWEAR' }}</span>
                    <h1 class="fw-bold mt-2 mb-3 display-5">{{ $product->name }}</h1>

                    <h3 class="text-primary fw-bold mb-4">Rp {{ number_format($product->price, 0, ',', '.') }}</h3>

                    <hr class="border-secondary opacity-25 my-4">

                    <h6 class="text-secondary small fw-bold tracking-wide mb-3">PRODUCT DESCRIPTION</h6>
                    <p class="text-secondary lh-base fs-5">{{ $product->description ?? 'Tidak ada deskripsi untuk produk ini.' }}</p>

                    <h6 class="text-secondary small fw-bold tracking-wide mt-4 mb-3">AVAILABLE SIZE</h6>
                    <div class="d-flex gap-2">
                        <button class="btn btn-size active">M</button>
                        <button class="btn btn-size">L</button>
                        <button class="btn btn-size">XL</button>
                    </div>
                </div>

                <div class="mt-5">
                    <form action="{{ route('cart.add', $product->id) }}" method="POST" class="d-flex flex-column flex-sm-row gap-3">
                        @csrf
                        <div class="d-flex border border-secondary rounded-4 overflow-hidden bg-dark" style="max-width: 130px; height: 55px;">
                            <button type="button" class="btn btn-dark border-0 px-3 fs-5" onclick="this.parentNode.querySelector('input[type=number]').stepDown()">-</button>
                            <input type="number" name="quantity" value="1" min="1" class="form-control bg-transparent border-0 text-center text-white fw-bold fs-5 p-0" style="width: 50px;">
                            <button type="button" class="btn btn-dark border-0 px-3 fs-5" onclick="this.parentNode.querySelector('input[type=number]').stepUp()">+</button>
                        </div>
                        <button type="submit" class="btn btn-checkout flex-grow-1 py-3 fw-bold fs-5">
                            <i class="bi bi-bag-plus-fill me-2"></i> ADD TO CART
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    .detail-img-container { background-color: #111; border-radius: 20px; border: 1px solid #222; overflow: hidden; }
    .detail-img { width: 100%; height: auto; object-fit: cover; transition: transform 0.5s ease; }
    .detail-img-container:hover .detail-img { transform: scale(1.05); }
    .btn-size { background-color: #111; color: #fff; border: 1px solid #333; padding: 10px 20px; border-radius: 10px; font-weight: 500; transition: all 0.2s; }
    .btn-size:hover { border-color: #0d6efd; color: #0d6efd; }
    .btn-size.active { background-color: #0d6efd; border-color: #0d6efd; color: #fff; box-shadow: 0 0 12px rgba(13, 110, 253, 0.3); }
    .btn-checkout { background-color: #0d6efd; color: #fff; border: none; border-radius: 14px; transition: all 0.3s ease; box-shadow: 0 4px 15px rgba(13, 110, 253, 0.2); }
    .btn-checkout:hover { background-color: #0b5ed7; color: #fff; }
</style>
@endsection
