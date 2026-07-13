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
            <!-- Kolom Kiri: Informasi -->
            <div class="col-lg-7">
                <div class="card bg-dark rounded-4 border border-secondary p-4">
                    <h5 class="fw-bold mb-4 border-bottom border-secondary pb-2">Informasi Pengiriman</h5>

                    <form action="{{ route('checkout.process') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label text-secondary small fw-bold">ALAMAT LENGKAP PENGIRIMAN</label>
                            <textarea name="address" class="form-control bg-dark text-white border-secondary custom-focus" rows="3" required>{{ old('address') }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label text-secondary small fw-bold">NOMOR TELEPON</label>
                            <input type="text" name="phone" class="form-control bg-dark text-white border-secondary custom-focus" required value="{{ old('phone') }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label text-secondary small fw-bold">KURIR PENGIRIMAN</label>
                            <select name="courier" class="form-select bg-dark text-white border-secondary custom-focus">
                                <option value="J&T Express">J&T Express (Gratis Ongkir)</option>
                                <option value="JNE Reguler">JNE Reguler (Gratis Ongkir)</option>
                            </select>
                        </div>

                        <div class="mb-4">
                            <label class="form-label text-secondary small fw-bold">METODE PEMBAYARAN</label>
                            <select name="payment_method" class="form-select bg-dark text-white border-secondary custom-focus" required>
                                <option value="" disabled selected>Pilih Metode Pembayaran</option>
                                <option value="Transfer Bank">Transfer Bank</option>
                                <option value="E-Wallet">E-Wallet</option>
                            </select>
                        </div>

                        <!-- Fitur Voucher Menggunakan Dropdown Pilihan -->
                        <div class="mb-3">
                            <label class="form-label text-secondary small fw-bold">KODE VOUCHER</label>
                            <div class="input-group">
                                <select name="coupon_code" id="couponSelect" class="form-select bg-dark text-white border-secondary custom-focus" onchange="applyCoupon()">
                                    <option value="">Pilih Voucher Berdasarkan Keranjang Anda</option>
                                    @foreach($vouchersForSelect as $v)
                                        <option value="{{ $v['code'] }}"
                                                {{ $couponCode == $v['code'] ? 'selected' : '' }}
                                                {{ !$v['available'] ? 'disabled' : '' }}>
                                            {{ $v['label'] }} {{ !$v['available'] ? '(Syarat Belum Terpenuhi)' : '' }}
                                        </option>
                                    @endforeach
                                </select>
                                <span class="input-group-text bg-primary border-primary text-white">
                                    <i class="bi bi-ticket-perforated"></i>
                                </span>
                            </div>
                        </div>

                        <!-- Gunakan Koin -->
                        <div class="mb-4 p-3 rounded bg-black bg-opacity-25 border border-secondary">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="toggle_coins_checkbox" {{ ($useCoins ?? false) ? 'checked' : '' }}>
                                <label class="form-check-label fw-bold small text-info" for="toggle_coins_checkbox">
                                    <i class="bi bi-coin me-1"></i> GUNAKAN KOIN MEMBER (Miliki: {{ number_format($user->coins ?? 0, 0, ',', '.') }} Koin)
                                </label>
                            </div>
                        </div>
                        <input type="hidden" name="use_coins_applied" id="use_coins_hidden" value="{{ ($useCoins ?? false) ? '1' : '0' }}">

                        <button type="submit" class="btn btn-primary btn-premium w-100 py-3 rounded-3 fw-bold text-uppercase shadow">
                            <i class="bi bi-wallet2 me-2"></i>Buat Pesanan Sekarang
                        </button>
                    </form>
                </div>
            </div>

            <!-- Kolom Kanan: Ringkasan -->
            <div class="col-lg-5">
                <div class="card bg-dark rounded-4 border border-secondary p-4 text-white">
                    <h5 class="fw-bold mb-3 border-bottom border-secondary pb-2">Ringkasan Belanja</h5>
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-secondary">Subtotal</span>
                        <span>Rp {{ number_format($subtotal ?? 0, 0, ',', '.') }}</span>
                    </div>
                    @if(($categoryDiscount ?? 0) > 0)
                        <div class="d-flex justify-content-between mb-2 text-success">
                            <span>Diskon Grosir Kategori</span>
                            <span>-Rp {{ number_format($categoryDiscount, 0, ',', '.') }}</span>
                        </div>
                    @endif
                    @if(($bundleDiscount ?? 0) > 0)
                        <div class="d-flex justify-content-between mb-2 text-success">
                            <span>Diskon Bundle</span>
                            <span>-Rp {{ number_format($bundleDiscount, 0, ',', '.') }}</span>
                        </div>
                    @endif
                    @if(($voucherDiscount ?? 0) > 0)
                        <div class="d-flex justify-content-between mb-2 text-success">
                            <span>Diskon Voucher ({{ $couponCode }})</span>
                            <span>-Rp {{ number_format($voucherDiscount, 0, ',', '.') }}</span>
                        </div>
                    @endif
                    @if(($coinsUsed ?? 0) > 0)
                        <div class="d-flex justify-content-between mb-2 text-info">
                            <span>Koin Digunakan</span>
                            <span>-Rp {{ number_format($coinsUsedValue ?? ($coinsUsed * 1000), 0, ',', '.') }}</span>
                        </div>
                    @endif
                    <div class="pt-2 border-top border-secondary d-flex justify-content-between align-items-center">
                        <span class="fw-semibold">Total Pembayaran</span>
                        <h4 class="text-primary fw-bold mb-0">Rp {{ number_format($totalFinalRupiah ?? 0, 0, ',', '.') }}</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    .custom-focus:focus { background-color: #1a1a1a !important; color: #fff !important; border-color: #0d6efd !important; }
    .form-select { background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%23ffffff' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M2 5l6 6 6-6'/%3e%3c/svg%3e") !important; }
    .btn-premium { background-color: #0d6efd; border: 1px solid #0d6efd; color: #fff; }
</style>

<script>
    function applyCoupon() {
        const code = document.getElementById('couponSelect').value;
        const url = new URL(window.location.href);
        if (code) {
            url.searchParams.set('coupon_code', code);
        } else {
            url.searchParams.delete('coupon_code');
        }
        window.location.href = url.toString();
    }

    document.getElementById('toggle_coins_checkbox').addEventListener('change', function() {
        const url = new URL(window.location.href);
        url.searchParams.set('use_coins_applied', this.checked ? '1' : '0');
        // Tetap pertahankan voucher yang sedang aktif saat koin di-toggle
        const currentCoupon = document.getElementById('couponSelect').value;
        if (currentCoupon) {
            url.searchParams.set('coupon_code', currentCoupon);
        }
        window.location.href = url.toString();
    });
</script>
@endsection
