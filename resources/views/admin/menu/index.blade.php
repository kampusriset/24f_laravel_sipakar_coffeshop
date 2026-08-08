<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kelola Menu - Admin</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: system-ui, sans-serif; background: #f4f0e8; }
        .navbar { background: #4b2e1e; color: #fff; padding: 14px 24px; display: flex; justify-content: space-between; align-items: center; }
        .navbar a { color: #fff; text-decoration: none; }
        .navbar form button { background: transparent; border: 1px solid #fff; color: #fff; padding: 6px 14px; border-radius: 6px; cursor: pointer; }
        .container { max-width: 960px; margin: 32px auto; padding: 0 16px; }
        .top { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; }
        .btn { padding: 8px 16px; background: #4b2e1e; color: #fff; border-radius: 6px; text-decoration: none; font-size: 0.9rem; }
        .btn-danger { background: #b00020; border: none; cursor: pointer; padding: 6px 12px; color: #fff; border-radius: 6px; font-size: 0.85rem; }
        .btn-edit { background: #6b4226; padding: 6px 12px; color: #fff; border-radius: 6px; text-decoration: none; font-size: 0.85rem; }
        table { width: 100%; border-collapse: collapse; background: #fff; border-radius: 10px; overflow: hidden; box-shadow: 0 2px 8px rgba(0,0,0,0.07); }
        th { background: #4b2e1e; color: #fff; padding: 12px 16px; text-align: left; font-size: 0.85rem; }
        td { padding: 12px 16px; border-bottom: 1px solid #f0e8df; font-size: 0.9rem; vertical-align: middle; }
        tr:last-child td { border-bottom: none; }
        .gambar { width: 56px; height: 56px; object-fit: cover; border-radius: 6px; }
        .no-gambar { width: 56px; height: 56px; background: #eee; border-radius: 6px; display: flex; align-items: center; justify-content: center; font-size: 0.7rem; color: #aaa; }
        .alert { padding: 12px 16px; border-radius: 6px; margin-bottom: 16px; background: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
    </style>
</head>
<body>
    <div class="navbar">
        <a href="{{ route('admin.dashboard') }}">← Dashboard</a>
        <form method="POST" action="{{ route('admin.logout') }}">
            @csrf
            <button type="submit">Logout</button>
        </form>
    </div>

    <div class="container">
        <div class="top">
            <h1 style="color:#2b1d12;">Kelola Menu</h1>
            <a href="{{ route('admin.menu.create') }}" class="btn">+ Tambah Menu</a>
        </div>

        @if (session('success'))
            <div class="alert">{{ session('success') }}</div>
        @endif

        <table>
            <thead>
                <tr>
                    <th>Gambar</th>
                    <th>Nama Menu</th>
                    <th>Kategori</th>
                    <th>Harga</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($menus as $menu)
                    <tr>
                        <td>
                            @if ($menu->gambar)
                                <img src="{{ Storage::url($menu->gambar) }}" class="gambar">
                            @else
                                <div class="no-gambar">No img</div>
                            @endif
                        </td>
                        <td>{{ $menu->nama_menu }}</td>
                        <td>{{ $menu->kategori->nama_kategori ?? '-' }}</td>
                        <td>Rp {{ number_format($menu->harga, 0, ',', '.') }}</td>
                        <td style="display:flex; gap:8px; align-items:center;">
                            <a href="{{ route('admin.menu.edit', $menu->id_menu) }}" class="btn-edit">Edit</a>
                            <form method="POST" action="{{ route('admin.menu.destroy', $menu->id_menu) }}"
                                  onsubmit="return confirm('Yakin hapus menu ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-danger">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" style="text-align:center; color:#aaa; padding:32px;">
                            Belum ada menu. <a href="{{ route('admin.menu.create') }}">Tambah sekarang</a>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div style="margin-top:16px;">
            {{ $menus->links() }}
        </div>
    </div>
</body>
</html>