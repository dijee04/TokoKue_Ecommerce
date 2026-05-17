<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Nota Transaksi #{{ $order->id }}</title>
    <style>
        body { font-family: 'Courier New', Courier, monospace; color: #333; max-width: 600px; margin: 20px auto; padding: 20px; border: 1px solid #ddd; }
        .header { text-align: center; border-bottom: 2px dashed #333; padding-bottom: 10px; margin-bottom: 20px; }
        .info { margin-bottom: 20px; font-size: 14px; }
        .table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        .table th, .table td { text-align: left; padding: 8px 0; border-bottom: 1px solid #eee; }
        .total { text-align: right; font-size: 18px; font-weight: bold; border-top: 2px dashed #333; padding-top: 10px; }
        .footer { text-align: center; margin-top: 40px; font-size: 12px; color: #777; }
        @media print {
            .btn-print { display: none; }
            body { border: none; margin: 0; }
        }
        .btn-print { background: #6d4c41; color: white; border: none; padding: 10px 20px; border-radius: 5px; cursor: pointer; float: right; }
    </style>
</head>
<body>
    <button class="btn-print" onclick="window.print()">Cetak Nota</button>
    <div class="header">
        <h1 style="margin: 0; font-size: 24px;">DEAR SEANA BAKERY</h1>
        <p style="margin: 5px 0;">Jl. Kenangan No. 123, Jakarta</p>
        <p style="margin: 0;">WA: 0812-3456-7890</p>
    </div>

    <div class="info">
        <p><strong>ID Pesanan:</strong> #{{ $order->id }}</p>
        <p><strong>Tanggal:</strong> {{ $order->created_at->format('d/m/Y H:i') }}</p>
        <p><strong>Pelanggan:</strong> {{ $order->nama_pelanggan }}</p>
        <p><strong>Alamat:</strong> {{ $order->alamat }}</p>
        <p><strong>Status:</strong> {{ strtoupper($order->payment_status) }}</p>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th>Produk</th>
                <th>Qty</th>
                <th style="text-align: right;">Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($order->items as $item)
            <tr>
                <td>{{ $item->produk->nama_produk ?? 'Produk' }}</td>
                <td>{{ $item->jumlah }}</td>
                <td style="text-align: right;">Rp {{ number_format($item->harga_satuan * $item->jumlah, 0, ',', '.') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="total">
        TOTAL: Rp {{ number_format($order->total_harga, 0, ',', '.') }}
    </div>

    <div class="footer">
        <p>Terima kasih telah berbelanja di Dear Seana Bakery!</p>
        <p>Semoga hari Anda manis semanis kue kami.</p>
    </div>
</body>
</html>
