@extends('layouts.app')

@section('title', 'URBAN VIBE | About Us')

@section('content')
    <section class="py-5 my-5" style="background-color: #0b0b0b;">
        <div class="container pt-5 text-white">

            <!-- 1. HEADER HALAMAN -->
            <div class="text-center mb-5 reveal">
                <span class="text-primary fw-bold tracking-wide small d-block mb-2">OUR STORY</span>
                <h1 class="fw-bold display-5">BEHIND THE <span class="text-primary">VIBE</span></h1>
                <p class="text-secondary max-width-600 mx-auto mt-3">Lebih dari sekadar pakaian, kami adalah wadah ekspresi bagi kultur urban dan gaya hidup streetwear modern.</p>
            </div>

            <!-- 2. SEJARAH SINGKAT -->
            <div class="row g-5 align-items-center mb-5 pb-4 reveal">
                <div class="col-lg-6">
                    <div class="p-2 rounded-4 border border-secondary bg-dark overflow-hidden">
                        <!-- Menggunakan gambar bertema streetwear estetik -->
                        <img src="https://images.unsplash.com/photo-1558769132-cb1aea458c5e?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80" alt="Urban Vibe Culture" class="img-fluid rounded-3 opacity-75">
                    </div>
                </div>
                <div class="col-lg-6">
                    <h2 class="fw-bold mb-4">Bagaimana Kami <span class="text-primary">Bermula</span></h2>
                    <p class="text-secondary lh-lg">
                        Didirikan pada tahun 2024, **URBAN VIBE** lahir dari kegelisahan terhadap minimnya pilihan pakaian streetwear lokal yang mampu menyeimbangkan antara kualitas material premium, kenyamanan ekstrem, dan desain yang autentik.
                    </p>
                    <p class="text-secondary lh-lg">
                        Berawal dari sebuah studio kecil di Jakarta Selatan, kami mulai merancang artikel t-shirt pertama kami yang menekankan pada kekuatan tipografi dan kultur pop urban. Kini, URBAN VIBE telah berkembang menjadi salah satu brand distro independen yang dipercaya oleh ribuan komunitas pemuda kreatif di seluruh Indonesia untuk menemani aktivitas harian mereka.
                    </p>
                </div>
            </div>

            <hr class="border-secondary my-5 opacity-25">

            <!-- 3. VISI & MISI -->
            <div class="row g-4 mb-5 pb-4 reveal">
                <div class="col-md-6">
                    <div class="p-4 p-md-5 rounded-4 border border-secondary h-100" style="background-color: #111111;">
                        <div class="fs-1 text-primary mb-3"><i class="bi bi-eye"></i></div>
                        <h3 class="fw-bold mb-3">Visi Kami</h3>
                        <p class="text-secondary lh-lg m-0">Menjadi kiblat fashion distro premium di Indonesia yang menginspirasi generasi muda untuk berani mengekspresikan karakter, kreativitas, dan kebebasan diri tanpa batas melalui pakaian yang mereka kenakan.</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="p-4 p-md-5 rounded-4 border border-secondary h-100" style="background-color: #111111;">
                        <div class="fs-1 text-primary mb-3"><i class="bi bi-rocket-takeoff"></i></div>
                        <h3 class="fw-bold mb-3">Misi Kami</h3>
                        <p class="text-secondary lh-lg m-0">Menghadirkan produk fashion berkualitas internasional dengan material terbaik, mempertahankan keaslian desain yang adaptif dengan tren global, serta memberikan pengalaman belanja eksklusif yang memprioritaskan kepuasan pelanggan.</p>
                    </div>
                </div>
            </div>

            <hr class="border-secondary my-5 opacity-25">

            <!-- 4. KEUNGGULAN PRODUK -->
            <div class="mb-5 pb-5 reveal">
                <div class="text-center mb-5">
                    <h2 class="fw-bold">KENAPA HARUS <span class="text-primary">URBAN VIBE?</span></h2>
                    <p class="text-secondary">Nilai utama yang kami dedikasikan khusus untuk Anda</p>
                </div>

                <div class="row g-4">
                    <!-- Keunggulan 1 -->
                    <div class="col-md-4">
                        <div class="p-4 text-center rounded-4 border border-secondary h-100 bg-dark">
                            <div class="fs-2 text-primary mb-3"><i class="bi bi-gem"></i></div>
                            <h5 class="fw-bold mb-2">Kualitas Premium</h5>
                            <p class="text-secondary small lh-base m-0">Setiap kain, jahitan, hingga sablon melalui proses kontrol kualitas ketat menggunakan standar bahan internasional yang adem dan tahan lama.</p>
                        </div>
                    </div>
                    <!-- Keunggulan 2 -->
                    <div class="col-md-4">
                        <div class="p-4 text-center rounded-4 border border-secondary h-100 bg-dark">
                            <div class="fs-2 text-primary mb-3"><i class="bi bi-patch-check"></i></div>
                            <h5 class="fw-bold mb-2">100% Original Design</h5>
                            <p class="text-secondary small lh-base m-0">Kami menjamin seluruh artikel produk dirancang eksklusif oleh tim desainer internal kami, membuat penampilan Anda beda dari yang lain.</p>
                        </div>
                    </div>
                    <!-- Keunggulan 3 -->
                    <div class="col-md-4">
                        <div class="p-4 text-center rounded-4 border border-secondary h-100 bg-dark">
                            <div class="fs-2 text-primary mb-3"><i class="bi bi-shield-check"></i></div>
                            <h5 class="fw-bold mb-2">Garansi Kepuasan</h5>
                            <p class="text-secondary small lh-base m-0">Ukuran baju kurang pas atau ada cacat produksi? Kami menyediakan layanan retur atau tukar barang gratis tanpa ribet demi kenyamanan Anda.</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 5. JOIN COMMUNITY BANNER (image_d9ca98.png) -->
            <div class="bg-primary p-5 rounded-4 d-flex flex-column flex-md-row justify-content-between align-items-center text-white reveal">
                <div>
                    <h2 class="fw-bold m-0">JOIN OUR COMMUNITY</h2>
                    <p class="m-0 opacity-75">Dapatkan diskon 15% untuk pembelian pertama Anda.</p>
                </div>
                <div class="mt-4 mt-md-0 d-flex gap-2 w-50-md">
                    <input type="email" class="form-control form-control-lg border-0 rounded-pill px-4" placeholder="Email Anda">
                    <button class="btn btn-dark rounded-pill px-4 fw-bold">SUBSCRIBE</button>
                </div>
            </div>

        </div>
    </section>
@endsection
