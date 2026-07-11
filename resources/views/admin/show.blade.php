@extends('layouts.app')

@section('title', 'Admin | Detail Pesanan ' . $order->invoice)

@section('content')
<section class="py-5 my-5" id="main-section" style="background-color: #0b0b0b;">
    <div class="container pt-5 text-white">

        <!-- Header & Tombol Cetak Resi di Pojok Kiri Atas -->
        <div class="d-flex justify-content-between align-items-center mb-4 pb-3 border-bottom border-secondary" id="action-header">
            <div class="d-flex align-items-center gap-3">
                <!-- Tombol Cetak Resi -->
                <a href="{{ route('admin.orders.print', $order->id) }}" target="_blank" class="btn btn-primary fw-bold px-4 py-2 rounded-3 shadow-sm">
                    <i class="bi bi-printer-fill me-2"></i>Cetak Resi
                </a>
                <a href="{{ url()->previous() }}" class="btn btn-outline-secondary px-3 py-2 rounded-3">
                    <i class="bi bi-arrow-left"></i> Kembali
                </a>
            </div>
            <div>
                <span class="text-secondary small">Status: </span>
                <span class="badge bg-warning text-dark text-uppercase fw-bold">{{ $order->status }}</span>
            </div>
        </div>

        <div class="row g-4">
            <!-- Kolom Kiri: Data Diri Pelanggan & Alamat Pengiriman -->
            <div class="col-lg-5">
                <div class="card bg-dark rounded-4 border border-secondary p-4 h-100 shadow card-print">
                    <h5 class="fw-bold mb-4 text-primary"><i class="bi bi-person-lines-fill me-2"></i>Data Diri & Pengiriman</h5>

                    <div class="mb-3">
                        <label class="text-secondary small d-block mb-1">Nama Pelanggan</label>
                        <p class="fw-bold fs-5 mb-0 text-white text-print-dark">{{ $order->user->name ?? $order->customer_name }}</p>
                    </div>

                    <div class="mb-3">
                        <label class="text-secondary small d-block mb-1">Nomor Telepon</label>
                        <p class="fw-semibold mb-0 text-white text-print-dark">{{ $order->phone ?? '083847399817' }}</p>
                    </div>

                    <div class="mb-3">
                        <label class="text-secondary small d-block mb-1">Alamat Lengkap</label>
                        <p class="mb-0 text-white-50 bg-black bg-opacity-50 p-3 rounded-3 border border-secondary border-opacity-50 text-print-dark" style="line-height: 1.6;">
                            {{ $order->address ?? 'Jl. Urban Vibe No. 12, Kecamatan Sukolilo, Kota Surabaya, Jawa Timur, 60111' }}
                        </p>
                    </div>

                    <div class="mt-4 pt-3 border-top border-secondary border-opacity-50">
                        <label class="text-secondary small d-block mb-1">Metode Pembayaran</label>
                        <span class="badge bg-secondary text-dark fw-bold text-uppercase">{{ $order->payment_method ?? 'TRANSFER BANK' }}</span>
                    </div>
                </div>
            </div>

            <!-- Kolom Kanan: Detail Barang yang Dibeli -->
            <div class="col-lg-7">
                <div class="card bg-dark rounded-4 border border-secondary p-4 h-100 shadow card-print">
                    <h5 class="fw-bold mb-4 text-primary"><i class="bi bi-box-seam-fill me-2"></i>Daftar Barang</h5>

                    <div class="table-responsive">
                        <table class="table table-dark align-middle mb-0 table-print">
                            <thead>
                                <tr class="text-secondary border-bottom border-secondary small">
                                    <th scope="col" class="pb-3">PRODUK</th>
                                    <th scope="col" class="pb-3 text-center">JUMLAH</th>
                                    <th scope="col" class="pb-3 text-end">TOTAL</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($order->orderDetails as $detail)
                                    <tr class="border-bottom border-secondary border-opacity-25">
                                        <td class="py-3">
                                            <div class="fw-bold text-white text-print-dark">{{ $detail->product->name ?? 'Produk Bawaan' }}</div>
                                            <small class="text-primary">Size: {{ $detail->size ?? 'XL' }}</small>
                                        </td>
                                        <td class="py-3 text-center text-secondary text-print-dark">
                                            {{ $detail->quantity }}x
                                        </td>
                                        <td class="py-3 text-end fw-semibold text-white text-print-dark">
                                            Rp {{ number_format(($detail->price ?? $detail->product->price) * $detail->quantity, 0, ',', '.') }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4 pt-3 border-top border-secondary d-flex justify-content-between align-items-center">
                        <span class="fw-bold text-secondary">Total Bayar (Termasuk Unik/Ongkir)</span>
                        <h4 class="text-primary fw-bold mb-0 text-print-dark">Rp {{ number_format($order->total_price, 0, ',', '.') }}</h4>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>

<style>
    .table-dark { --bs-table-bg: transparent !important; }

    /* Aturan CSS khusus saat dicetak di kertas agar rapi dan bersih */
    @media print {
        body { background-color: #ffffff !important; color: #000000 !important; }
        #main-section { background-color: #ffffff !important; margin: 0 !important; padding: 0 !important; }
        #action-header { display: none !important; }
        .card-print { background-color: #ffffff !important; border: 1px solid #ccc !important; color: #000000 !important; shadow: none !important; }
        .text-white, .text-white-50, .text-secondary, .text-print-dark { color: #000000 !important; }
        .table-print th, .table-print td { color: #000000 !important; border-bottom: 1px solid #ddd !important; }
        .bg-black { background: transparent !important; }
    }
</style>

@if(isset($autoPrint) && $autoPrint)
    <script>
        window.addEventListener('DOMContentLoaded', function() {
            window.print();
            window.onafterprint = function() {
                window.close();
            };
        });
    </script>
@endif
@endsection
