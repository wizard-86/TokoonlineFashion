@extends('admin.layout')

@section('admin_content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-4 border-bottom border-secondary border-opacity-25">
    <h1 class="h2 fw-bold">Dashboard</h1>
</div>

<!-- Kartu Statistik -->
<div class="row g-3 mb-4">
    <div class="col-md-3">
        <div class="card card-custom p-4">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="text-secondary small fw-bold text-uppercase">Total Pendapatan</h6>
                    <h3 class="fw-bold text-primary mb-0">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</h3>
                </div>
                <div class="bg-primary bg-opacity-10 p-3 rounded-3 text-primary fs-3">
                    <i class="bi bi-currency-dollar"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card card-custom p-4">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="text-secondary small fw-bold text-uppercase">Pesanan Masuk</h6>
                    <h3 class="fw-bold text-white mb-0">{{ $totalPesanan }}</h3>
                </div>
                <div class="bg-warning bg-opacity-10 p-3 rounded-3 text-warning fs-3">
                    <i class="bi bi-bag-check"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card card-custom p-4">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="text-secondary small fw-bold text-uppercase">Jumlah Produk</h6>
                    <h3 class="fw-bold text-white mb-0">{{ $totalProduk }}</h3>
                </div>
                <div class="bg-info bg-opacity-10 p-3 rounded-3 text-info fs-3">
                    <i class="bi bi-box-seam"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card card-custom p-4">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="text-secondary small fw-bold text-uppercase">Total Member</h6>
                    <h3 class="fw-bold text-white mb-0">{{ $totalMember }}</h3>
                </div>
                <div class="bg-success bg-opacity-10 p-3 rounded-3 text-success fs-3">
                    <i class="bi bi-people"></i>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
