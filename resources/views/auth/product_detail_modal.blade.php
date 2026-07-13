<div class="row g-0">
    <div class="col-lg-6">
        <div class="detail-img-container shadow h-100">
            <img src="{{ asset('assets/' . ($product->image ?? 'default.png')) }}" alt="{{ $product->name }}" class="img-fluid detail-img w-100 h-100" style="object-fit: cover;">
        </div>
    </div>

    <div class="col-lg-6">
        <div class="p-4 p-lg-5 d-flex flex-column h-100 justify-content-between">
            <div>
                <div class="mb-3">
                    <span class="badge bg-primary text-white px-3 py-1.5 rounded-pill fw-bold" style="font-size: 0.75rem; letter-spacing: 0.5px;">
                        <i class="bi bi-shop me-1"></i> URBAN VIBE OFFICIAL STORE
                    </span>
                </div>

                <span class="text-primary fw-bold tracking-wide text-uppercase small">{{ $product->category->name ?? 'STREETWEAR' }}</span>
                <h2 class="fw-bold mt-2 mb-3 text-white">{{ $product->name }}</h2>
                <h4 class="text-primary fw-bold mb-4">Rp {{ number_format($product->price, 0, ',', '.') }}</h4>

                <div class="mb-4 p-3 rounded-4 border border-secondary border-opacity-50" style="background-color: #111;">
                    <div class="row align-items-center text-center text-sm-start">
                        <div class="col-sm-6 mb-2 mb-sm-0">
                            <span class="text-secondary small d-block mb-1">Status Barang</span>
                            @if(($product->stock ?? 0) > 0)
                                <span class="text-success fw-bold"><i class="bi bi-patch-check-fill me-1"></i> Ready Stock</span>
                            @else
                                <span class="text-danger fw-bold"><i class="bi bi-x-circle-fill me-1"></i> Out of Stock</span>
                            @endif
                        </div>
                        <div class="col-sm-6 text-sm-end">
                            <span class="text-secondary small d-block mb-1">Tersedia Sisa</span>
                            <span class="badge bg-secondary text-dark fw-bolder px-3 py-2 fs-6">{{ (int) ($product->stock ?? 0) }} Pcs</span>
                        </div>
                    </div>
                </div>

                <p class="text-secondary lh-base fs-6 mb-4">
                    {{ $product->description ?? 'Pakaian streetwear eksklusif produksi Urban Vibe. Dibuat menggunakan bahan material kain katun premium pilihan berkualitas tinggi.' }}
                </p>
            </div>

            <form action="{{ route('cart.add', $product->id) }}" method="POST" class="d-flex flex-column gap-3" data-product-modal-form="true">
                @csrf
                <div class="d-flex align-items-center gap-3 flex-wrap">
                    <div class="d-flex border border-secondary rounded-4 overflow-hidden bg-dark" style="max-width: 130px; height: 55px;">
                        <button type="button" class="btn btn-dark border-0 px-3 fs-5" onclick="this.parentNode.querySelector('input[type=number]').stepDown()">-</button>
                        <input type="number" name="quantity" value="1" min="1" max="{{ (int) ($product->stock ?? 1) }}" class="form-control bg-transparent border-0 text-center text-white fw-bold fs-5 p-0 no-spinner" style="width: 50px;">
                        <button type="button" class="btn btn-dark border-0 px-3 fs-5" onclick="this.parentNode.querySelector('input[type=number]').stepUp()">+</button>
                    </div>

                    <button type="submit" class="btn btn-checkout flex-grow-1 py-3 fw-bold fs-6 {{ ($product->stock ?? 0) <= 0 ? 'disabled' : '' }}">
                        <i class="bi bi-cart-plus-fill me-2"></i> {{ ($product->stock ?? 0) <= 0 ? 'OUT OF STOCK' : 'ADD TO CART' }}
                    </button>
                </div>

                <div class="d-flex gap-2 flex-wrap">
                    <a href="{{ route('cart.index') }}" class="btn btn-outline-light rounded-3 fw-semibold">
                        <i class="bi bi-bag-check-fill me-2"></i> Lihat Keranjang
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    .detail-img-container { background-color: #111; border-radius: 20px; border: 1px solid #222; overflow: hidden; }
    .detail-img { width: 100%; height: auto; object-fit: cover; transition: transform 0.5s ease; }
    .detail-img-container:hover .detail-img { transform: scale(1.05); }

    .btn-checkout { background-color: #0d6efd; color: #fff; border: none; border-radius: 14px; transition: all 0.3s ease; box-shadow: 0 4px 15px rgba(13, 110, 253, 0.2); }
    .btn-checkout:hover { background-color: #0b5ed7; color: #fff; }

    .no-spinner::-webkit-outer-spin-button,
    .no-spinner::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }
    .no-spinner {
        -moz-appearance: textfield;
    }
</style>
