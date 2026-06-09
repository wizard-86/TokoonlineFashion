@extends('layouts.app')

@section('title', 'URBAN VIBE | Keranjang Belanja')

@section('content')
<section class="py-5 my-5">
    <div class="container pt-5 text-white">
        <h2 class="fw-bold mb-4"><i class="bi bi-cart3 text-primary me-2"></i>Keranjang Belanja</h2>

        {{-- JIKA KERANJANG ADA ISINYA --}}
        <div class="row g-4">
            <!-- SISI KIRI: DAFTAR ITEM (Lebih dominan) -->
            <div class="col-lg-8">
                <div class="card bg-dark rounded-4 border border-secondary p-3 p-md-4">
                    <div class="table-responsive">
                        <table class="table table-dark table-borderless align-middle m-0">
                            <thead>
                                <tr class="text-secondary border-bottom border-secondary fs-6">
                                    <th scope="col" class="pb-3" style="min-width: 250px;">Produk</th>
                                    <th scope="col" class="pb-3 text-center">Harga</th>
                                    <th scope="col" class="pb-3 text-center" style="width: 120px;">Jumlah</th>
                                    <th scope="col" class="pb-3 text-end">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- CONTOH ITEM DAFTAR BELANJA (Nanti bisa di-loop dengan @foreach) --}}
                                <tr class="border-bottom border-dark-subtle">
                                    <td class="py-4">
                                        <div class="d-flex align-items-center">
                                            <!-- Mini Thumbnail Gambar Produk -->
                                            <div class="rounded-3 bg-secondary overflow-hidden me-3" style="width: 70px; height: 70px; min-width: 70px;">
                                                <img src="{{ asset('assets/kaos/t-shirt3.png') }}" alt="Product Image" class="w-100 h-100 object-fit-cover">
                                            </div>
                                            <div>
                                                <h6 class="mb-1 fw-semibold text-white">Oversized Black Minimalist</h6>
                                                <small class="text-secondary">Ukuran: L</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center py-4">Rp185.000</td>
                                    <td class="py-4">
                                        <!-- Pengatur Quantity Modern -->
                                        <div class="input-group input-group-sm border border-secondary rounded-2 overflow-hidden bg-transparent">
                                            <button class="btn btn-outline-secondary border-0 px-2" type="button"><i class="bi bi-dash"></i></button>
                                            <input type="text" class="form-control bg-transparent text-white border-0 text-center fw-bold fs-6 p-0" value="1" readonly>
                                            <button class="btn btn-outline-secondary border-0 px-2" type="button"><i class="bi bi-plus"></i></button>
                                        </div>
                                        <!-- Tombol Hapus Cepat -->
                                        <div class="text-center mt-2">
                                            <button class="btn btn-link text-danger p-0 text-decoration-none small-text" style="font-size: 0.8rem;">
                                                <i class="bi bi-trash3 me-1"></i>Hapus
                                            </button>
                                        </div>
                                    </td>
                                    <td class="text-end fw-bold text-primary py-4">Rp185.000</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <!-- Tombol Kembali Belanja -->
                    <div class="mt-4">
                        <a href="{{ route('collection') }}" class="text-secondary text-decoration-none small fw-medium">
                            <i class="bi bi-arrow-left me-2"></i>Lanjutkan Belanja
                        </a>
                    </div>
                </div>
            </div>

            <!-- SISI KANAN: RINGKASAN BELANJA / RINGKASAN PEMBAYARAN -->
            <div class="col-lg-4">
                <div class="card bg-dark rounded-4 border border-secondary p-4 shadow-sm position-sticky" style="top: 100px;">
                    <h5 class="fw-bold mb-4 border-bottom border-secondary pb-2">Ringkasan Belanja</h5>

                    <div class="d-flex justify-content-between mb-2 text-secondary">
                        <span>Total Harga (1 Barang)</span>
                        <span>Rp185.000</span>
                    </div>
                    <div class="d-flex justify-content-between mb-3 text-secondary">
                        <span>Biaya Pengiriman</span>
                        <span class="text-success fw-medium">Otomatis di Kasir</span>
                    </div>

                    <hr class="border-secondary my-3">

                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <span class="fw-semibold">Total Belanja</span>
                        <h4 class="text-primary fw-bold mb-0">Rp185.000</h4>
                    </div>

                    <!-- Tombol Checkout Utama bergaya Premium -->
                    <button class="btn btn-premium w-100 py-3 rounded-3 fw-bold fs-5 shadow-sm">
                        <i class="bi bi-shield-check me-2"></i>Lanjut ke Checkout
                    </button>
                </div>
            </div>
        </div>

        {{-- JIKA KERANJANG KOSONG (Tetap dipertahankan untuk kondisi if-else nanti) --}}
        {{--
        <div class="p-5 bg-dark rounded-4 border border-secondary text-center mt-4">
            <div class="fs-1 mb-3 text-secondary"><i class="bi bi-cart-x"></i></div>
            <h5 class="m-0 text-secondary">Keranjang belanja Anda kosong.</h5>
            <a href="{{ route('collection') }}" class="btn btn-premium mt-4">Mulai Belanja</a>
        </div>
        --}}

    </div>
</section>

{{-- Kustomisasi CSS Tambahan opsional untuk memoles elemen kecil --}}
<style>
    .table-dark {
        --bs-table-bg: transparent !important;
    }
    .object-fit-cover {
        object-fit: cover;
    }
    /* Memastikan tombol plus minus tidak merusak layout */
    .input-group-sm>.form-control {
        min-width: 35px;
    }
</style>
@endsection
