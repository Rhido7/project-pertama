<!DOCTYPE html>
<html>
<head>
    <title>Data Produk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <div id="app" class="container mt-4">
        <h2>Data Produk</h2>
        <a href="{{ route('produk.create') }}" class="btn btn-primary mb-3">Tambah Produk</a>
        <a href="{{ route('kategori.index') }}" class="btn btn-secondary mb-3">Kelola Kategori</a>
        <search-produk
            :produks="{{ json_encode($produks->load('kategori')) }}"
            csrf="{{ csrf_token() }}"
        ></search-produk>
    </div>
</body>
</html>