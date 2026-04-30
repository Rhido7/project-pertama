<!DOCTYPE html>
<html>
<head>
    <title>Laporan Penjualan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-4">
    <h2>Laporan Penjualan</h2>

    <form method="GET" action="{{ route('laporan') }}" class="row mb-4">
        <div class="col-3">
            <select name="bulan" class="form-control">
                @for($i = 1; $i <= 12; $i++)
                <option value="{{ $i }}" {{ $bulan == $i ? 'selected' : '' }}>
                    {{ DateTime::createFromFormat('!m', $i)->format('F') }}
                </option>
                @endfor
            </select>
        </div>
        <div class="col-3">
            <select name="tahun" class="form-control">
                @for($y = date('Y'); $y >= date('Y')-3; $y--)
                <option value="{{ $y }}" {{ $tahun == $y ? 'selected' : '' }}>{{ $y }}</option>
                @endfor
            </select>
        </div>
        <div class="col-2">
            <button type="submit" class="btn btn-primary">Filter</button>
        </div>
    </form>

    <div class="row mb-4">
        <div class="col-4">
            <div class="card bg-primary text-white">
                <div class="card-body">
                    <h5>Total Transaksi</h5>
                    <h3>{{ $total_transaksi }}</h3>
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="card bg-success text-white">
                <div class="card-body">
                    <h5>Total Pendapatan</h5>
                    <h3>Rp {{ number_format($total_pendapatan) }}</h3>
                </div>
            </div>
        </div>
    </div>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Kode</th>
                <th>Kasir</th>
                <th>Total</th>
                <th>Waktu</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($transaksis as $i => $t)
            <tr>
                <td>{{ $i+1 }}</td>
                <td>{{ $t->kode_transaksi }}</td>
                <td>{{ $t->user->name }}</td>
                <td>Rp {{ number_format($t->total) }}</td>
                <td>{{ $t->created_at->format('d/m/Y H:i') }}</td>
                <td>
                    <a href="{{ route('transaksi.show', $t->id) }}" class="btn btn-info btn-sm">Detail</a>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center">Tidak ada transaksi bulan ini</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <a href="{{ route('transaksi.index') }}" class="btn btn-secondary">Kembali</a>
</body>
</html>