@extends('layouts.app')

@section('title', 'URBAN VIBE | Checkout')

@section('content')
<section class="py-5 my-5" style="background-color: #0b0b0b;">
    <div class="container pt-5 text-white">
        <h2 class="fw-bold mb-4"><i class="bi bi-shield-check text-primary me-2"></i>Checkout Pesanan</h2>

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show border-0 text-white rounded-3 mb-4" style="background-color: #dc3545;" role="alert">
                <i class="bi bi-exclamation-triangle-fill me-2"></i> {{ session('error') }}
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="row g-4">
            {{-- KOLOM KIRI: FORM ALAMAT & PENGIRIMAN --}}
            <div class="col-lg-7">
                <div class="card bg-dark rounded-4 border border-secondary p-4">
                    <h5 class="fw-bold mb-4 border-bottom border-secondary pb-2">Informasi Pengiriman</h5>

                    {{-- Ganti URL action route sesuai dengan route POST proses checkout Anda (misal: checkout.store atau checkout.process) --}}
                    <form action="{{ route('checkout.store') }}" method="POST">
                        @csrf

                        <!-- Input Alamat Lengkap -->
                        <div class="mb-4">
                            <label for="address" class="form-label text-secondary fw-medium small">Alamat Lengkap Pengiriman</label>
                            <textarea name="address" id="address" rows="4" class="form-control bg-transparent text-white border-secondary custom-focus" placeholder="Masukkan alamat lengkap rumah, nomor blok, RT/RW, dan kode pos..." required></textarea>
                        </div>

                        <div class="row">
                            <!-- Pilihan Kurir -->
                            <div class="col-md-6 mb-4">
                                <label for="courier" class="form-label text-secondary fw-medium small">Jasa Pengiriman (Kurir)</label>
                                <select name="courier" id="courier" class="form-select bg-dark text-white border-secondary custom-focus" required>
                                    <option value="JNE" selected>JNE (Reguler)</option>
                                    <option value="J&T">J&T Express</option>
                                    <option value="SICEPAT">SiCepat Gokil</option>
                                    <option value="TIKI">TIKI</option>
                                </select>
                            </div>

                            <!-- Metode Pembayaran -->
                            <div class="col-md-6 mb-4">
                                <label for="payment_method" class="form-label text-secondary fw-medium small">Metode Pembayaran</label>
                                <select name="payment_method" id="payment_method" class="form-select bg-dark text-white border-secondary custom-focus" required>
                                    <option value="Bank Transfer" selected>Bank Transfer (Manual)</option>
                                    <option value="E-Wallet">Gopay / OVO / Dana</option>
                                    <option value="COD">Bayar di Tempat (COD)</option>
                                </select>
                            </div>
                        </div>

                        <div class="mt-4 pt-2 border-top border-secondary-subtle">
                            <button type="submit" class="btn btn-premium w-100 py-3 rounded-3 fw-bold fs-5 shadow-sm text-center">
                                <i class="bi bi-wallet2 me-2"></i>Buat Pesanan Sekarang
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            {{-- KOLOM KANAN: RINGKASAN PRODUK YANG DIBELI --}}
            <div class="col-lg-5">
                <div class="card bg-dark rounded-4 border border-secondary p-4 position-sticky" style="top: 100px;">
                    <h5 class="fw-bold mb-4 border-bottom border-secondary pb-2">Ringkasan Produk</h5>

                    <div class="product-checkout-list overflow-y-auto mb-4" style="max-height: 280px;">
                        @isset($cartDetails)
                            @foreach($cartDetails as $detail)
                                <div class="d-flex align-items-center mb-3 pb-3 border-bottom border-dark-subtle">
                                    <div class="rounded-3 bg-secondary overflow-hidden me-3" style="width: 55px; height: 55px; min-width: 55px;">
                                        <img src="{{ $detail->product->image ? asset('assets/' . $detail->product->image) : asset('assets/kategori/product1.png') }}" alt="{{ $detail->product->name }}" class="w-100 h-100 object-fit-cover">
                                    </div>
                                    <div class="flex-grow-1 min-w-0">
                                        <h6 class="mb-0 fw-semibold text-white text-truncate" style="font-size: 0.9rem;">{{ $detail->product->name }}</h6>
                                        <small class="text-secondary">{{ $detail->quantity }} x Rp {{ number_format($detail->product->price, 0, ',', '.') }}</small>
                                    </div>
                                    <div class="text-end ps-2">
                                        <span class="fw-bold text-primary small">Rp {{ number_format($detail->product->price * $detail->quantity, 0, ',', '.') }}</span>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <p class="text-muted small">Data keranjang tidak ditemukan.</p>
                        @endisset
                    </div>

                    {{-- RINGKASAN HARGA AKHIR --}}
                    @isset($cartDetails)
                        @php
                            $totalSemua = $cartDetails->sum(function($detail) {
                                return $detail->product->price * $detail->quantity;
                            });
                        @endphp
                        <div class="d-flex justify-content-between mb-2 text-secondary small">
                            <span>Subtotal Produk</span>
                            <span>Rp {{ number_format($totalSemua, 0, ',', '.') }}</span>
                        </div>
                        <div class="d-flex justify-content-between mb-3 text-secondary small">
                            <span>Biaya Pengiriman</span>
                            <span class="text-success fw-medium">GRATIS</span>
                        </div>

                        <hr class="border-secondary my-3">

                        <div class="d-flex justify-content-between align-items-center">
                            <span class="fw-semibold">Total Pembayaran</span>
                            <h4 class="text-primary fw-bold mb-0">Rp {{ number_format($totalSemua, 0, ',', '.') }}</h4>
                        </div>
                    @endisset

                    <div class="mt-4">
                        <a href="{{ route('cart.index') }}" class="text-secondary text-decoration-none small fw-medium hover-white">
                            <i class="bi bi-arrow-left me-2"></i>Kembali ke Keranjang
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    .object-fit-cover {
        object-fit: cover;
    }
    .custom-focus:focus {
        background-color: rgba(255, 255, 255, 0.05) !important;
        color: #fff !important;
        border-color: #0d6efd !important;
        box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25) !important;
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
    /* Kustomisasi scrollbar list produk */
    .product-checkout-list::-webkit-scrollbar {
        width: 4px;
    }
    .product-checkout-list::-webkit-scrollbar-thumb {
        background-color: #333;
        border-radius: 4px;
    }
</style>
@endsection
