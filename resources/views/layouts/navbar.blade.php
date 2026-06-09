<nav class="navbar navbar-expand-lg navbar-dark fixed-top py-4">
    <div class="container">
        <a class="navbar-brand" href="{{ route('home') }}">URBAN<span class="text-primary">VIBE</span></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Home</a></li>
                <li class="nav-item"><a class="nav-link {{ request()->routeIs('collection') ? 'active' : '' }}" href="{{ route('collection') }}">Collection</a></li>
                <li class="nav-item"><a class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}" href="{{ route('about') }}">About</a></li>
                <li class="nav-item"><a class="nav-link {{ request()->routeIs('contact') ? 'active' : '' }}" href="{{ route('contact') }}">Contact</a></li>
            </ul>
            <div class="d-flex ms-lg-4 gap-3">
                <a href="{{ route('search') }}" class="text-white fs-5 {{ request()->routeIs('search') ? 'text-primary' : '' }}"><i class="bi bi-search"></i></a>
                <a href="{{ route('cart') }}" class="text-white fs-5 {{ request()->routeIs('cart') ? 'text-primary' : '' }}"><i class="bi bi-cart3"></i></a>
                <a href="{{ route('profile') }}" class="text-white fs-5 {{ request()->routeIs('profile') ? 'text-primary' : '' }}"><i class="bi bi-person"></i></a>
            </div>
        </div>
    </div>
</nav>
