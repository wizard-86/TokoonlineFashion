<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>URBAN VIBE | Distro & Fashion Store</title>

    <meta name="description"
    content="Toko online distro fashion premium dengan koleksi streetwear terbaik.">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
    rel="stylesheet">

    <!-- Bootstrap Icon -->
    <link rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <!-- Custom CSS -->
    <link rel="stylesheet"
    href="{{ asset('css/style.css') }}">

</head>
<body>

    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top py-4">

        <div class="container">

            <a class="navbar-brand fw-bold fs-3" href="/">
                URBAN<span class="text-primary">VIBE</span>
            </a>

            <button class="navbar-toggler"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#navbarNav">

                <span class="navbar-toggler-icon"></span>

            </button>

            <div class="collapse navbar-collapse" id="navbarNav">

                <ul class="navbar-nav ms-auto">

                    <li class="nav-item">
                        <a class="nav-link" href="#home">
                            Home
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="#collection">
                            Collection
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="#about">
                            About
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="#contact">
                            Contact
                        </a>
                    </li>

                </ul>

                <!-- ICON -->
                <div class="d-flex ms-lg-4 gap-3">

                    <a href="#"
                    class="text-white fs-5">
                        <i class="bi bi-search"></i>
                    </a>

                    <a href="#"
                    class="text-white fs-5">
                        <i class="bi bi-cart3"></i>
                    </a>

                    <!-- LOGIN -->
                    <a href="/login"
                    class="text-white fs-5">
                        <i class="bi bi-person"></i>
                    </a>

                </div>

            </div>

        </div>

    </nav>

    <!-- HERO -->
    <section id="home" class="hero-section">

        <div class="container">

            <div class="row">

                <div class="col-lg-8 hero-content">

                    <h1 class="reveal">
                        Elevate Your<br>
                        <span class="text-primary">
                            Street Style
                        </span>
                    </h1>

                    <p class="reveal">
                        Temukan koleksi eksklusif distro fashion premium
                        yang dirancang untuk ekspresi diri yang tak terbatas.
                    </p>

                    <div class="mt-4 reveal">

                        <a href="#collection"
                        class="btn btn-premium me-3">

                            Shop Now

                        </a>

                        <a href="#"
                        class="btn btn-outline-premium">

                            View Lookbook

                        </a>

                    </div>

                </div>

            </div>

        </div>

    </section>

    <!-- COLLECTION -->
    <section id="collection" class="py-5 mt-5">

        <div class="container">

            <div class="section-title reveal">

                <h2>
                    New
                    <span class="text-primary">
                        Arrivals
                    </span>
                </h2>

                <p class="text-secondary">
                    Koleksi terbaru minggu ini
                </p>

            </div>

            <div class="row g-4">

                <!-- PRODUCT 1 -->
                <div class="col-md-6 col-lg-3 reveal">

                    <div class="product-card">

                        <div class="product-img-container">

                            <img src="assets/product1.png"
                            alt="Oversized T-Shirt">

                        </div>

                        <div class="product-info">

                            <span class="product-category">
                                T-Shirts
                            </span>

                            <h5 class="mt-2">
                                Oversized Black Minimalist
                            </h5>

                            <div class="d-flex justify-content-between align-items-center mt-3">

                                <span class="fw-bold fs-5 text-primary">
                                    Rp 185.000
                                </span>

                                <button class="btn btn-sm btn-premium">
                                    <i class="bi bi-plus-lg"></i>
                                </button>

                            </div>

                        </div>

                    </div>

                </div>

                <!-- PRODUCT 2 -->
                <div class="col-md-6 col-lg-3 reveal">

                    <div class="product-card">

                        <div class="product-img-container">

                            <img src="assets/product2.png"
                            alt="Streetwear Hoodie">

                        </div>

                        <div class="product-info">

                            <span class="product-category">
                                Hoodies
                            </span>

                            <h5 class="mt-2">
                                Navy Premium Street Hoodie
                            </h5>

                            <div class="d-flex justify-content-between align-items-center mt-3">

                                <span class="fw-bold fs-5 text-primary">
                                    Rp 350.000
                                </span>

                                <button class="btn btn-sm btn-premium">
                                    <i class="bi bi-plus-lg"></i>
                                </button>

                            </div>

                        </div>

                    </div>

                </div>

                <!-- PRODUCT 3 -->
                <div class="col-md-6 col-lg-3 reveal">

                    <div class="product-card">

                        <div class="product-img-container">

                            <img src="https://images.unsplash.com/photo-1591047139829-d91aecb6caea?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80"
                            alt="Denim Jacket">

                        </div>

                        <div class="product-info">

                            <span class="product-category">
                                Jackets
                            </span>

                            <h5 class="mt-2">
                                Vintage Denim Rebel
                            </h5>

                            <div class="d-flex justify-content-between align-items-center mt-3">

                                <span class="fw-bold fs-5 text-primary">
                                    Rp 425.000
                                </span>

                                <button class="btn btn-sm btn-premium">
                                    <i class="bi bi-plus-lg"></i>
                                </button>

                            </div>

                        </div>

                    </div>

                </div>

                <!-- PRODUCT 4 -->
                <div class="col-md-6 col-lg-3 reveal">

                    <div class="product-card">

                        <div class="product-img-container">

                            <img src="https://images.unsplash.com/photo-1576566588028-4147f3842f27?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80"
                            alt="Graphic Tee">

                        </div>

                        <div class="product-info">

                            <span class="product-category">
                                T-Shirts
                            </span>

                            <h5 class="mt-2">
                                Abstract Art Graphic Tee
                            </h5>

                            <div class="d-flex justify-content-between align-items-center mt-3">

                                <span class="fw-bold fs-5 text-primary">
                                    Rp 195.000
                                </span>

                                <button class="btn btn-sm btn-premium">
                                    <i class="bi bi-plus-lg"></i>
                                </button>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </section>

    <!-- FOOTER -->
    <footer class="py-5 border-top border-secondary">

        <div class="container text-center">

            <h3 class="fw-bold">
                URBAN<span class="text-primary">VIBE</span>
            </h3>

            <p class="text-secondary mt-3">
                Pusat fashion distro terpercaya sejak 2024.
            </p>

            <div class="mt-4 text-secondary">
                © 2024 Urban Vibe Fashion Store
            </div>

        </div>

    </footer>

    <!-- BOOTSTRAP -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- CUSTOM JS -->
    <script src="{{ asset('js/script.js') }}"></script>

</body>
</html>
