@extends('layouts.app')

@section('title', 'URBAN VIBE | Keranjang Belanja')

@section('content')
<section class="py-5 my-5" style="background-color: #0b0b0b;">
    <div class="container pt-5 text-white">
        <h2 class="fw-bold mb-4"><i class="bi bi-cart3 text-primary me-2"></i>Keranjang Belanja</h2>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show border-0 text-white rounded-3 mb-4" style="background-color: #198754;" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show border-0 text-white rounded-3 mb-4" style="background-color: #dc3545;" role="alert">
                <i class="bi bi-exclamation-triangle-fill me-2"></i> {{ session('error') }}
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
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
                                    <th scope="col" class="pb-3 text-center">UKURAN</th> <!-- TAMBAHAN HEADER -->
                                    <th scope="col" class="pb-3 text-center">JUMLAH</th>
                                    <th scope="col" class="pb-3 text-end">TOTAL</th>
                                    <th scope="col" class="pb-3 text-center">AKSI</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($cartDetails as $detail)
                                    @php
                                        $availableSizes = !empty($detail->product->sizes)
                                            ? array_map('trim', explode(',', $detail->product->sizes))
                                            : (stripos($detail->product->category->name ?? '', 'sepatu') !== false
                                                ? range(38, 43)
                                                : ['S', 'M', 'L', 'XL', 'XXL']);
                                    @endphp
                                    <tr class="border-bottom border-secondary border-opacity-25 cart-row" data-detail-id="{{ $detail->id }}">
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
                                            <span class="cart-view-size badge bg-black border border-secondary text-white px-3 py-2 fw-bold" style="font-size: 0.85rem;">
                                                {{ $detail->size ?? 'XL' }}
                                            </span>
                                            <select class="cart-edit-size form-select form-select-sm bg-dark text-white border-secondary d-none" name="size" aria-label="Pilih ukuran">
                                                @foreach($availableSizes as $sizeOption)
                                                    <option value="{{ $sizeOption }}" {{ (string) ($detail->size ?? 'XL') === (string) $sizeOption ? 'selected' : '' }}>{{ $sizeOption }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td class="py-3 text-center">
                                            <div class="cart-view-quantity d-flex align-items-center justify-content-center gap-2 m-0">
                                                <span class="fw-bold px-2" style="min-width: 30px;">{{ $detail->quantity }}</span>
                                            </div>
                                            <div class="cart-edit-quantity d-none d-flex align-items-center justify-content-center gap-2 m-0">
                                                <button type="button" class="btn btn-sm btn-outline-secondary quantity-decrease" data-detail-id="{{ $detail->id }}">-</button>
                                                <input type="number" class="form-control form-control-sm text-center bg-dark text-white border-secondary quantity-input" min="1" max="{{ $detail->product->stock ?? 1 }}" value="{{ $detail->quantity }}" style="width: 72px;">
                                                <button type="button" class="btn btn-sm btn-outline-secondary quantity-increase" data-detail-id="{{ $detail->id }}">+</button>
                                            </div>
                                        </td>
                                        <td class="py-3 text-end fw-semibold text-white">
                                            Rp {{ number_format(($detail->product->price ?? 0) * $detail->quantity, 0, ',', '.') }}
                                        </td>
                                        <td class="py-3 text-center">
                                            <div class="d-flex flex-column align-items-center gap-2">
                                                <button type="button" class="btn btn-sm btn-outline-primary cart-edit-toggle" data-detail-id="{{ $detail->id }}">Ubah</button>

                                                <div class="cart-edit-actions d-none d-flex gap-2">
                                                    <form action="{{ route('cart.update', $detail->id) }}" method="POST" class="m-0 cart-edit-form">
                                                        @csrf @method('PUT')
                                                        <input type="hidden" name="quantity" value="{{ $detail->quantity }}">
                                                        <input type="hidden" name="size" value="{{ $detail->size ?? 'XL' }}">
                                                        <button type="submit" class="btn btn-sm btn-success">Simpan</button>
                                                    </form>
                                                    <button type="button" class="btn btn-sm btn-outline-secondary cart-cancel-edit">Batal</button>
                                                </div>

                                                <button type="button" class="btn btn-sm btn-outline-danger cart-delete-trigger" data-bs-toggle="modal" data-bs-target="#deleteCartModal-{{ $detail->id }}">
                                                    <i class="bi bi-trash3"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>

                                    <div class="modal fade" id="deleteCartModal-{{ $detail->id }}" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content bg-dark text-white border border-secondary rounded-4">
                                                <div class="modal-body p-4 text-center">
                                                    <i class="bi bi-trash3-fill text-danger fs-1 mb-3"></i>
                                                    <h5 class="fw-bold mb-3">Hapus produk dari keranjang?</h5>
                                                    <p class="text-secondary mb-4">Tindakan ini akan menghapus item <strong class="text-white">{{ $detail->product->name ?? 'produk ini' }}</strong> dari keranjang.</p>
                                                    <div class="d-flex justify-content-center gap-2">
                                                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
                                                        <form action="{{ route('cart.destroy', $detail->id) }}" method="POST" class="m-0">
                                                            @csrf @method('DELETE')
                                                            <button type="submit" class="btn btn-danger">Hapus</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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
