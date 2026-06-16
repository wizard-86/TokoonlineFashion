@extends('layouts.app')
@section('title', 'URBAN VIBE | Voucher Diskon')
@section('content')
<section class="py-5 my-5" style="background-color: #0b0b0b;">
    <div class="container pt-5 text-white">
        <h2 class="fw-bold mb-4"><i class="bi bi-person-circle text-primary me-2"></i>Profil Saya</h2>
        <div class="row g-4">
            <div class="col-lg-4">@include('profile.sidebar')</div>
            <div class="col-lg-8">
                <div class="card bg-dark rounded-4 border border-secondary p-4" style="min-height: 380px;">
                    <h5 class="fw-bold mb-4 border-bottom border-secondary pb-2"><i class="bi bi-ticket-perforated text-primary me-2"></i>Voucher Kamu</h5>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="p-3 border border-success rounded-3 bg-opacity-10 bg-success d-flex align-items-center justify-content-between shadow-sm">
                                <div>
                                    <span class="badge bg-success mb-2">MEMBER BARU</span>
                                    <h6 class="fw-bold text-white mb-1">Diskon 15% URBAN VIBE</h6>
                                    <small class="text-secondary" style="font-size: 0.75rem;">Tanpa minimum transaksi</small>
                                </div>
                                <div class="text-end ps-3 border-start border-success border-opacity-25">
                                    <span class="fw-bold text-success fs-5">15%</span>
                                    <span class="d-block text-secondary mt-1" style="font-size: 0.65rem;">KODE: URBAN15</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
