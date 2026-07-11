@extends('admin.layout')

@section('admin_content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-2 border-bottom border-secondary border-opacity-25">
    <h1 class="h2 fw-bold text-white">Manajemen Produk</h1>
    <a href="{{ route('admin.products.create') }}" class="btn btn-primary btn-sm px-3 rounded-3"><i class="bi bi-plus-lg me-1"></i> Tambah Produk</a>
</div>

<!-- Pemindahan Letak Notifikasi Toast: Sekarang Berada di Atas Tabel, di Bawah Judul -->
<div class="mb-3" style="min-height: 50px;">
    <div id="stockToast" class="toast align-items-center text-white bg-success border-0 shadow w-100" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
            <div class="toast-body fw-bold d-flex align-items-center gap-2">
                <i class="bi bi-check-circle-fill"></i> <span id="toastMessage">Stok berhasil diperbarui!</span>
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    </div>
</div>

@if(session('success'))
<div class="alert alert-success alert-dismissible fade show bg-success bg-opacity-25 border-success text-white rounded-3 mb-4" role="alert">
    {{ session('success') }}
    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

<div class="card bg-dark border-secondary border-opacity-25 p-4 rounded-3 shadow">
    <div class="table-responsive">
        <table class="table table-dark table-hover align-middle mb-0">
            <thead>
                <tr class="text-secondary small text-uppercase">
                    <th scope="col" style="min-width: 250px;">PRODUK</th>
                    <th scope="col">KATEGORI</th>
                    <th scope="col">HARGA</th>
                    <th scope="col" style="min-width: 140px;">STOK</th>
                    <th scope="col" class="text-end">AKSI</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                <tr>
                    <td>
                        <div class="d-flex align-items-center gap-3">
                            @php
                                $imagePath = $product->image_url ?? $product->image;
                                $finalSrc = asset('assets/' . $imagePath);
                            @endphp
                            <img src="{{ $imagePath ? $finalSrc : 'https://via.placeholder.com/50' }}"
                                 class="rounded-3 border border-secondary border-opacity-50"
                                 width="50" height="50"
                                 style="object-fit: cover; flex-shrink: 0;"
                                 alt="{{ $product->name }}">
                            <span class="fw-semibold text-white">{{ $product->name }}</span>
                        </div>
                    </td>
                    <td>
                        <span class="badge bg-secondary bg-opacity-50 text-white py-2 px-3 rounded-pill text-uppercase" style="font-size: 0.75rem;">
                            {{ $product->category->name ?? 'Uncategorized' }}
                        </span>
                    </td>
                    <td class="fw-bold text-info">
                        Rp {{ number_format($product->price, 0, ',', '.') }}
                    </td>
                    <td>
                        <!-- Perbaikan penanganan tombol dengan style pointer-events agar ikon minus terdeteksi sempurna -->
                        <div class="d-flex align-items-center gap-2">
                            <button class="btn btn-sm btn-outline-light p-1 py-0 border-opacity-50 btn-stock" data-id="{{ $product->id }}" data-type="minus" style="pointer-events: auto;">
                                <i class="bi bi-minus" style="pointer-events: none;"></i>
                            </button>
                            <span class="fw-bold text-white px-1 stock-display" id="stock-{{ $product->id }}">{{ $product->stock ?? 0 }}</span>
                            <button class="btn btn-sm btn-outline-light p-1 py-0 border-opacity-50 btn-stock" data-id="{{ $product->id }}" data-type="plus" style="pointer-events: auto;">
                                <i class="bi bi-plus" style="pointer-events: none;"></i>
                            </button>
                        </div>
                    </td>
                    <td class="text-end">
                        <div class="d-inline-flex gap-2">
                            <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-warning btn-sm rounded-3 px-3 fw-bold text-dark">Edit</a>

                            <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus produk {{ $product->name }} ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger btn-sm rounded-3 px-3">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<meta name="csrf-token" content="{{ csrf_token() }}">

<script>
document.addEventListener('DOMContentLoaded', function () {
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    const toastElement = document.getElementById('stockToast');
    const toast = new bootstrap.Toast(toastElement, { delay: 3000 });
    const toastMessage = document.getElementById('toastMessage');

    document.querySelectorAll('.btn-stock').forEach(button => {
        button.addEventListener('click', function (e) {
            // Memastikan target klik selalu membaca elemen button utamanya
            const currentButton = e.currentTarget;
            const id = currentButton.getAttribute('data-id');
            const type = currentButton.getAttribute('data-type');
            const stockElement = document.getElementById(`stock-${id}`);
            let currentStock = parseInt(stockElement.innerText);

            if (type === 'plus') {
                currentStock++;
            } else if (type === 'minus' && currentStock > 0) {
                currentStock--;
            } else {
                return;
            }

            // Perbaikan URL Fetch disesuaikan rute asli admin panel
            fetch(`/admin/products/${id}/update-stock`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                },
                body: JSON.stringify({ stock: currentStock })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    stockElement.innerText = data.new_stock;

                    toastMessage.innerText = `Stok diperbarui menjadi ${data.new_stock} pcs!`;
                    toast.show();
                }
            })
            .catch(error => console.error('Error:', error));
        });
    });
});
</script>
@endsection
