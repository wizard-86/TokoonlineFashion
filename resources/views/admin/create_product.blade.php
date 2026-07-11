@extends('admin.layout')

@section('admin_content')
<div class="pt-3 pb-2 mb-4 border-bottom border-secondary border-opacity-25">
    <h1 class="h2 fw-bold text-white">Tambah Produk Baru</h1>
</div>

<div class="card bg-dark border-secondary border-opacity-25 p-4 rounded-3 shadow text-white">
    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label class="form-label fw-semibold">Nama Produk</label>
            <input type="text" name="name" class="form-control bg-secondary bg-opacity-25 text-white border-secondary" placeholder="Masukkan nama produk" required>
        </div>

        <div class="mb-3">
            <label class="form-label fw-semibold">Kategori</label>
            <select name="category_id" class="form-select bg-secondary bg-opacity-25 text-white border-secondary" required>
                <option value="" disabled selected>Pilih Kategori</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label fw-semibold">Folder Penyimpanan Gambar</label>
            <select name="folder_category" class="form-select bg-secondary bg-opacity-25 text-white border-secondary">
                <option value="sepatu">sepatu (assets/sepatu)</option>
                <option value="parfum">parfum (assets/parfum)</option>
                <option value="hodie">hodie (assets/hodie)</option>
                <option value="kaos">kaos (assets/kaos)</option>
                <option value="celana">celana (assets/celana)</option>
            </select>
            <small class="text-secondary">Menyesuaikan letak folder gambar di dalam direktori public/assets/</small>
        </div>

        <div class="mb-3">
            <label class="form-label fw-semibold">Harga (Rp)</label>
            <input type="number" name="price" class="form-control bg-secondary bg-opacity-25 text-white border-secondary" placeholder="Contoh: 500000" required>
        </div>

        <div class="mb-3">
            <label class="form-label fw-semibold">Stok Awal (pcs)</label>
            <input type="number" name="stock" class="form-control bg-secondary bg-opacity-25 text-white border-secondary" placeholder="0" required>
        </div>

        <div class="mb-3">
            <label class="form-label fw-semibold">Foto Produk</label>
            <input type="file" name="image" class="form-control bg-secondary bg-opacity-25 text-white border-secondary" required>
        </div>

        <div class="d-flex gap-2 pt-2">
            <button type="submit" class="btn btn-primary fw-bold px-4">Simpan Produk</button>
            <a href="{{ route('admin.products.index') }}" class="btn btn-outline-secondary px-4 text-white">Batal</a>
        </div>
    </form>
</div>
@endsection
