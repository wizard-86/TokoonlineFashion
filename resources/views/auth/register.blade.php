@extends('layouts.app')

@section('title', 'URBAN VIBE | Register Akun Baru')

@section('content')
<div class="container d-flex justify-content-center align-items-center" style="min-height: 80vh; padding-top: 80px; padding-bottom: 40px;">
    <div class="card p-4 border-secondary row" style="width: 100%; max-width: 450px; background-color: #121212; border-radius: 16px;">
        <div class="card-body">
            <h3 class="card-title text-center fw-bold text-white mb-2">BUAT <span class="text-primary">AKUN</span></h3>
            <p class="text-secondary text-center small mb-4">Silakan isi data untuk mulai berbelanja streetwear premium</p>

            @if ($errors->any())
                <div class="alert alert-danger py-2 small" style="border-radius: 8px;">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('register.submit') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label text-white-50 small">Nama Lengkap</label>
                    <input type="text" name="name" class="form-control bg-dark text-white border-secondary focus-primary" placeholder="Masukkan nama lengkap Anda" value="{{ old('name') }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label text-white-50 small">Email Address</label>
                    <input type="email" name="email" class="form-control bg-dark text-white border-secondary focus-primary" placeholder="nama@email.com" value="{{ old('email') }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label text-white-50 small">Nomor Telepon</label>
                    <input type="text" name="phone" class="form-control bg-dark text-white border-secondary focus-primary" placeholder="08xxxxxxxxxx" value="{{ old('phone') }}">
                </div>

                <div class="mb-3">
                    <label class="form-label text-white-50 small">Password</label>
                    <input type="password" name="password" class="form-control bg-dark text-white border-secondary focus-primary" placeholder="Minimal 8 karakter" required>
                </div>

                <div class="mb-4">
                    <label class="form-label text-white-50 small">Ulangi Password</label>
                    <input type="password" name="password_confirmation" class="form-control bg-dark text-white border-secondary focus-primary" placeholder="Sesuaikan dengan password diatas" required>
                </div>

                <button type="submit" class="btn btn-primary w-100 fw-bold py-2" style="border-radius: 8px; box-shadow: 0 0 12px rgba(13, 110, 253, 0.3);">DAFTAR SEKARANG</button>
            </form>

            <div class="mt-3 text-center">
                <p class="text-secondary small">Sudah punya akun?
                    <a href="{{ route('login') }}" class="text-primary text-decoration-none fw-bold">Masuk di sini</a>
                </p>
            </div>
        </div>
    </div>
</div>

<style>
    .focus-primary { transition: all 0.3s ease; }
    .focus-primary:focus {
        background-color: #1f1f1f !important;
        border-color: #0d6efd !important;
        box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25) !important;
        color: #fff !important;
    }
</style>
@endsection
