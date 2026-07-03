@extends('layouts.app')

@section('title', 'URBAN VIBE | Checkout')

@section('content')
<section class="py-5 my-5" style="background-color: #0b0b0b;">
    <div class="container pt-5 text-white">
        <h2 class="fw-bold mb-4"><i class="bi bi-shield-check text-primary me-2"></i>Checkout Pesanan</h2>

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show border-0 text-white rounded-3 mb-4" style="background-color: #dc3545;" role="alert">
                <i class="bi bi-exclamation-triangle-fill me-2"></i> {{ session('error') }}
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close\"></button>
            </div>
        @endif

        <div class="row g-4">
            <div class="col-lg-7">
                <div class="card bg-dark rounded-4 border border-secondary p-4">
                    <h5 class="fw-bold mb-4 border-bottom border-secondary pb-2">Informasi Pengiriman</h5>

                    <form action="{{ route('checkout.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label text-secondary small fw-bold">ALAMAT LENGKAP</label>
                            <textarea name="address" class="form-control bg-dark text-white border-secondary custom-focus" rows="3" placeholder="Masukkan alamat lengkap pengiriman rumah/kantor..." required></textarea>
                        </div>

                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label class="form-label text-secondary small fw-bold">KOTA / KABUPATEN</label>
                                <input type="text" name="city" class="form-control bg-dark text-white border-secondary custom-focus py-2.5" placeholder="Contoh: Surabaya" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label text-secondary small fw-bold">KODE POS</label>
                                <input type="text" name="postal_code" class="form-control bg-dark text-white border-secondary custom-focus py-2.5" placeholder="Contoh: 60111" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label text-secondary small fw-bold">JASA PENGIRIMAN (KURIR)</label>
                            <select name="courier" class="form-select bg-dark text-white border-secondary custom-focus py-2.5" required>
                                <option value="" selected disabled>Pilih opsi pengiriman...</option>
                                <option value="JNE">JNE Express (Reguler) - Rp 0 (PROMO)</option>
                                <option value="J&T">J&T Express - Rp 0 (PROMO)</option>
                                <option value="SICEPAT">SiCepat Gokil - Rp 0 (PROMO)</option>
                            </select>
                        </div>

                        <div class="mb-4">
                            <label class="form-label text-secondary small fw-bold">METODE PEMBAYARAN</label>
                            <select name="payment_method" class="form-select bg-dark text-white border-secondary custom-focus py-2.5" required>
                                <option value="" selected disabled>Pilih metode pembayaran...</option>
                                <option value="Bank Transfer">Bank Transfer (BCA / Mandiri / BNI)</option>
                                <option value="E-Wallet">E-Wallet (Dana / OVO / GoPay)</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-premium w-100 py-3 rounded-3 fw-bold fs-5 shadow-sm text-center">
                            <i class="bi bi-wallet2 me-2"></i>Konfirmasi & Buat Pesanan
                        </button>
                    </form>
                </div>
            </div>

            <div class="col-lg-5">
                <div class="card bg-dark rounded-4 border border-secondary p-4 shadow h-100 d-flex flex-column justify-content-between">
                    <div>
                        <h5 class="fw-bold mb-4 border-bottom border-secondary pb-2">Rincian Item</h5>
                        <div class="overflow-y-auto mb-3" style="max-height: 280px;">
                            @foreach($cartDetails as $detail)
                                <div class="d-flex align-items-center justify-content-between mb-3 pb-3 border-bottom border-secondary border-opacity-25 me-1">
                                    <div class="d-flex align-items-center gap-3">
                                        <img src="{{ asset('assets/' . ($detail->product->image ?? 'default.png')) }}" class="rounded-3 object-fit-cover border border-secondary" style="width: 55px; height: 55px;">
                                        <div>
                                            <h6 class="fw-bold mb-0 text-white small">{{ $detail->product->name ?? 'Produk' }}</h6>
                                            <small class="text-secondary" style="font-size: 0.75rem;">Kuantitas: {{ $detail->quantity }}x</small>
                                        </div>
                                    </div>
                                    <span class="fw-medium text-primary small">Rp {{ number_format(($detail->product->price ?? 0) * $detail->quantity, 0, ',', '.') }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    @isset($totalSemua)
                        <div class="border-top border-secondary pt-3 mt-2">
                            <div class="d-flex justify-content-between mb-2 text-secondary small">
                                <span>Total Item</span>
                                <span class="text-white fw-medium">Rp {{ number_format($totalSemua, 0, ',', '.') }}</span>
                            </div>
                            <div class="d-flex justify-content-between mb-3 text-secondary small">
                                <span>Ongkos Kirim</span>
                                <span class="text-success fw-medium">GRATIS ONGKIR</span>
                            </div>
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="fw-semibold">Total Pembayaran</span>
                                <h4 class="text-primary fw-bold mb-0">Rp {{ number_format($totalSemua, 0, ',', '.') }}</h4>
                            </div>
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
    .object-fit-cover { object-fit: cover; }
    .custom-focus:focus {
        background-color: rgba(255, 255, 255, 0.05) !important;
        color: #fff !important;
        border-color: #0d6efd !important;
        box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25) !important;
    }
    .hover-white:hover { color: #ffffff !important; transition: color 0.2s; }
    .btn-premium { background-color: #0d6efd; border: 1px solid #0d6efd; color: #fff; transition: all 0.3s ease; }
    .btn-premium:hover { background-color: #0b5ed7; border-color: #0a58ca; color: #fff; }
</style>
@endsection
