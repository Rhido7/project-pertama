<!DOCTYPE html>
<html>
<head>
    <title>Edit Kategori</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-4">
    <h2>Edit Kategori</h2>
    <form action="{{ route('kategori.update', $kategori->id) }}" method="POST">
        @csrf @method('PUT')
        <div class="mb-3">
            <label>Nama Kategori</label>
            <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" value="{{ $kategori->nama }}">
            @error('nama') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
        <a href="{{ route('kategori.index') }}" class="btn btn-secondary">Batal</a>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</body>
</html>