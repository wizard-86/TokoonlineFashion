@extends('layouts.app')

@section('title', 'URBAN VIBE | Contact Us')

@section('content')
    <section class="py-5 my-5" style="background-color: #0b0b0b;">
        <div class="container pt-5 text-white">

            <!-- Header Halaman -->
            <div class="text-center mb-5 reveal">
                <h1 class="fw-bold">GET IN <span class="text-primary">TOUCH</span></h1>
                <p class="text-secondary max-width-600 mx-auto">Ada pertanyaan, kolaborasi, atau kendala dengan pesanan Anda? Hubungi tim Urban Vibe kapan saja.</p>
            </div>

            <div class="row g-5">
                <!-- KOLOM 1: FORMULIR HUBUNGI KAMI -->
                <div class="col-lg-7 reveal">
                    <div class="p-4 p-md-5 rounded-4 border border-secondary" style="background-color: #111111;">
                        <h3 class="fw-bold mb-4">Kirim Pesan</h3>
                        <form action="#" method="POST">
                            @csrf
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label text-secondary small fw-bold">NAMA LENGKAP</label>
                                    <input type="text" class="form-control bg-dark text-white border-secondary py-3 px-4 rounded-3 focus-primary" placeholder="Masukkan nama Anda" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label text-secondary small fw-bold">ALAMAT EMAIL</label>
                                    <input type="email" class="form-control bg-dark text-white border-secondary py-3 px-4 rounded-3 focus-primary" placeholder="nama@email.com" required>
                                </div>
                                <div class="col-12">
                                    <label class="form-label text-secondary small fw-bold">SUBJEK PESAN</label>
                                    <input type="text" class="form-control bg-dark text-white border-secondary py-3 px-4 rounded-3 focus-primary" placeholder="Konfirmasi order / Tanya stok / Kolaborasi" required>
                                </div>
                                <div class="col-12">
                                    <label class="form-label text-secondary small fw-bold">PESAN ANDA</label>
                                    <textarea class="form-control bg-dark text-white border-secondary py-3 px-4 rounded-3 focus-primary" rows="5" placeholder="Tuliskan detail pertanyaan atau pesan Anda di sini..." required></textarea>
                                </div>
                                <div class="col-12 mt-4">
                                    <button type="submit" class="btn btn-premium w-100 py-3 fw-bold tracking-wide">KIRIM PESAN SEKARANG</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- KOLOM 2: INFO KONTAK & MAPS -->
                <div class="col-lg-5 d-flex flex-column justify-content-between reveal">
                    <!-- Kartu Detail Kontak -->
                    <div class="d-flex flex-column gap-4 mb-4">
                        <!-- Alamat -->
                        <div class="d-flex gap-4 p-4 rounded-4 border border-secondary align-items-center" style="background-color: #111111;">
                            <div class="fs-2 text-primary bg-dark px-3 py-2 rounded-3 border border-secondary"><i class="bi bi-geo-alt"></i></div>
                            <div>
                                <h5 class="fw-bold mb-1">Our Flagship Store</h5>
                                <p class="text-secondary m-0 small">Jl. Fashion Street No. 21, Jakarta Selatan, Indonesia</p>
                            </div>
                        </div>

                        <!-- Email -->
                        <div class="d-flex gap-4 p-4 rounded-4 border border-secondary align-items-center" style="background-color: #111111;">
                            <div class="fs-2 text-primary bg-dark px-3 py-2 rounded-3 border border-secondary"><i class="bi bi-envelope-at"></i></div>
                            <div>
                                <h5 class="fw-bold mb-1">Official Email</h5>
                                <p class="text-secondary m-0 small">contact@urbanvibe.id</p>
                            </div>
                        </div>

                        <!-- WhatsApp -->
                        <div class="d-flex gap-4 p-4 rounded-4 border border-secondary align-items-center" style="background-color: #111111;">
                            <div class="fs-2 text-primary bg-dark px-3 py-2 rounded-3 border border-secondary"><i class="bi bi-whatsapp"></i></div>
                            <div>
                                <h5 class="fw-bold mb-1">WhatsApp Hotline</h5>
                                <p class="text-secondary m-0 small">+62 812 3456 7890</p>
                            </div>
                        </div>
                    </div>

                    <!-- Placeholder Google Maps Tiruan (Dark Style) -->
                    <div class="rounded-4 border border-secondary overflow-hidden flex-grow-1 d-none d-lg-block" style="min-height: 200px; position: relative;">
                        <div class="w-100 h-100 bg-dark d-flex flex-column align-items-center justify-content-center text-center p-4">
                            <i class="bi bi-map text-secondary mb-2 fs-1"></i>
                            <h6 class="fw-bold text-secondary">Google Maps - Store Location</h6>
                            <p class="text-muted small px-3">Maps terintegrasi otomatis dengan tema gelap distro</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection
