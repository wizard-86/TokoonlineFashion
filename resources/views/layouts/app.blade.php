<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'URBAN VIBE | Distro & Fashion Store')</title>
    <meta name="description" content="Toko online distro fashion premium dengan koleksi streetwear terbaik.">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <style>
        body {
            background-color: #0b0b0b;
            color: #ffffff;
        }
        .navbar-custom {
            background-color: #0b0b0b;
            border-bottom: 1px solid #212529;
        }
        .tracking-wide {
            letter-spacing: 1.5px;
        }
        .nav-icon {
            color: rgba(255, 255, 255, 0.75);
            transition: color 0.2s ease;
        }
        .nav-icon:hover {
            color: #0d6efd;
        }
        .nav-icon.active-icon {
            color: #0d6efd !important;
        }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark navbar-custom fixed-top py-3">
        <div class="container">
            <a class="navbar-brand fw-bold tracking-wide fs-4 text-white" href="{{ Auth::check() ? route('home') : route('welcome') }}">
                URBAN<span class="text-primary">VIBE</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto mb-2 mb-lg-0 gap-1 gap-lg-4 text-uppercase fw-semibold" style="font-size: 0.9rem; letter-spacing: 0.5px;">
                    @auth
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('home') ? 'active text-primary' : 'text-white-50' }}" href="{{ route('home') }}">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('collection') ? 'active text-primary' : 'text-white-50' }}" href="{{ route('collection') }}">Collection</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('about') ? 'active text-primary' : 'text-white-50' }}" href="{{ route('about') }}">About Us</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('contact') ? 'active text-primary' : 'text-white-50' }}" href="{{ route('contact') }}">Contact</a>
                        </li>
                    @endauth
                </ul>

                <div class="d-flex align-items-center gap-4">
                    @auth
                        <!-- IKON SEARCH: Diarahkan ke route search asli yang memanggil search2.blade.php -->
                        <a href="{{ route('search') }}" class="text-decoration-none nav-icon {{ request()->routeIs('search') ? 'active-icon' : '' }}" title="Cari Produk">
                            <i class="bi bi-search fs-5"></i>
                        </a>

                        <!-- IKON KERANJANG: Membuka halaman Cart -->
                        <a href="{{ route('cart.index') }}" class="text-decoration-none nav-icon position-relative {{ request()->routeIs('cart.index') ? 'active-icon' : '' }}" title="Keranjang Belanja">
                            <i class="bi bi-cart3 fs-5"></i>
                        </a>

                        <!-- IKON PROFILE: Membuka manajemen Profile dashboard user -->
                        <a href="{{ route('profile.index') }}" class="text-decoration-none nav-icon {{ request()->routeIs('profile.*') ? 'active-icon' : '' }}" title="Profil Saya">
                            <i class="bi bi-person-fill fs-4"></i>
                        </a>
                    @endauth

                    @guest
                        <a href="{{ route('login') }}" class="text-secondary text-decoration-none" title="Masuk ke Akun">
                            <i class="bi bi-person fs-4"></i>
                        </a>
                    @endguest
                </div>
            </div>
        </div>
    </nav>

    <main style="padding-top: 40px;">
        @yield('content')
    </main>

    @include('layouts.footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/script.js') }}"></script>
</body>
</html>
