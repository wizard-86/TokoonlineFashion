@extends('layouts.app')

@section('title', 'URBAN VIBE | Pesanan Sukses')

@section('content')
<section class="py-5 my-5 d-flex align-items-center" style="background-color: #0b0b0b; min-height: 75vh;">
    <div class="container pt-5 text-center">
        <div class="row justify-content-center">
            <div class="col-md-7">

                <div class="card bg-dark rounded-4 border border-secondary p-5 shadow-lg">
                    <div class="mb-4">
                        <i class="bi bi-check-circle-fill text-primary" style="font-size: 4.5rem;"></i>
                    </div>

                    <h2 class="fw-bold text-white tracking-wide mb-2">PESANAN SUKSES DIBELI!</h2>
                    <p class="text-secondary mb-4">Terima kasih telah berbelanja di URBAN VIBE. Pesanan Anda sedang kami proses.</p>

                    <div class="bg-black bg-opacity-50 rounded-3 p-4 text-start mb-4 border border-secondary border-opacity-25">
                        <div class="d-flex justify-content-between mb-2 small text-secondary">
                            <span>NO. INVOICE:</span>
                            <span class="text-white fw-bold">{{ $order->invoice ?? '#UV-BARU' }}</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2 small text-secondary">
                            <span>METODE PEMBAYARAN:</span>
                            <span class="text-white text-uppercase fw-semibold">{{ $order->payment_method ?? 'COD' }}</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2 small text-secondary">
                            <span>ALAMAT PENGIRIMAN:</span>
                            <span class="text-white text-end fw-medium" style="max-width: 65%;">{{ $order->address ?? '-' }}</span>
                        </div>

                        @if(isset($order->coins_used) && $order->coins_used > 0)
                        <div class="d-flex justify-content-between mb-2 small text-info">
                            <span>KOIN DI-REDEEM:</span>
                            <span>-{{ $order->coins_used }} Koin</span>
                        </div>
                        @endif

                        @if(isset($order->coins_earned) && $order->coins_earned > 0)
                        <div class="d-flex justify-content-between mb-2 small text-warning">
                            <span>REWARD KOIN BARU:</span>
                            <span class="fw-bold">+{{ $order->coins_earned }} Koin <i class="bi bi-coin"></i></span>
                        </div>
                        @endif

                        <div class="d-flex justify-content-between pt-2 border-top border-secondary border-opacity-50 mt-3">
                            <span class="fw-bold text-secondary">TOTAL BAYAR BERSIH:</span>
                            <span class="fw-bold text-primary fs-5">
                                Rp {{ number_format($order->total_harga ?? 0, 0, ',', '.') }}
                            </span>
                        </div>
                    </div>

                    <div class="d-flex flex-column flex-sm-row gap-3 justify-content-center">
                        <a href="{{ route('home') }}" class="btn btn-primary px-4 py-2 fw-bold text-uppercase rounded-3">
                            <i class="bi bi-house-door me-2"></i> Kembali ke Home
                        </a>
                        <a href="{{ route('profile.index') }}" class="btn btn-outline-light px-4 py-2 fw-bold text-uppercase rounded-3">
                            <i class="bi bi-bag-check me-2"></i> Cek Status Pesanan
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>
@endsection
