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
            <div class="col-lg-7">
                <div class="card bg-dark rounded-4 border border-secondary p-4">
                    <h5 class="fw-bold mb-4 border-bottom border-secondary pb-2">Informasi Pengiriman</h5>



                    <form action="{{ route('checkout.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label text-secondary small fw-bold">ALAMAT LENGKAP PENGIRIMAN</label>
                            <textarea name="address" class="form-control bg-dark text-white border-secondary custom-focus" rows="3" placeholder="Masukkan alamat lengkap pengiriman..." required>{{ old('address') }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label text-secondary small fw-bold">NOMOR TELEPON</label>
                            <input type="text" name="phone" class="form-control bg-dark text-white border-secondary custom-focus" placeholder="Contoh: 08123456789" required value="{{ old('phone') }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label text-secondary small fw-bold">KURIR PENGIRIMAN</label>
                            <select name="courier" class="form-select bg-dark text-white border-secondary custom-focus">
                                <option value="J&T Express" selected>J&T Express (Gratis Ongkir)</option>
                                <option value="JNE Reguler">JNE Reguler (Gratis Ongkir)</option>
                                <option value="Sicepat">Sicepat (Gratis Ongkir)</option>
                            </select>
                        </div>

                        <div class="mb-4">
                            <label class="form-label text-secondary small fw-bold">METODE PEMBAYARAN</label>
                            <select name="payment_method" class="form-select bg-dark text-white border-secondary custom-focus" required>
                                <option value="" disabled selected>Pilih Metode Pembayaran</option>
                                <option value="Transfer Bank">Transfer Bank (Otomatis)</option>
                                <option value="E-Wallet">E-Wallet (Dana/OVO/Gopay)</option>
                                <option value="COD">Bayar di Tempat (COD)</option>
                            </select>
                        </div>

                        <div class="mb-4 p-3 rounded bg-black bg-opacity-25 border border-secondary">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="toggle_coins_checkbox" {{ $useCoins ? 'checked' : '' }}>
                                <label class="form-check-label fw-bold small text-info" for="toggle_coins_checkbox">
                                    <i class="bi bi-coin me-1"></i> GUNAKAN KOIN MEMBER (Miliki: {{ number_format($user->coins, 0, ',', '.') }} Koin)
                                </label>
                            </div>
                        </div>

                        <input type="hidden" name="coupon_code" value="{{ $couponCode ?? '' }}">
                        <input type="hidden" name="use_coins_applied" id="use_coins_hidden" value="{{ $useCoins ? '1' : '0' }}">

                        <button type="submit" class="btn btn-primary btn-premium w-100 py-3 rounded-3 fw-bold text-uppercase tracking-wide shadow">
                            <i class="bi bi-wallet2 me-2"></i>Buat Pesanan Sekarang
                        </button>
                    </form>
                </div>
            </div>

            <div class="col-lg-5">
                <div class="card bg-dark rounded-4 border border-secondary p-4 text-white">
                    <h5 class="fw-bold mb-3 border-bottom border-secondary pb-2">Ringkasan Belanja</h5>

                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-secondary">Subtotal Produk</span>
                        <span>Rp {{ number_format($subtotal ?? 0, 0, ',', '.') }}</span>
                    </div>

                    @if(isset($categoryDiscount) && $categoryDiscount > 0)
                    <div class="d-flex justify-content-between mb-2 text-warning">
                        <span>Diskon Grosir Kategori</span>
                        <span>-Rp {{ number_format($categoryDiscount, 0, ',', '.') }}</span>
                    </div>
                    @endif

                    @if(isset($voucherDiscount) && $voucherDiscount > 0)
                    <div class="d-flex justify-content-between mb-2 text-success">
                        <span>Voucher Potongan</span>
                        <span>-Rp {{ number_format($voucherDiscount, 0, ',', '.') }}</span>
                    </div>
                    @endif

                    @if(isset($coinsUsed) && $coinsUsed > 0)
                    <div class="d-flex justify-content-between mb-2 text-info">
                        <span>Potongan Koin Member</span>
                        <span>-Rp {{ number_format($coinsUsed, 0, ',', '.') }}</span>
                    </div>
                    @endif

                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-secondary">Biaya Pengiriman</span>
                        <span class="text-success fw-medium">GRATIS ONGKIR</span>
                    </div>

                    <div class="pt-2 border-top border-secondary d-flex justify-content-between align-items-center mb-2">
                        <span class="fw-semibold">Total Pembayaran</span>
                        <h4 class="text-primary fw-bold mb-0">Rp {{ number_format($totalFinalRupiah ?? 0, 0, ',', '.') }}</h4>
                    </div>

                    @if(isset($coinsEarned) && $coinsEarned > 0)
                    <div class="mt-3 text-center p-2 rounded bg-black bg-opacity-25 border border-primary border-opacity-25">
                        <small class="text-primary fw-medium">
                            <i class="bi bi-coin me-1"></i> Kamu akan mendapatkan reward <strong>+{{ number_format($coinsEarned, 0, ',', '.') }} Koin</strong> setelah transaksi selesai!
                        </small>
                    </div>
                    @endif
                </div>

                <div class="mt-4 text-start">
                    <a href="{{ route('cart.index') }}" class="text-secondary text-decoration-none small fw-medium hover-white">
                        <i class="bi bi-arrow-left me-2"></i>Kembali ke Keranjang
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const checkbox = document.getElementById('toggle_coins_checkbox');
        const hiddenInput = document.getElementById('use_coins_hidden');

        if(checkbox) {
            checkbox.addEventListener('change', function() {
                if(this.checked) {
                    hiddenInput.value = '1';
                } else {
                    hiddenInput.value = '0';
                }
                const url = new URL(window.location.href);
                url.searchParams.set('use_coins_applied', hiddenInput.value);
                window.location.href = url.toString();
            });
        }
    });
</script>

<style>
    .object-fit-cover { object-fit: cover; }
    .custom-focus:focus {
        background-color: rgba(255, 255, 255, 0.05) !important;
        color: #fff !important;
        border-color: #0d6efd !important;
        box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25) !important;
    }
    .hover-white:hover { color: #ffffff !important; transition: color 0.2s; }
    .btn-premium { background-color: #0d6efd; border: 1px solid #0d6efd; color: #fff; transition: all 0.2s; }
    .btn-premium:hover { background-color: #0b5ed7; border-color: #0a58ca; }
</style>
@endsection
