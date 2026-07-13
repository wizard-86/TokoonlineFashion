@extends('admin.layout')

@section('admin_content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1 class="h2 fw-bold mb-1">Manajemen Voucher</h1>
        <p class="text-secondary mb-0">Buat, edit, dan hapus voucher yang akan digunakan customer.</p>
    </div>
    <a href="{{ route('admin.vouchers.create') }}" class="btn btn-primary fw-semibold rounded-pill px-4">
        <i class="bi bi-plus-circle me-2"></i>Tambah Voucher
    </a>
</div>

<div class="card card-custom p-3">
    <div class="table-responsive">
        <table class="table table-custom align-middle">
            <thead>
                <tr>
                    <th>Kode</th>
                    <th>Tipe</th>
                    <th>Nilai</th>
                    <th>Min Order</th>
                    <th>Kuota</th>
                    <th>Status</th>
                    <th>Masa Berlaku</th>
                    <th>Admin Pembuat</th>
                    <th class="text-end">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($vouchers as $voucher)
                    <tr>
                        <td class="fw-bold text-white">{{ $voucher->code }}</td>
                        <td>{{ ucfirst($voucher->type) }}</td>
                        <td>
                            @if($voucher->type === 'percentage')
                                {{ $voucher->value }}%
                            @else
                                Rp {{ number_format($voucher->value, 0, ',', '.') }}
                            @endif
                        </td>
                        <td>Rp {{ number_format($voucher->min_order, 0, ',', '.') }}</td>
                        <td>{{ $voucher->quota }}</td>
                        <td>
                            @if($voucher->status === 'active')
                                <span class="badge bg-success">Aktif</span>
                            @else
                                <span class="badge bg-secondary">Nonaktif</span>
                            @endif
                        </td>
                        <td>
                            @if($voucher->expires_at)
                                {{ \Carbon\Carbon::parse($voucher->expires_at)->translatedFormat('d M Y H:i') }}
                            @else
                                <span class="text-secondary">Tidak ada</span>
                            @endif
                        </td>
                        <td>{{ $voucher->creator?->name ?? '-' }}</td>
                        <td class="text-end">
                            <div class="d-flex justify-content-end gap-2">
                                <a href="{{ route('admin.vouchers.edit', $voucher->id) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                                <form action="{{ route('admin.vouchers.destroy', $voucher->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus voucher ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9" class="text-center text-secondary py-4">Belum ada voucher.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
