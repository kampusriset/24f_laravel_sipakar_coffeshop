<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin - Coffee Shop</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: system-ui, sans-serif; background: #f4f0e8; }
        .navbar { background: #4b2e1e; color: #fff; padding: 14px 24px; display: flex; justify-content: space-between; align-items: center; }
        .navbar a { color: #fff; text-decoration: none; font-weight: 600; }
        .navbar form button { background: transparent; border: 1px solid #fff; color: #fff; padding: 6px 14px; border-radius: 6px; cursor: pointer; }
        .container { max-width: 900px; margin: 32px auto; padding: 0 16px; }
        .menu-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 16px; margin-top: 24px; }
        .card { background: #fff; border-radius: 10px; padding: 20px; text-align: center; box-shadow: 0 2px 8px rgba(0,0,0,0.07); }
        .card h2 { font-size: 2rem; color: #4b2e1e; }
        .card p { color: #888; margin-top: 4px; }
        .btn { display: inline-block; margin-top: 24px; padding: 10px 20px; background: #4b2e1e; color: #fff; border-radius: 6px; text-decoration: none; }
    </style>
</head>
<body>
    <div class="navbar">
        <span>☕ Coffee Shop Admin</span>
        <form method="POST" action="{{ route('admin.logout') }}">
            @csrf
            <button type="submit">Logout</button>
        </form>
    </div>

    <div class="container">
        <h1 style="color:#2b1d12; margin-bottom:8px;">Dashboard</h1>
        <p style="color:#888;">Selamat datang, Admin.</p>

        <div class="menu-grid">
            <div class="card">
                <h2>{{ \App\Models\Menu::count() }}</h2>
                <p>Total Menu</p>
            </div>
            <div class="card">
                <h2>{{ \App\Models\KategoriMenu::count() }}</h2>
                <p>Total Kategori</p>
            </div>
        </div>

        <a href="/admin" class="btn" style="background:#d97706;">Buka Filament Dashboard →</a>
        <a href="{{ route('admin.menu.index') }}" class="btn">Kelola Menu →</a>
        <a href="{{ route('admin.stok-prediction.index') }}" class="btn" style="background:#8a5a3c; opacity: 0.7;">Prediksi Stok (AI Nonaktif) →</a>
    </div>
</body>
</html>