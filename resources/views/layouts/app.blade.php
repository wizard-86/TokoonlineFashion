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
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark navbar-custom fixed-top py-3">
        <div class="container">
            <a class="navbar-brand fw-bold tracking-wide fs-4 text-white" href="{{ Auth::check() ? route('home') : route('landing') }}">
                URBAN<span class="text-primary">VIBE</span>
            </a>

            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto mb-2 mb-lg-0 gap-2">
                    @auth
                        <li class="nav-item">
                            <a class="nav-link text-white {{ request()->routeIs('home') ? 'active fw-bold text-primary' : '' }}" href="{{ route('home') }}">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white {{ request()->routeIs('collection') ? 'active fw-bold text-primary' : '' }}" href="{{ route('collection') }}">Collection</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white {{ request()->routeIs('about') ? 'active fw-bold text-primary' : '' }}" href="{{ route('about') }}">About</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white {{ request()->routeIs('contact') ? 'active fw-bold text-primary' : '' }}" href="{{ route('contact') }}">Contact</a>
                        </li>
                    @endauth

                    @guest
                        <li class="nav-item">
                            <a class="nav-link text-white active fw-bold text-primary" href="{{ route('landing') }}">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white-50" href="{{ route('login') }}" onclick="alert('Harap masuk ke akun kamu terlebih dahulu untuk melihat koleksi penuh kami.');">Collection</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white-50" href="{{ route('login') }}" onclick="alert('Harap masuk ke akun kamu terlebih dahulu untuk mengakses menu ini.');">About</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white-50" href="{{ route('login') }}" onclick="alert('Harap masuk ke akun kamu terlebih dahulu untuk menghubungi kami.');">Contact</a>
                        </li>
                    @endguest
                </ul>

                <div class="d-flex align-items-center gap-4">
                    @auth
                        <a href="{{ route('search') }}" class="text-white text-decoration-none {{ request()->routeIs('search') ? 'text-primary' : '' }}">
                            <i class="bi bi-search fs-5"></i>
                        </a>

                        <a href="{{ route('cart.index') }}" class="text-white text-decoration-none position-relative {{ request()->routeIs('cart.index') ? 'text-primary' : '' }}">
                            <i class="bi bi-cart3 fs-5"></i>
                        </a>

                        <a href="{{ route('profile.index') }}" class="text-decoration-none {{ request()->routeIs('profile.*') ? 'text-primary' : 'text-white' }}" title="Profil Saya">
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
