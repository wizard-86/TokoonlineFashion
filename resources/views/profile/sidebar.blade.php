<!-- Kartu Identitas Akun -->
<div class="card bg-dark rounded-4 border border-secondary p-4 text-center mb-4">
    <div class="mx-auto bg-primary rounded-circle d-flex align-items-center justify-content-center shadow-sm mb-3" style="width: 80px; height: 80px;">
        <i class="bi bi-person-fill fs-1 text-white"></i>
    </div>
    <h4 class="fw-bold m-0 text-white">Nama Akun</h4>
    <p class="text-secondary small mb-4">user@urbanvibe.id</p>

    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit" class="btn btn-danger w-100 py-2.5 rounded-3 fw-semibold shadow-sm">
            <i class="bi bi-box-arrow-right me-2"></i>Logout
        </button>
    </form>
</div>

<!-- Navigasi Menu Berpindah Halaman URL -->
<div class="list-group list-group-custom rounded-4 border border-secondary overflow-hidden shadow-sm">
    <a href="{{ route('profile.index') }}" class="list-group-item list-group-item-action bg-dark text-white border-0 border-bottom border-secondary p-3 {{ request()->routeIs('profile.index') ? 'active-profile' : '' }}">
        <div class="d-flex justify-content-between align-items-center">
            <div><i class="bi bi-box-seam text-primary me-3 fs-5"></i>Barang Dikemas</div>
            <span class="badge bg-secondary rounded-pill px-2.5 py-1 text-dark fw-bold">0</span>
        </div>
    </a>
    <a href="{{ route('profile.dikirim') }}" class="list-group-item list-group-item-action bg-dark text-white border-0 border-bottom border-secondary p-3 {{ request()->routeIs('profile.get.dikirim') || request()->routeIs('profile.dikirim') ? 'active-profile' : '' }}">
        <div class="d-flex justify-content-between align-items-center">
            <div><i class="bi bi-truck text-primary me-3 fs-5"></i>Barang Sudah Dikirim</div>
            <span class="badge bg-secondary rounded-pill px-2.5 py-1 text-dark fw-bold">0</span>
        </div>
    </a>
    <a href="{{ route('profile.dinilai') }}" class="list-group-item list-group-item-action bg-dark text-white border-0 border-bottom border-secondary p-3 {{ request()->routeIs('profile.dinilai') ? 'active-profile' : '' }}">
        <div class="d-flex justify-content-between align-items-center">
            <div><i class="bi bi-star text-primary me-3 fs-5"></i>Barang Dinilai</div>
            <span class="badge bg-secondary rounded-pill px-2.5 py-1 text-dark fw-bold">0</span>
        </div>
    </a>
    <a href="{{ route('profile.voucher') }}" class="list-group-item list-group-item-action bg-dark text-white border-0 p-3 {{ request()->routeIs('profile.voucher') ? 'active-profile' : '' }}">
        <div class="d-flex justify-content-between align-items-center">
            <div><i class="bi bi-ticket-perforated text-primary me-3 fs-5"></i>Diskon & Voucher</div>
            <span class="badge bg-success text-white px-2.5 py-1 rounded-2 style-text" style="font-size: 0.75rem;">Diskon 15%</span>
        </div>
    </a>
</div>

<style>
    .list-group-custom .list-group-item { transition: all 0.2s ease; }
    .list-group-custom .list-group-item:hover { background-color: #161616 !important; padding-left: 20px !important; color: #fff; }
    .list-group-custom .active-profile { background-color: #161616 !important; border-left: 4px solid #0d6efd !important; font-weight: bold; color: #fff !important; }
</style>
