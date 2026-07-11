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
                <!-- Dibungkus form utama agar pilihan size & quantity terkirim bersamaan -->
                <form action="{{ route('cart.add', $product->id) }}" method="POST" class="d-flex flex-column h-100 justify-content-between m-0">
                    @csrf
                    <div>
                        <div class="mb-2">
                            <span class="badge bg-primary text-white px-3 py-1.5 rounded-pill fw-bold" style="font-size: 0.75rem; letter-spacing: 0.5px;">
                                <i class="bi bi-shop me-1"></i> URBAN VIBE OFFICIAL STORE
                            </span>
                        </div>

                        <span class="text-primary fw-bold tracking-wide text-uppercase small">{{ $product->category->name ?? 'STREETWEAR' }}</span>
                        <h1 class="fw-bold mt-2 mb-3 display-5">{{ $product->name }}</h1>

                        <h3 class="text-primary fw-bold mb-4">Rp {{ number_format($product->price, 0, ',', '.') }}</h3>

                        <div class="mb-4 p-3 rounded-4 border border-secondary border-opacity-50" style="background-color: #111;">
                            <div class="row align-items-center text-center text-sm-start">
                                <div class="col-sm-6 mb-2 mb-sm-0">
                                    <span class="text-secondary small d-block mb-1">Status Barang</span>
                                    @if(($product->stock ?? 0) > 0)
                                        <span class="text-success fw-bold"><i class="bi bi-patch-check-fill me-1"></i> Ready Stock</span>
                                    @else
                                        <span class="text-danger fw-bold"><i class="bi bi-x-circle-fill me-1"></i> Out of Stock</span>
                                    @endif
                                </div>
                                <div class="col-sm-6 text-sm-end">
                                    <span class="text-secondary small d-block mb-1">Tersedia Sisa</span>
                                    <span class="badge bg-secondary text-dark fw-bolder px-3 py-2 fs-6">{{ $product->stock ?? 0 }} Pcs</span>
                                </div>
                            </div>
                        </div>

                        <hr class="border-secondary opacity-25 my-4">

                        <h6 class="text-secondary small fw-bold tracking-wide mb-3">PRODUCT DESCRIPTION & MATERIALS</h6>
                        <p class="text-secondary lh-base fs-5" style="text-align: justify;">
                            {{ $product->description ?? 'Pakaian streetwear eksklusif produksi Urban Vibe. Dibuat menggunakan bahan material kain katun premium pilihan berkualitas tinggi.' }}
                        </p>

                        <h6 class="text-secondary small fw-bold tracking-wide mt-4 mb-3">AVAILABLE SIZE</h6>
                        <div class="d-flex gap-2 flex-wrap">
                            @if(!empty($product->sizes))
                                @php
                                    $sizeArray = explode(',', $product->sizes);
                                @endphp
                                @foreach($sizeArray as $index => $size)
                                    @php $trimmedSize = trim($size); @endphp
                                    <input type="radio" class="btn-check" name="size" id="size_{{ $trimmedSize }}" value="{{ $trimmedSize }}" {{ $index === 0 ? 'checked' : '' }} required>
                                    <label class="btn btn-size" for="size_{{ $trimmedSize }}">{{ $trimmedSize }}</label>
                                @endforeach
                            @else
                                <!-- Pilihan otomatis (Fallback) jika data kolom 'sizes' di database masih kosong/null -->
                                @if(isset($product->category) && stripos($product->category->name, 'sepatu') !== false)
                                    @foreach(range(38, 43) as $index => $numSize)
                                        <input type="radio" class="btn-check" name="size" id="size_{{ $numSize }}" value="{{ $numSize }}" {{ $index === 0 ? 'checked' : '' }} required>
                                        <label class="btn btn-size" for="size_{{ $numSize }}">{{ $numSize }}</label>
                                    @endforeach
                                @else
                                    @foreach(['S', 'M', 'L', 'XL', 'XXL'] as $index => $letterSize)
                                        <input type="radio" class="btn-check" name="size" id="size_{{ $letterSize }}" value="{{ $letterSize }}" {{ $index === 1 ? 'checked' : '' }} required>
                                        <label class="btn btn-size" for="size_{{ $letterSize }}">{{ $letterSize }}</label>
                                    @endforeach
                                @endif
                            @endif
                        </div>
                    </div>

                    <div class="mt-5">
                        <div class="d-flex flex-column flex-sm-row gap-3">
                            <div class="d-flex border border-secondary rounded-4 overflow-hidden bg-dark" style="max-width: 130px; height: 55px;">
                                <button type="button" class="btn btn-dark border-0 px-3 fs-5" onclick="this.parentNode.querySelector('input[type=number]').stepDown()">-</button>
                                <input type="number" name="quantity" value="1" min="1" max="{{ $product->stock ?? 1 }}" class="form-control bg-transparent border-0 text-center text-white fw-bold fs-5 p-0 no-spinner" style="width: 50px;">
                                <button type="button" class="btn btn-dark border-0 px-3 fs-5" onclick="this.parentNode.querySelector('input[type=number]').stepUp()">+</button>
                            </div>

                            <!-- PERBAIKAN: Menggunakan icon keranjang belanja yang tepat (bi-cart-plus-fill) -->
                            <button type="submit" class="btn btn-checkout flex-grow-1 py-3 fw-bold fs-5 {{ ($product->stock ?? 0) <= 0 ? 'disabled' : '' }}">
                                <i class="bi bi-cart-plus-fill me-2"></i> {{ ($product->stock ?? 0) <= 0 ? 'OUT OF STOCK' : 'ADD TO CART' }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<style>
    .detail-img-container { background-color: #111; border-radius: 20px; border: 1px solid #222; overflow: hidden; }
    .detail-img { width: 100%; height: auto; object-fit: cover; transition: transform 0.5s ease; }
    .detail-img-container:hover .detail-img { transform: scale(1.05); }

    /* Style Tombol Size Menggunakan Bootstrap Radio Component */
    .btn-size { background-color: #111; color: #fff; border: 1px solid #333; padding: 10px 20px; border-radius: 10px; font-weight: 500; transition: all 0.2s; cursor: pointer; }
    .btn-size:hover { border-color: #0d6efd; color: #0d6efd; background-color: rgba(13, 110, 253, 0.05); }
    .btn-check:checked + .btn-size { background-color: #0d6efd !important; border-color: #0d6efd !important; color: #fff !important; box-shadow: 0 0 12px rgba(13, 110, 253, 0.4); }

    .btn-checkout { background-color: #0d6efd; color: #fff; border: none; border-radius: 14px; transition: all 0.3s ease; box-shadow: 0 4px 15px rgba(13, 110, 253, 0.2); }
    .btn-checkout:hover { background-color: #0b5ed7; color: #fff; }

    .no-spinner::-webkit-outer-spin-button,
    .no-spinner::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }
    .no-spinner {
        -moz-appearance: textfield;
    }
</style>
@endsection
