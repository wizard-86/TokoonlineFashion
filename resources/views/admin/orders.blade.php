@extends('admin.layout')

@section('admin_content')
<div class="pt-3 pb-2 mb-4 border-bottom border-secondary border-opacity-25">
    <h1 class="h2 fw-bold text-white">Manajemen Pesanan</h1>
</div>

@if(session('success'))
<div class="alert alert-success alert-dismissible fade show bg-success bg-opacity-25 border-success text-white rounded-3 mb-4" role="alert">
    {{ session('success') }}
    <button type="button" class="btn-close btn-close-white" data-bs-alert="dismiss" aria-label="Close"></button>
</div>
@endif

<!-- Card dan Tabel bertema Hitam Gelap -->
<div class="card bg-dark border-secondary border-opacity-25 p-4 rounded-3 shadow">
    <div class="table-responsive">
        <table class="table table-dark table-hover align-middle mb-0">
            <thead>
                <tr class="text-secondary small text-uppercase">
                    <th scope="col">INVOICE</th>
                    <th scope="col">PELANGGAN</th>
                    <th scope="col">TOTAL BAYAR</th>
                    <th scope="col">METODE</th>
                    <th scope="col" style="min-width: 220px;">STATUS PESANAN</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                <tr>
                    <td>
                        <!-- PERBAIKAN: Invoice sekarang berupa link yang dapat diklik ke halaman detail -->
                        <a href="{{ route('admin.orders.show', $order->id) }}" class="text-info fw-bold text-decoration-none">
                            {{ $order->invoice ?? $order->id }}
                        </a>
                    </td>
                    <td>
                        <div class="text-white fw-semibold">{{ $order->user->name ?? 'Pelanggan' }}</div>
                        <small class="text-secondary">{{ $order->user->phone ?? '-' }}</small>
                    </td>
                    <td class="text-white">
                        Rp {{ number_format($order->total_price, 0, ',', '.') }}
                    </td>
                    <td class="text-secondary small text-uppercase">
                        {{ $order->payment_method ?? 'COD' }}
                    </td>
                    <td>
                        <!-- Form Dropdown Perubah Status Instan -->
                        <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST" class="status-form">
                            @csrf
                            <select name="status" class="form-select form-select-sm bg-secondary bg-opacity-25 text-white border-secondary fw-semibold rounded-3 target-status-select" onchange="this.form.submit()">
                                <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending (Belum Bayar)</option>
                                <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>Diproses / Dikemas</option>
                                <option value="shipping" {{ $order->status == 'shipping' ? 'selected' : '' }}>Dikirim</option>
                                <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Selesai</option>
                                <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Dibatalkan</option>
                            </select>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
