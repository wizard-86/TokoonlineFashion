@extends('layouts.app')

@section('title', 'URBAN VIBE | ' . $product->name)

@section('content')
<section class="py-5 my-5" style="background-color: #0b0b0b;">
    <div class="container pt-5 text-white">

        <div class="mb-4">
            <a href="{{ url()->previous() }}" class="text-decoration-none text-secondary small fw-bold back-link">
                <i class="bi bi-arrow-left me-2"></i> BACK TO COLLECTION
            </a>
        </div>

        <div class="row g-5">
            <div class="col-md-12 col-lg-6">
                <div class="detail-img-container shadow">
                    <img src="{{ asset('assets/' . $product->image) }}" alt="{{ $product->name }}" class="img-fluid detail-img">
                </div>
            </div>

            <div class="col-md-12 col-lg-6 d-flex flex-column justify-content-between">
                <div>
                    <span class="text-primary fw-bold tracking-wide text-uppercase small">{{ $product->category }}</span>
                    <h1 class="fw-bold mt-2 mb-3 display-5">{{ $product->name }}</h1>

                    <h3 class="text-primary fw-bold mb-4">Rp {{ number_format($product->price, 0, ',', '.') }}</h3>

                    <hr class="border-secondary opacity-25 my-4">

                    <h6 class="text-secondary small fw-bold tracking-wide mb-3">PRODUCT DESCRIPTION</h6>
                    <p class="text-white-50 lh-lg mb-4 fs-6 text-justify">
                        {{ $product->description }}
                    </p>

                    <h6 class="text-secondary small fw-bold tracking-wide mb-3">SELECT SIZE (EU)</h6>
                    <div class="d-flex gap-2 flex-wrap mb-5">
                        <button class="btn btn-size active">40</button>
                        <button class="btn btn-size">41</button>
                        <button class="btn btn-size">42</button>
                        <button class="btn btn-size">43</button>
                        <button class="btn btn-size">44</button>
                    </div>
                </div>

                <div class="row g-3 mt-auto">
                    <div class="col-8 col-md-9">
                        <a href="{{ route('checkout') }}" class="btn btn-checkout w-100 py-3 fw-bold text-uppercase">
                            <i class="bi bi-bag-check-fill me-2"></i> Buy Now
                        </a>
                    </div>

                    <div class="col-4 col-md-3">
                        <form action="{{ route('cart.add', $product->id) }}" method="POST" class="h-100">
                            @csrf
                            <button type="submit" class="btn btn-add-cart w-100 h-100 py-3" title="Add to Cart">
                                <i class="bi bi-cart-plus fs-4"></i>
                            </button>
                        </form>
                    </div>
                </div>

            </div>
        </div>

    </div>
</section>

<style>
    .tracking-wide {
        letter-spacing: 2px;
    }
    .back-link {
        transition: color 0.2s;
    }
    .back-link:hover {
        color: #0d6efd !important;
    }
    /* Kotak Foto */
    .detail-img-container {
        background-color: #111111;
        border: 1px solid #222;
        border-radius: 24px;
        padding: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        min-height: 450px;
    }
    .detail-img {
        max-height: 400px;
        object-fit: contain;
        transition: transform 0.5s ease;
    }
    .detail-img-container:hover .detail-img {
        transform: scale(1.05);
    }
    /* Tombol Ukuran */
    .btn-size {
        background-color: #111;
        color: #fff;
        border: 1px solid #333;
        padding: 10px 20px;
        border-radius: 10px;
        font-weight: 500;
        transition: all 0.2s;
    }
    .btn-size:hover {
        border-color: #0d6efd;
        color: #0d6efd;
    }
    .btn-size.active {
        background-color: #0d6efd;
        border-color: #0d6efd;
        color: #fff;
        box-shadow: 0 0 12px rgba(13, 110, 253, 0.3);
    }
    /* Tombol Buy Now / Checkout */
    .btn-checkout {
        background-color: #0d6efd;
        color: #fff;
        border: none;
        border-radius: 14px;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(13, 110, 253, 0.2);
    }
    .btn-checkout:hover {
        background-color: #0b5ed7;
        color: #fff;
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(13, 110, 253, 0.4);
    }
    /* Tombol Tambah Keranjang */
    .btn-add-cart {
        background-color: #161616;
        color: #b3b3b3;
        border: 1px solid #2d2d2d;
        border-radius: 14px;
        transition: all 0.3s;
    }
    .btn-add-cart:hover {
        background-color: rgba(13, 110, 253, 0.1);
        border-color: #0d6efd;
        color: #0d6efd;
        transform: translateY(-2px);
    }
    .text-justify {
        text-align: justify;
    }
</style>
@endsection
