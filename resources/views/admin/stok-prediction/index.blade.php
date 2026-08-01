<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Prediksi Stok - Coffee Shop Admin</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: system-ui, sans-serif; background: #f4f0e8; }
        .navbar { background: #4b2e1e; color: #fff; padding: 14px 24px; display: flex; justify-content: space-between; align-items: center; }
        .navbar a { color: #fff; text-decoration: none; font-weight: 600; }
        .navbar form button { background: transparent; border: 1px solid #fff; color: #fff; padding: 6px 14px; border-radius: 6px; cursor: pointer; }
        .container { max-width: 640px; margin: 32px auto; padding: 0 16px; }
        .back-link { display: inline-block; margin-bottom: 16px; color: #4b2e1e; text-decoration: none; font-size: 0.9rem; }
        .card { background: #fff; border-radius: 10px; padding: 24px; box-shadow: 0 2px 8px rgba(0,0,0,0.07); }
        label { display: block; margin-top: 16px; margin-bottom: 6px; font-weight: 600; color: #2b1d12; font-size: 0.9rem; }
        select, input[type=number] {
            width: 100%; padding: 10px 12px; border: 1px solid #ddd; border-radius: 6px; font-size: 1rem;
        }
        .btn { margin-top: 24px; padding: 12px 20px; background: #4b2e1e; color: #fff; border: none; border-radius: 6px;
               font-size: 1rem; cursor: pointer; width: 100%; }
        .btn:hover { background: #3a2216; }
        .error-box { background: #fdecea; color: #8a1c1c; padding: 12px 16px; border-radius: 6px; margin-top: 16px; font-size: 0.9rem; }
        .result-box { margin-top: 24px; padding: 20px; border-radius: 10px; text-align: center; }
        .result-laris { background: #e6f4ea; color: #1e7a34; }
        .result-kurang { background: #fdecea; color: #8a1c1c; }
        .result-box .label { font-size: 0.85rem; opacity: 0.8; }
        .result-box .value { font-size: 1.6rem; font-weight: 700; margin-top: 4px; }
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
        <a href="{{ route('admin.dashboard') }}" class="back-link">← Kembali ke Dashboard</a>

        <div class="card">
            <h1 style="color:#2b1d12; margin-bottom:4px; font-size:1.4rem;">Prediksi Stok Menu</h1>
            <p style="color:#888; font-size:0.9rem;">Prediksi apakah suatu menu akan Laris atau Kurang Laris, untuk membantu persiapan stok bahan baku.</p>

            @if ($errors->any())
                <div class="error-box">
                    {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{ route('admin.stok-prediction.predict') }}">
                @csrf

                <label for="menu">Menu</label>
                <select name="menu" id="menu" required>
                    <option value="">-- Pilih Menu --</option>
                    @foreach ($menus as $menu)
                        <option value="{{ $menu->nama_menu }}" {{ old('menu', $input['menu'] ?? '') === $menu->nama_menu ? 'selected' : '' }}>
                            {{ $menu->nama_menu }}
                        </option>
                    @endforeach
                </select>

                <label for="promo">Promo</label>
                <select name="promo" id="promo" required>
                    @foreach ($promoOptions as $promo)
                        <option value="{{ $promo }}" {{ old('promo', $input['promo'] ?? '') === $promo ? 'selected' : '' }}>
                            {{ $promo }}
                        </option>
                    @endforeach
                </select>

                <label for="hari">Hari</label>
                <select name="hari" id="hari" required>
                    @foreach ($hariOptions as $hari)
                        <option value="{{ $hari }}" {{ old('hari', $input['hari'] ?? '') === $hari ? 'selected' : '' }}>
                            {{ $hari }}
                        </option>
                    @endforeach
                </select>

                <label for="bulan">Bulan (1-12)</label>
                <input type="number" name="bulan" id="bulan" min="1" max="12" value="{{ old('bulan', $input['bulan'] ?? '') }}" required>

                <button type="submit" class="btn">Prediksi</button>
            </form>

            @if (isset($hasil))
                <div class="result-box {{ $hasil === 'Laris' ? 'result-laris' : 'result-kurang' }}">
                    <div class="label">Hasil Prediksi untuk "{{ $input['menu'] }}"</div>
                    <div class="value">{{ $hasil }}</div>
                </div>
            @endif
        </div>
    </div>
</body>
</html>