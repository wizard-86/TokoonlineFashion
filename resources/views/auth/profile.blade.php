@extends('layouts.app')

@section('title', 'URBAN VIBE | Profil Saya')

@section('content')
<section class="py-5 my-5" style="background-color: #0b0b0b;">
    <div class="container pt-5 text-white">
        <h2 class="fw-bold mb-4"><i class="bi bi-person-circle text-primary me-2"></i>Profil Saya</h2>

        <div class="row g-4">
            <div class="col-lg-4">
                <div class="card bg-dark rounded-4 border border-secondary p-4 text-center mb-4">
                    <div class="mx-auto bg-primary rounded-circle d-flex align-items-center justify-content-center shadow-sm mb-3" style="width: 80px; height: 80px;">
                        <i class="bi bi-person-fill fs-1 text-white"></i>
                    </div>
                    <h4 class="fw-bold m-0 text-white">{{ $user->name }}</h4>
                    <p class="text-secondary small mb-4">{{ $user->email }}</p>

                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-danger w-100 py-2.5 rounded-3 fw-semibold shadow-sm">
                            <i class="bi bi-box-arrow-right me-2"></i>Logout
                        </button>
                    </form>
                </div>

                <div class="list-group list-group-custom rounded-4 border border-secondary overflow-hidden shadow">
                    <a href="{{ route('profile.index') }}" class="list-group-item list-group-item-action bg-dark text-white border-secondary py-3 px-4 active">
                        <i class="bi bi-person-gear me-3 text-primary"></i>Informasi Akun
                    </a>
                    <a href="{{ route('profile.dikemas') }}" class="list-group-item list-group-item-action bg-dark text-white border-secondary py-3 px-4">
                        <i class="bi bi-box-seam me-3 text-secondary"></i>Pesanan Dikemas
                    </a>
                    <a href="{{ route('profile.dikirim') }}" class="list-group-item list-group-item-action bg-dark text-white border-secondary py-3 px-4">
                        <i class="bi bi-truck me-3 text-secondary"></i>Pesanan Dikirim
                    </a>
                    <a href="{{ route('profile.dinilai') }}" class="list-group-item list-group-item-action bg-dark text-white border-secondary py-3 px-4">
                        <i class="bi bi-star me-3 text-secondary"></i>Riwayat & Ulasan
                    </a>
                </div>
            </div>

            <div class="col-lg-8">
                <div class="card bg-dark rounded-4 border border-secondary p-4 p-md-5 h-100 min-frame-height d-flex flex-column justify-content-between">
                    <div>
                        <h4 class="fw-bold mb-4 text-white pb-2 border-bottom border-secondary"><i class="bi bi-info-circle text-primary me-2"></i>Detail Akun</h4>

                        <div class="row g-4 mb-4">
                            <div class="col-md-6">
                                <span class="d-block text-secondary small fw-bold tracking-wide">NAMA LENGKAP</span>
                                <span class="fs-5 fw-medium text-white">{{ $user->name }}</span>
                            </div>
                            <div class="col-md-6">
                                <span class="d-block text-secondary small fw-bold tracking-wide">EMAIL ADDRESS</span>
                                <span class="fs-5 fw-medium text-white">{{ $user->email }}</span>
                            </div>
                            <div class="col-md-6">
                                <span class="d-block text-secondary small fw-bold tracking-wide">NOMOR TELEPON</span>
                                <span class="fs-5 fw-medium text-white">{{ $user->phone ?? '-' }}</span>
                            </div>
                            <div class="col-md-6">
                                <span class="d-block text-secondary small fw-bold tracking-wide">ROLE MEMBER</span>
                                <span class="badge bg-primary px-3 py-2 rounded-pill text-uppercase mt-1" style="font-size: 0.75rem;">{{ $user->role }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="border-top border-secondary pt-4 mt-3">
                        <h6 class="fw-bold text-secondary tracking-wide mb-3 small"><i class="bi bi-ticket-perforated me-2 text-success"></i>VOUCHER KHUSUS KAMU</h6>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="p-3 rounded-3 border border-success border-opacity-25 shadow-sm" style="background: linear-gradient(145deg, #0e1e14, #08100b);">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
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
        </div>
    </div>
</section>

<style>
    .min-frame-height { min-height: 380px; }
    .list-group-custom .list-group-item { transition: all 0.2s ease; cursor: pointer; }
    .list-group-custom .list-group-item:hover { background-color: #161616 !important; padding-left: 20px !important; }
    .list-group-custom .list-group-item.active { background-color: #161616 !important; border-left: 4px solid #0d6efd !important; font-weight: bold; }
</style>
@endsection
