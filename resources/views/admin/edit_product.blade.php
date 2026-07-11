@extends('admin.layout')

@section('admin_content')
<div class="pt-3 pb-2 mb-4 border-bottom border-secondary border-opacity-25">
    <h1 class="h2 fw-bold text-white">Edit Produk</h1>
</div>

<div class="card bg-dark border-secondary border-opacity-25 p-4 rounded-3 shadow text-white">
    <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label fw-semibold">Nama Produk</label>
            <input type="text" name="name" class="form-control bg-secondary bg-opacity-25 text-white border-secondary" value="{{ $product->name }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label fw-semibold">Kategori</label>
            <select name="category_id" class="form-select bg-secondary bg-opacity-25 text-white border-secondary">
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label fw-semibold">Harga (Rp)</label>
            <input type="number" name="price" class="form-control bg-secondary bg-opacity-25 text-white border-secondary" value="{{ $product->price }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label fw-semibold">Stok (pcs)</label>
            <input type="number" name="stock" class="form-control bg-secondary bg-opacity-25 text-white border-secondary" value="{{ $product->stock }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label fw-semibold">Ganti Foto Produk (Opsional)</label>
            <input type="file" name="image" class="form-control bg-secondary bg-opacity-25 text-white border-secondary">
            <div class="mt-2">
                <small class="text-secondary">Foto saat ini:</small><br>
                <img src="{{ asset('assets/' . ($product->image_url ?? $product->image)) }}" width="80" class="rounded border border-secondary mt-1">
            </div>
        </div>

        <div class="d-flex gap-2 pt-2">
            <button type="submit" class="btn btn-warning fw-bold text-dark px-4">Simpan Perubahan</button>
            <a href="{{ route('admin.products.index') }}" class="btn btn-outline-secondary px-4 text-white">Batal</a>
        </div>
    </form>
</div>
@endsection
