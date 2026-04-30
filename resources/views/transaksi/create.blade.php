<!DOCTYPE html>
<html>
<head>
    <title>Transaksi Baru</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-4">
    <h2>Transaksi Baru</h2>
    <form action="{{ route('transaksi.store') }}" method="POST">
        @csrf
        <div id="items">
            <div class="row mb-2 item-row">
                <div class="col-6">
                    <select name="produk_id[]" class="form-control produk-select" required>
                        <option value="">-- Pilih Produk --</option>
                        @foreach($produks as $produk)
                        <option value="{{ $produk->id }}" data-harga="{{ $produk->harga }}">
                            {{ $produk->nama }} - Rp {{ number_format($produk->harga) }} (Stok: {{ $produk->stok }})
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-3">
                    <input type="number" name="qty[]" class="form-control qty-input" placeholder="Qty" min="1" required>
                </div>
                <div class="col-3">
                    <input type="text" class="form-control subtotal-display" placeholder="Subtotal" readonly>
                </div>
            </div>
        </div>

        <button type="button" class="btn btn-success mb-3" onclick="tambahItem()">+ Tambah Item</button>

        <div class="mb-3">
            <label>Total</label>
            <input type="text" id="total-display" class="form-control" readonly>
        </div>
        <div class="mb-3">
            <label>Bayar</label>
            <input type="number" name="bayar" id="bayar" class="form-control" required min="0">
        </div>
        <div class="mb-3">
            <label>Kembalian</label>
            <input type="text" id="kembalian-display" class="form-control" readonly>
        </div>

        <a href="{{ route('transaksi.index') }}" class="btn btn-secondary">Batal</a>
        <button type="submit" class="btn btn-primary">Simpan Transaksi</button>
    </form>

    <script>
        function tambahItem() {
            const firstRow = document.querySelector('.item-row').cloneNode(true);
            firstRow.querySelectorAll('input').forEach(i => i.value = '');
            firstRow.querySelector('select').value = '';
            document.getElementById('items').appendChild(firstRow);
            attachEvents();
        }

        function attachEvents() {
            document.querySelectorAll('.produk-select, .qty-input').forEach(el => {
                el.oninput = hitungSubtotal;
            });
            document.getElementById('bayar').oninput = hitungKembalian;
        }

        function hitungSubtotal() {
            let total = 0;
            document.querySelectorAll('.item-row').forEach(row => {
                const select = row.querySelector('.produk-select');
                const qty = row.querySelector('.qty-input').value;
                const harga = select.options[select.selectedIndex]?.dataset.harga || 0;
                const subtotal = harga * qty;
                row.querySelector('.subtotal-display').value = subtotal ? 'Rp ' + parseInt(subtotal).toLocaleString('id-ID') : '';
                total += parseInt(subtotal) || 0;
            });
            document.getElementById('total-display').value = 'Rp ' + total.toLocaleString('id-ID');
            hitungKembalian();
        }

        function hitungKembalian() {
            const total = parseInt(document.getElementById('total-display').value.replace(/\D/g, '')) || 0;
            const bayar = parseInt(document.getElementById('bayar').value) || 0;
            document.getElementById('kembalian-display').value = 'Rp ' + (bayar - total).toLocaleString('id-ID');
        }

        attachEvents();
    </script>
</body>
</html>