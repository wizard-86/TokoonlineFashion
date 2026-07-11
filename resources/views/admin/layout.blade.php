<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>URBAN VIBE | Admin Panel</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body { background-color: #0b0b0b; color: #ffffff; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        .sidebar { min-height: 100vh; background-color: #111111; border-right: 1px solid #222222; }
        .sidebar .nav-link { color: #aaaaaa; padding: 12px 20px; font-weight: 500; }
        .sidebar .nav-link:hover, .sidebar .nav-link.active { color: #0d6efd; background-color: #1a1a1a; }
        .card-custom { background-color: #111111; border: 1px solid #222222; border-radius: 12px; }
        .table-custom { background-color: #111111; color: #ffffff; }
        .table-custom th { background-color: #1a1a1a; color: #aaaaaa; border-bottom: 1px solid #222222; }
        .table-custom td { border-bottom: 1px solid #222222; vertical-align: middle; }
    </style>
</head>
<body>

<div class="container-fluid">
    <div class="row">
        <!-- Sidebar Kiri -->
        <div class="col-md-3 col-lg-2 px-0 sidebar position-fixed">
            <div class="p-4 border-bottom border-secondary border-opacity-25">
                <h4 class="fw-bold mb-0 text-white">URBAN<span class="text-primary">VIBE</span></h4>
                <small class="text-secondary">Admin Panel</small>
            </div>
            <div class="nav flex-column py-3">
                <a href="{{ route('admin.dashboard') }}" class="nav-link {{ Request::is('admin/dashboard') ? 'active' : '' }}">
                    <i class="bi bi-speedometer2 me-2"></i> Dashboard
                </a>
                <a href="{{ route('admin.products.index') }}" class="nav-link {{ Request::is('admin/products*') ? 'active' : '' }}">
                    <i class="bi bi-box-seam me-2"></i> Manajemen Produk
                </a>
                <a href="{{ route('admin.orders.index') }}" class="nav-link {{ Request::is('admin/orders*') ? 'active' : '' }}">
                    <i class="bi bi-cart-check me-2"></i> Manajemen Pesanan
                </a>
                <a href="/" class="nav-link text-danger mt-5 border-top border-secondary border-opacity-10 pt-3">
                    <i class="bi bi-box-arrow-left me-2"></i> Lihat Toko
                </a>
            </div>
        </div>

        <!-- Konten Kanan -->
        <div class="col-md-9 ms-sm-auto col-lg-10 px-md-4 py-4" style="margin-left: 16.666667%;">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show border-0 bg-success text-white rounded-3 mb-4" role="alert">
                    <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @yield('admin_content')
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
