@extends('admin.layout')

@section('admin_content')
<div class="card card-custom p-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 fw-bold mb-1">Edit Voucher</h1>
            <p class="text-secondary mb-0">Ubah detail voucher dan masa berlakunya.</p>
        </div>
        <a href="{{ route('admin.vouchers.index') }}" class="btn btn-outline-light btn-sm">Kembali</a>
    </div>

    <form action="{{ route('admin.vouchers.update', $voucher->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label">Kode Voucher</label>
                <input type="text" name="code" value="{{ old('code', $voucher->code) }}" class="form-control bg-black text-white border-secondary" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">Tipe</label>
                <select name="type" class="form-select bg-black text-white border-secondary" required>
                    <option value="percentage" {{ old('type', $voucher->type) === 'percentage' ? 'selected' : '' }}>Percentage</option>
                    <option value="nominal" {{ old('type', $voucher->type) === 'nominal' ? 'selected' : '' }}>Nominal</option>
                </select>
            </div>
            <div class="col-md-6">
                <label class="form-label">Nilai Diskon</label>
                <input type="number" step="0.01" name="value" value="{{ old('value', $voucher->value) }}" class="form-control bg-black text-white border-secondary" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">Minimal Order</label>
                <input type="number" step="0.01" name="min_order" value="{{ old('min_order', $voucher->min_order) }}" class="form-control bg-black text-white border-secondary" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">Kuota</label>
                <input type="number" name="quota" value="{{ old('quota', $voucher->quota) }}" class="form-control bg-black text-white border-secondary" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">Status</label>
                <select name="status" class="form-select bg-black text-white border-secondary" required>
                    <option value="active" {{ old('status', $voucher->status) === 'active' ? 'selected' : '' }}>Aktif</option>
                    <option value="inactive" {{ old('status', $voucher->status) === 'inactive' ? 'selected' : '' }}>Nonaktif</option>
                </select>
            </div>
            <div class="col-md-12">
                <label class="form-label">Masa Berlaku</label>
                <input type="datetime-local" name="expires_at" value="{{ old('expires_at', $voucher->expires_at?->format('Y-m-d\TH:i')) }}" class="form-control bg-black text-white border-secondary">
            </div>
        </div>

        <div class="mt-4">
            <button type="submit" class="btn btn-primary px-4">Update Voucher</button>
        </div>
    </form>
</div>
@endsection
