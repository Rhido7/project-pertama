<!DOCTYPE html>
<html>
<head>
    <title>Dashboard POS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="container mt-4">
    <h2>Dashboard POS</h2>
    <div class="row mb-3">
        <div class="col-md-2">
            <a href="{{ route('transaksi.index') }}" class="btn btn-primary w-100">Transaksi</a>
        </div>
        <div class="col-md-2">
            <a href="{{ route('produk.index') }}" class="btn btn-secondary w-100">Produk</a>
        </div>
        <div class="col-md-2">
            <a href="{{ route('kategori.index') }}" class="btn btn-secondary w-100">Kategori</a>
        </div>
        <div class="col-md-2">
            <a href="{{ route('laporan') }}" class="btn btn-secondary w-100">Laporan</a>
        </div>
    </div>

    <!-- Kartu Statistik -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card bg-primary text-white">
                <div class="card-body">
                    <h6>Total Transaksi</h6>
                    <h3>{{ $total_transaksi }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-success text-white">
                <div class="card-body">
                    <h6>Total Pendapatan</h6>
                    <h3>Rp {{ number_format($total_pendapatan) }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-warning text-white">
                <div class="card-body">
                    <h6>Total Produk</h6>
                    <h3>{{ $total_produk }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-info text-white">
                <div class="card-body">
                    <h6>Total Kategori</h6>
                    <h3>{{ $total_kategori }}</h3>
                </div>
            </div>
        </div>
    </div>

    <!-- Grafik -->
    <div class="card mb-4">
        <div class="card-body">
            <h5>Pendapatan 7 Hari Terakhir</h5>
            <canvas id="grafikPendapatan" height="100"></canvas>
        </div>
    </div>

    <!-- Transaksi Terbaru -->
    <div class="card">
        <div class="card-body">
            <h5>Transaksi Terbaru</h5>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Kode</th>
                        <th>Kasir</th>
                        <th>Total</th>
                        <th>Waktu</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($transaksi_terbaru as $t)
                    <tr>
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
                        <td colspan="5" class="text-center">Belum ada transaksi</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <script>
        const ctx = document.getElementById('grafikPendapatan').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: {!! json_encode($grafik_labels) !!},
                datasets: [{
                    label: 'Pendapatan (Rp)',
                    data: {!! json_encode($grafik_data) !!},
                    backgroundColor: 'rgba(54, 162, 235, 0.5)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: { beginAtZero: true }
                }
            }
        });
    </script>
</body>
</html>