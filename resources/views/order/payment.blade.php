<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran Pesanan #{{ $order->id }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', sans-serif;
        }

        body {
            background-color: #0f1115;
            color: #e4e6eb;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
        }

        .container {
            max-width: 650px;
            width: 100%;
            background: #181a20;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
            padding: 30px;
            border: 1px solid #2a2d35;
        }

        /* Header Style */
        .header {
            text-align: center;
            margin-bottom: 25px;
        }

        .header h2 {
            font-size: 24px;
            color: #ffffff;
            font-weight: 700;
            margin-bottom: 5px;
        }

        .header p {
            font-size: 14px;
            color: #b0b3b8;
        }

        .badge-status {
            display: inline-block;
            background: rgba(245, 158, 11, 0.2);
            color: #fbbf24;
            padding: 6px 16px;
            border-radius: 50px;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-top: 10px;
        }

        hr {
            border: 0;
            height: 1px;
            background: #2a2d35;
            margin: 20px 0;
        }

        /* Section Title */
        .section-title {
            font-size: 14px;
            font-weight: 600;
            text-transform: uppercase;
            color: #3b82f6;
            letter-spacing: 0.5px;
            margin-bottom: 15px;
        }

        /* Detail Ringkasan */
        .info-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
            background: #1f222a;
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 25px;
        }

        .info-item label {
            display: block;
            font-size: 12px;
            color: #8a8d93;
            margin-bottom: 4px;
        }

        .info-item span {
            font-size: 14px;
            font-weight: 500;
            color: #ffffff;
        }

        /* Daftar Produk */
        .product-list {
            margin-bottom: 25px;
        }

        .product-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 12px 0;
            border-bottom: 1px solid #242731;
        }

        .product-item:last-child {
            border-bottom: none;
        }

        .product-info {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .product-img {
            width: 50px;
            height: 50px;
            border-radius: 8px;
            background: #242731;
            object-fit: cover;
        }

        .product-name {
            font-size: 14px;
            font-weight: 500;
            color: #ffffff;
            margin-bottom: 2px;
        }

        .product-qty {
            font-size: 12px;
            color: #8a8d93;
        }

        .product-price {
            font-size: 14px;
            font-weight: 600;
            color: #ffffff;
        }

        /* Total Tagihan */
        .total-box {
            background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);
            border: 1px solid #334155;
            padding: 20px;
            border-radius: 12px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        .total-label {
            font-size: 15px;
            color: #94a3b8;
            font-weight: 500;
        }

        .total-price {
            font-size: 24px;
            font-weight: 700;
            color: #10b981;
        }

        /* Tombol Aksi */
        .btn-submit {
            display: block;
            width: 100%;
            background: #2563eb;
            color: #ffffff;
            text-align: center;
            padding: 14px;
            border-radius: 10px;
            font-size: 16px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.2s ease;
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.3);
        }

        .btn-submit:hover {
            background: #1d4ed8;
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(37, 99, 235, 0.4);
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="header">
            <h2>🎉 Pesanan Berhasil Dibuat!</h2>
            <p>Invoice ID: #INV-{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</p>
            <span class="badge-status">{{ $order->status }}</span>
        </div>

        <hr>

        <div class="section-title">Detail Pengiriman</div>
        <div class="info-grid">
            <div class="info-item">
                <label>Kurir Pilihan</label>
                <span>{{ $order->courier ?? 'JNE (Reguler)' }}</span>
            </div>
            <div class="info-item">
                <label>Alamat Tujuan</label>
                <span>{{ $order->address ?? 'Alamat belum diisi' }}</span>
            </div>
        </div>

        <div class="section-title">Produk yang Dibeli</div>
        <div class="product-list">
            @if($order->details && $order->details->count() > 0)
                @foreach($order->details as $item)
                    <div class="product-item">
                        <div class="product-info">
                            <img src="{{ asset('assets/images/' . ($item->product->image ?? 'default.png')) }}" class="product-img" alt="Product">
                            <div>
                                <div class="product-name">{{ $item->product->name ?? 'Produk Terhapus' }}</div>
                                <div class="product-qty">{{ $item->quantity }} Barang</div>
                            </div>
                        </div>
                        <div class="product-price">Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}</div>
                    </div>
                @endforeach
            @else
                <p style="font-size: 14px; color: #8a8d93; font-style: italic;">Item detail tidak termuat.</p>
            @endif
        </div>

        <hr>

        <div class="total-box">
            <div class="total-label">Total Tagihan Pembayaran</div>
            <div class="total-price">Rp {{ number_format($order->total_price ?? $order->total_amount, 0, ',', '.') }}</div>
        </div>

        <a href="#" class="btn-submit">Selesaikan Pembayaran Sekarang</a>
    </div>

</body>
</html>
