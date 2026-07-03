@extends('layouts.app')

@section('title', 'URBAN VIBE | Login Akun')

@section('content')
<section class="py-5 my-5 d-flex align-items-center" style="background-color: #0b0b0b; min-height: 75vh;">
    <div class="container pt-5">
        <div class="row justify-content-center">
            <div class="col-md-5">

                <div class="card bg-dark rounded-4 border border-secondary p-4 p-sm-5 shadow-lg">
                    <div class="text-center mb-4">
                        <h2 class="fw-bold text-white tracking-wide">URBAN<span class=\"text-primary\">VIBE</span></h2>
                        <p class="text-secondary small">Masuk untuk mengakses koleksi penuh & profile kamu</p>
                    </div>

                    @if($errors->has('login_error'))
                        <div class=\"alert alert-danger bg-danger bg-opacity-10 border-danger text-danger small rounded-3 mb-4\">
                            {{ $errors->first('login_error') }}
                        </div>
                    @endif

                    <form action="{{ route('login.submit') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="email" class="form-label text-secondary small fw-bold">EMAIL ADDRESS</label>
                            <input type="email" name="email" id="email" class="form-control bg-opacity-10 bg-white text-white border-secondary py-2.5 px-3 custom-input" placeholder="masukkan email..." value="{{ old('email') }}" required>
                        </div>

                        <div class="mb-4">
                            <label for="password" class="form-label text-secondary small fw-bold">PASSWORD</label>
                            <input type="password" name="password" id="password" class="form-control bg-opacity-10 bg-white text-white border-secondary py-2.5 px-3 custom-input" placeholder="••••••••" required>
                        </div>

                        <button type="submit" class="btn btn-primary w-100 py-2.5 rounded-3 fw-bold tracking-wide text-uppercase shadow-sm mb-3">
                            Sign In
                        </button>
                    </form>

                    <div class="mt-3 text-center">
                        <p class="text-secondary">Belum punya akun?
                            <a href="{{ route('register') }}" class="text-primary text-decoration-none fw-bold">Daftar Akun Baru</a>
                        </p>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

<style>
    .custom-input { transition: all 0.2s ease; }
    .custom-input:focus {
        background-color: rgba(255, 255, 255, 0.15) !important;
        border-color: #0d6efd !important;
        color: #fff !important;
        box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25) !important;
    }
</style>
@endsection
