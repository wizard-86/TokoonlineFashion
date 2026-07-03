@extends('layouts.app')

@section('title', 'URBAN VIBE | Keranjang Belanja')

@section('content')
<section class="py-5 my-5" style="background-color: #0b0b0b;">
    <div class="container pt-5 text-white">
        <h2 class="fw-bold mb-4"><i class="bi bi-cart3 text-primary me-2"></i>Keranjang Belanja</h2>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show border-0 text-white rounded-3 mb-4" style="background-color: #198754;" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss=\"alert\" aria-label=\"Close\"></button>
            </div>
        @endif

        @if($cartDetails->isEmpty())
            <div class="text-center py-5 rounded-4 border border-secondary bg-dark">
                <i class="bi bi-cart-x text-secondary display-1 mb-3"></i>
                <h4 class="fw-bold">Keranjang Anda Kosong</h4>
                <p class="text-secondary">Yuk, jelajahi koleksi kami dan temukan gaya urban favoritmu!</p>
                <a href="{{ route('collection') }}" class="btn btn-primary rounded-pill px-4 fw-bold mt-2">Mulai Belanja</a>
            </div>
        @else
            <div class="row g-4">
                <div class="col-lg-8">
                    <div class="table-responsive bg-dark p-3 rounded-4 border border-secondary">
                        <table class="table table-dark align-middle mb-0">
                            <thead>
                                <tr class="text-secondary border-bottom border-secondary small tracking-wide">
                                    <th scope="col" class="pb-3">PRODUK</th>
                                    <th scope="col" class="pb-3 text-center">JUMLAH</th>
                                    <th scope="col" class="pb-3 text-end">TOTAL</th>
                                    <th scope="col" class="pb-3 text-center">AKSI</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($cartDetails as $detail)
                                    <tr class="border-bottom border-secondary border-opacity-25">
                                        <td class="py-3">
                                            <div class="d-flex align-items-center gap-3">
                                                <img src="{{ asset('assets/' . ($detail->product->image ?? 'default.png')) }}" class="rounded-3 object-fit-cover border border-secondary" style="width: 70px; height: 70px;" alt="">
                                                <div>
                                                    <h6 class="fw-bold mb-1 text-white">{{ $detail->product->name ?? 'Produk Tidak Tersedia' }}</h6>
                                                    <small class="text-primary fw-medium">Rp {{ number_format($detail->product->price ?? 0, 0, ',', '.') }}</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="py-3 text-center">
                                            <form action="{{ route('cart.update', $detail->id) }}" method="POST" class="d-flex align-items-center justify-content-center gap-2 m-0">
                                                @csrf
                                                @method('PUT')
                                                <input type="number" name="quantity" value="{{ $detail->quantity }}" min="1" class="form-control bg-dark border-secondary text-white text-center rounded-3 p-1" style="width: 60px; height: 35px;">
                                                <button type="submit" class="btn btn-sm btn-outline-secondary px-2 py-1" style="height: 35px;"><i class="bi bi-arrow-clockwise"></i></button>
                                            </form>
                                        </td>
                                        <td class="py-3 text-end fw-semibold text-white">
                                            Rp {{ number_format(($detail->product->price ?? 0) * $detail->quantity, 0, ',', '.') }}
                                        </td>
                                        <td class="py-3 text-center">
                                            <form action="{{ route('cart.destroy', $detail->id) }}" method="POST" class="m-0">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn text-secondary hover-white bg-transparent border-0"><i class="bi bi-trash3 fs-5"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="card bg-dark rounded-4 border border-secondary p-4 shadow">
                        <h5 class="fw-bold mb-4 border-bottom border-secondary pb-2">Ringkasan Belanja</h5>
                        <div class="d-flex justify-content-between mb-3 text-secondary small">
                            <span>Subtotal Barang</span>
                            <span class="text-white fw-medium">Rp {{ number_format($totalSemua, 0, ',', '.') }}</span>
                        </div>
                        <div class="d-flex justify-content-between mb-3 text-secondary small">
                            <span>Biaya Pengiriman</span>
                            <span class="text-success fw-medium">Otomatis di Kasir</span>
                        </div>
                        <hr class="border-secondary my-3">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <span class="fw-semibold">Total Belanja</span>
                            <h4 class="text-primary fw-bold mb-0">Rp {{ number_format($totalSemua, 0, ',', '.') }}</h4>
                        </div>
                        <a href="{{ route('checkout.index') }}" class="btn btn-premium w-100 py-3 rounded-3 fw-bold fs-5 shadow-sm text-center text-decoration-none">
                            <i class="bi bi-shield-check me-2"></i>Lanjut ke Checkout
                        </a>
                    </div>
                </div>
            </div>
        @endif
    </div>
</section>

<style>
    .table-dark { --bs-table-bg: transparent !important; }
    .object-fit-cover { object-fit: cover; }
    .hover-white:hover { color: #ffffff !important; transition: color 0.2s; }
    .btn-premium { background-color: #0d6efd; border: 1px solid #0d6efd; color: #fff; transition: all 0.3s ease; }
    .btn-premium:hover { background-color: #0b5ed7; border-color: #0a58ca; color: #fff; }
</style>
@endsection
