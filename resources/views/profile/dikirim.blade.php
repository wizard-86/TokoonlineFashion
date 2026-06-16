@extends('layouts.app')
@section('title', 'URBAN VIBE | Barang Dikirim')
@section('content')
<section class="py-5 my-5" style="background-color: #0b0b0b;">
    <div class="container pt-5 text-white">
        <h2 class="fw-bold mb-4"><i class="bi bi-person-circle text-primary me-2"></i>Profil Saya</h2>
        <div class="row g-4">
            <div class="col-lg-4">@include('profile.sidebar')</div>
            <div class="col-lg-8">
                <div class="card bg-dark rounded-4 border border-secondary p-4" style="min-height: 380px;">
                    <h5 class="fw-bold mb-4 border-bottom border-secondary pb-2"><i class="bi bi-truck text-primary me-2"></i>Lacak Pengiriman</h5>
                    <div class="text-center py-5 my-3">
                        <i class="bi bi-card-list fs-1 text-secondary mb-3 d-block"></i>
                        <p class="text-secondary mb-0">Tidak ada pengiriman aktif saat ini.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
