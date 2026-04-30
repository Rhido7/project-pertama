<!DOCTYPE html>
<html>
<head>
    <title>Detail Transaksi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-4">
    <h2>Detail Transaksi</h2>
    <div class="card mb-3">
        <div class="card-body">
            <p><strong>Kode:</strong> {{ $transaksi->kode_transaksi }}</p>
            <p><strong>Kasir:</strong> {{ $transaksi->user->name }}</p>
            <p><strong>Waktu:</strong> {{ $transaksi->created_at->format('d/m/Y H:i') }}</p>
        </div>
    </div>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Produk</th>
                <th>Harga</th>
                <th>Qty</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($transaksi->details as $i => $detail)
            <tr>
                <td>{{ $i+1 }}</td>
                <td>{{ $detail->produk->nama }}</td>
                <td>Rp {{ number_format($detail->harga) }}</td>
                <td>{{ $detail->qty }}</td>
                <td>Rp {{ number_format($detail->subtotal) }}</td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th colspan="4" class="text-end">Total</th>
                <th>Rp {{ number_format($transaksi->total) }}</th>
            </tr>
            <tr>
                <th colspan="4" class="text-end">Bayar</th>
                <th>Rp {{ number_format($transaksi->bayar) }}</th>
            </tr>
            <tr>
                <th colspan="4" class="text-end">Kembalian</th>
                <th>Rp {{ number_format($transaksi->kembalian) }}</th>
            </tr>
        </tfoot>
    </table>

    <a href="{{ route('transaksi.index') }}" class="btn btn-secondary">Kembali</a>
    <a href="{{ route('transaksi.struk', $transaksi->id) }}" target="_blank" class="btn btn-warning">🖨️ Cetak Struk</a>
    <a href="{{ route('transaksi.create') }}" class="btn btn-primary">Transaksi Baru</a>
</body>
</html>