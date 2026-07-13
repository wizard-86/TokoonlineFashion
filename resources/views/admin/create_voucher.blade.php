@extends('admin.layout')

@section('admin_content')
<div class="card card-custom p-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 fw-bold mb-1">Tambah Voucher Baru</h1>
            <p class="text-secondary mb-0">Voucher dibuat oleh admin dan bisa dibuat dengan masa berlaku.</p>
        </div>
        <a href="{{ route('admin.vouchers.index') }}" class="btn btn-outline-light btn-sm">Kembali</a>
    </div>

    <form action="{{ route('admin.vouchers.store') }}" method="POST">
        @csrf
        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label">Kode Voucher</label>
                <input type="text" name="code" class="form-control bg-black text-white border-secondary" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">Tipe</label>
                <select name="type" class="form-select bg-black text-white border-secondary" required>
                    <option value="percentage">Percentage</option>
                    <option value="nominal">Nominal</option>
                </select>
            </div>
            <div class="col-md-6">
                <label class="form-label">Nilai Diskon</label>
                <input type="number" step="0.01" name="value" class="form-control bg-black text-white border-secondary" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">Minimal Order</label>
                <input type="number" step="0.01" name="min_order" class="form-control bg-black text-white border-secondary" value="0" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">Kuota</label>
                <input type="number" name="quota" class="form-control bg-black text-white border-secondary" value="100" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">Status</label>
                <select name="status" class="form-select bg-black text-white border-secondary" required>
                    <option value="active">Aktif</option>
                    <option value="inactive">Nonaktif</option>
                </select>
            </div>
            <div class="col-md-12">
                <label class="form-label">Masa Berlaku</label>
                <input type="datetime-local" name="expires_at" class="form-control bg-black text-white border-secondary">
            </div>
        </div>

        <div class="mt-4">
            <button type="submit" class="btn btn-primary px-4">Simpan Voucher</button>
        </div>
    </form>
</div>
@endsection
