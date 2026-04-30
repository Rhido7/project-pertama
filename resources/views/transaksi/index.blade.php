<!DOCTYPE html>
<html>
<head>
    <title>Riwayat Transaksi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-4">
    <h2>Riwayat Transaksi</h2>
    <a href="{{ route('transaksi.create') }}" class="btn btn-primary mb-3">Transaksi Baru</a>
    <a href="{{ route('produk.index') }}" class="btn btn-secondary mb-3">Data Produk</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Kode</th>
                <th>Kasir</th>
                <th>Total</th>
                <th>Bayar</th>
                <th>Kembalian</th>
                <th>Waktu</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($transaksis as $i => $t)
            <tr>
                <td>{{ $i+1 }}</td>
                <td>{{ $t->kode_transaksi }}</td>
                <td>{{ $t->user->name }}</td>
                <td>Rp {{ number_format($t->total) }}</td>
                <td>Rp {{ number_format($t->bayar) }}</td>
                <td>Rp {{ number_format($t->kembalian) }}</td>
                <td>{{ $t->created_at->format('d/m/Y H:i') }}</td>
                <td>
                    <a href="{{ route('transaksi.show', $t->id) }}" class="btn btn-info btn-sm">Detail</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>