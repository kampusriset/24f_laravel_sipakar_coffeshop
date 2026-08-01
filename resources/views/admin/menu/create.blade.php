<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Menu - Admin</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: system-ui, sans-serif; background: #f4f0e8; }
        .navbar { background: #4b2e1e; color: #fff; padding: 14px 24px; display: flex; justify-content: space-between; align-items: center; }
        .navbar a { color: #fff; text-decoration: none; }
        .container { max-width: 560px; margin: 32px auto; padding: 0 16px; }
        .card { background: #fff; padding: 28px; border-radius: 10px; box-shadow: 0 2px 8px rgba(0,0,0,0.07); }
        label { display: block; font-weight: 600; font-size: 0.85rem; color: #4b2e1e; margin-bottom: 4px; margin-top: 16px; }
        input, select { width: 100%; padding: 10px 12px; border: 1px solid #ccc; border-radius: 6px; font-size: 0.95rem; }
        input:focus, select:focus { outline: none; border-color: #4b2e1e; }
        .btn { margin-top: 20px; padding: 10px 20px; background: #4b2e1e; color: #fff; border: none; border-radius: 6px; cursor: pointer; font-size: 0.95rem; }
        .btn-back { color: #4b2e1e; text-decoration: none; font-size: 0.9rem; }
        .error { color: #b00020; font-size: 0.82rem; margin-top: 4px; }
    </style>
</head>
<body>
    <div class="navbar">
        <a href="{{ route('admin.menu.index') }}">← Kembali ke Daftar Menu</a>
    </div>

    <div class="container">
        <div class="card">
            <h1 style="color:#2b1d12; font-size:1.2rem; margin-bottom:4px;">Tambah Menu Baru</h1>

            <form method="POST" action="{{ route('admin.menu.store') }}" enctype="multipart/form-data">
                @csrf

                <label for="nama_menu">Nama Menu</label>
                <input type="text" name="nama_menu" id="nama_menu" value="{{ old('nama_menu') }}" required>
                @error('nama_menu') <div class="error">{{ $message }}</div> @enderror

                <label for="harga">Harga (Rp)</label>
                <input type="number" name="harga" id="harga" value="{{ old('harga') }}" min="0" required>
                @error('harga') <div class="error">{{ $message }}</div> @enderror

                <label for="id_kategori">Kategori</label>
                <select name="id_kategori" id="id_kategori" required>
                    <option value="">-- Pilih Kategori --</option>
                    @foreach ($kategoris as $kat)
                        <option value="{{ $kat->id_kategori }}" @selected(old('id_kategori') == $kat->id_kategori)>
                            {{ $kat->nama_kategori }}
                        </option>
                    @endforeach
                </select>
                @error('id_kategori') <div class="error">{{ $message }}</div> @enderror

                <label for="gambar">Gambar Menu</label>
                <input type="file" name="gambar" id="gambar" accept="image/*">
                @error('gambar') <div class="error">{{ $message }}</div> @enderror

                <button type="submit" class="btn">Simpan Menu</button>
            </form>
        </div>
    </div>
</body>
</html>