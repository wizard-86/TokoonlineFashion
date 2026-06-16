@extends('layouts.app')

@section('title', 'URBAN VIBE | Keranjang Belanja')

@section('content')
<section class="py-5 my-5" style="background-color: #0b0b0b;">
    <div class="container pt-5 text-white">
        <h2 class="fw-bold mb-4"><i class="bi bi-cart3 text-primary me-2"></i>Keranjang Belanja</h2>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show border-0 text-white rounded-3 mb-4" style="background-color: #198754;" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show border-0 text-white rounded-3 mb-4" style="background-color: #dc3545;" role="alert">
                <i class="bi bi-exclamation-triangle-fill me-2"></i> {{ session('error') }}
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if($cartDetails->isEmpty())
            {{-- KONDISI JIKA KERANJANG KOSONG --}}
            <div class="p-5 bg-dark rounded-4 border border-secondary text-center">
                <div class="fs-1 mb-3 text-secondary"><i class="bi bi-cart-x"></i></div>
                <h5 class="m-0 text-secondary">Keranjang belanja Anda masih kosong.</h5>
                <p class="text-muted small mt-2">Jelajahi koleksi premium kami untuk menemukan gaya streetwear terbaikmu.</p>
                <a href="{{ route('collection') }}" class="btn btn-primary px-4 py-2 mt-3 rounded-pill fw-bold">Mulai Belanja</a>
            </div>
        @else
            {{-- KONDISI JIKA KERANJANG ADA ISINYA --}}
            <div class="row g-4">
                <div class="col-lg-8">
                    <div class="card bg-dark rounded-4 border border-secondary p-3 p-md-4">
                        <div class="table-responsive">
                            <table class="table table-dark table-borderless align-middle m-0">
                                <thead>
                                    <tr class="text-secondary border-bottom border-secondary fs-6">
                                        <th scope="col" class="pb-3" style="min-width: 250px;">Produk</th>
                                        <th scope="col" class="pb-3 text-center">Harga</th>
                                        <th scope="col" class="pb-3 text-center" style="width: 140px;">Jumlah</th>
                                        <th scope="col" class="pb-3 text-end">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $totalSemua = 0; @endphp
                                    @foreach($cartDetails as $detail)
                                        @php
                                            $subtotalItem = $detail->product->price * $detail->quantity;
                                            $totalSemua += $subtotalItem;
                                        @endphp
                                        <tr class="border-bottom border-dark-subtle">
                                            <td class="py-4">
                                                <div class="d-flex align-items-center">
                                                    <div class="rounded-3 bg-secondary overflow-hidden me-3" style="width: 70px; height: 70px; min-width: 70px;">
                                                        <img src="{{ $detail->product->image ? asset('assets/' . $detail->product->image) : asset('assets/kategori/product1.png') }}" alt="{{ $detail->product->name }}" class="w-100 h-100 object-fit-cover">
                                                    </div>
                                                    <div>
                                                        <h6 class="mb-1 fw-semibold text-white text-truncate" style="max-width: 200px;" title="{{ $detail->product->name }}">
                                                            {{ $detail->product->name }}
                                                        </h6>
                                                        <small class="text-primary fw-bold" style="font-size: 0.75rem; letter-spacing: 0.5px;">
                                                            {{ $detail->product->category ? strtoupper($detail->product->category->name) : 'STREETWEAR' }}
                                                        </small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-center py-4">Rp {{ number_format($detail->product->price, 0, ',', '.') }}</td>
                                            <td class="py-4">
                                                <div class="d-flex flex-column align-items-center">

                                                    {{-- FORM PENGATUR QUANTITY (TOMBOL MINUS, INPUT, TOMBOL PLUS) --}}
                                                    <div class="d-flex align-items-center border border-secondary rounded-2 overflow-hidden bg-transparent" style="max-width: 120px; height: 32px;">

                                                        {{-- Tombol Kurang Sifatnya Mengupdate Angka Quantity - 1 --}}
                                                        <form action="{{ route('cart.update', $detail->id) }}" method="POST" class="m-0 h-100">
                                                            @csrf
                                                            @method('PUT')
                                                            <input type="hidden" name="quantity" value="{{ $detail->quantity - 1 }}">
                                                            <button class="btn btn-outline-secondary border-0 px-2 h-100 rounded-0 d-flex align-items-center justify-content-center" type="submit">
                                                                <i class="bi bi-dash text-white"></i>
                                                            </button>
                                                        </form>

                                                        <input type="text" class="form-control bg-transparent text-white border-0 text-center fw-bold fs-6 p-0 h-100" style="width: 40px; pointer-events: none;" value="{{ $detail->quantity }}" readonly>

                                                        {{-- Tombol Tambah Sifatnya Mengupdate Angka Quantity + 1 --}}
                                                        <form action="{{ route('cart.update', $detail->id) }}" method="POST" class="m-0 h-100">
                                                            @csrf
                                                            @method('PUT')
                                                            <input type="hidden" name="quantity" value="{{ $detail->quantity + 1 }}">
                                                            <button class="btn btn-outline-secondary border-0 px-2 h-100 rounded-0 d-flex align-items-center justify-content-center" type="submit">
                                                                <i class="bi bi-plus text-white"></i>
                                                            </button>
                                                        </form>
                                                    </div>

                                                    {{-- TOMBOL HAPUS BARANG (Hanya 1 Form Valid Menggunakan $detail->id) --}}
                                                    <div class="text-center mt-2">
                                                        <form action="{{ route('cart.destroy', $detail->id) }}" method="POST" class="m-0" onsubmit="return confirm('Apakah Anda yakin ingin menghapus produk ini dari keranjang?')">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-link text-danger p-0 text-decoration-none" style="font-size: 0.8rem;">
                                                                <i class="bi bi-trash3 me-1"></i>Hapus
                                                            </button>
                                                        </form>
                                                    </div>

                                                </div>
                                            </td>
                                            <td class="text-end fw-bold text-primary py-4">Rp {{ number_format($subtotalItem, 0, ',', '.') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="mt-4">
                            <a href="{{ route('collection') }}" class="text-secondary text-decoration-none small fw-medium hover-white">
                                <i class="bi bi-arrow-left me-2"></i>Lanjutkan Belanja
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="card bg-dark rounded-4 border border-secondary p-4 shadow-sm position-sticky" style="top: 100px;">
                        <h5 class="fw-bold mb-4 border-bottom border-secondary pb-2">Ringkasan Belanja</h5>

                        <div class="d-flex justify-content-between mb-2 text-secondary">
                            <span>Total Harga ({{ $cartDetails->sum('quantity') }} Barang)</span>
                            <span>Rp {{ number_format($totalSemua, 0, ',', '.') }}</span>
                        </div>
                        <div class="d-flex justify-content-between mb-3 text-secondary">
                            <span>Biaya Pengiriman</span>
                            <span class="text-success fw-medium">Otomatis di Kasir</span>
                        </div>

                        <hr class="border-secondary my-3">

                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <span class="fw-semibold">Total Belanja</span>
                            <h4 class="text-primary fw-bold mb-0">Rp {{ number_format($totalSemua, 0, ',', '.') }}</h4>
                        </div>

                        <a href="{{ route('checkout.index') }}" class="btn btn-premium w-100 py-3 rounded-3 fw-bold fs-5 shadow-sm text-center text-decoration-none">
                            <i class="bi bi-shield-check me-2"></i>Lanjut ke Checkout
                        </a>
                    </div>
                </div>
            </div>
        @endif
    </div>
</section>

<style>
    .table-dark {
        --bs-table-bg: transparent !important;
    }
    .object-fit-cover {
        object-fit: cover;
    }
    .hover-white:hover {
        color: #ffffff !important;
        transition: color 0.2s;
    }
    .btn-premium {
        background-color: #0d6efd;
        border: 1px solid #0d6efd;
        color: #fff;
        transition: all 0.3s ease;
    }
    .btn-premium:hover {
        background-color: #0b5ed7;
        border-color: #0a58ca;
        color: #fff;
        box-shadow: 0 0 15px rgba(13, 110, 253, 0.4);
    }
</style>
@endsection
