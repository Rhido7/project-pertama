<!DOCTYPE html>
<html>
<head>
    <title>Struk Transaksi</title>
    <style>
        body {
            font-family: monospace;
            width: 300px;
            margin: 0 auto;
            padding: 10px;
        }
        h3, p { margin: 2px 0; text-align: center; }
        hr { border: 1px dashed #000; }
        table { width: 100%; font-size: 12px; }
        td { padding: 2px 0; }
        .total-row { font-weight: bold; }
        @media print {
            button { display: none; }
        }
    </style>
</head>
<body>
    <h3>TOKO GROSIR</h3>
    <p>Jl. Contoh No. 1, Pekanbaru</p>
    <p>Telp: 0812-3456-7890</p>
    <hr>
    <p>Kode: {{ $transaksi->kode_transaksi }}</p>
    <p>Kasir: {{ $transaksi->user->name }}</p>
    <p>Waktu: {{ $transaksi->created_at->format('d/m/Y H:i') }}</p>
    <hr>
    <table>
        @foreach($transaksi->details as $detail)
        <tr>
            <td colspan="2">{{ $detail->produk->nama }}</td>
        </tr>
        <tr>
            <td>{{ $detail->qty }} x Rp {{ number_format($detail->harga) }}</td>
            <td align="right">Rp {{ number_format($detail->subtotal) }}</td>
        </tr>
        @endforeach
    </table>
    <hr>
    <table>
        <tr class="total-row">
            <td>TOTAL</td>
            <td align="right">Rp {{ number_format($transaksi->total) }}</td>
        </tr>
        <tr>
            <td>BAYAR</td>
            <td align="right">Rp {{ number_format($transaksi->bayar) }}</td>
        </tr>
        <tr>
            <td>KEMBALI</td>
            <td align="right">Rp {{ number_format($transaksi->kembalian) }}</td>
        </tr>
    </table>
    <hr>
    <p>Terima kasih telah berbelanja!</p>
    <br>
    <center>
        <button onclick="window.print()">🖨️ Cetak Struk</button>
        <button onclick="window.close()">Tutup</button>
    </center>
</body>
</html>