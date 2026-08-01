<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Rekomendasi Kopi - AI Coffee Shop</title>
    <style>
        body { font-family: system-ui, sans-serif; max-width: 480px; margin: 40px auto; padding: 0 16px; color: #2b1d12; }
        h1 { font-size: 1.4rem; }
        label { display: block; margin-top: 14px; font-weight: 600; }
        select { width: 100%; padding: 8px; margin-top: 4px; border: 1px solid #ccc; border-radius: 6px; }
        button { margin-top: 20px; padding: 10px 18px; background: #4b2e1e; color: #fff; border: none; border-radius: 6px; cursor: pointer; }
        button:hover { background: #6b4226; }
        .hasil { margin-top: 24px; padding: 16px; border-radius: 8px; }
        .hasil.sukses { background: #eee5d8; border: 1px solid #c9a876; }
        .hasil.gagal { background: #fbe4e4; border: 1px solid #e0a0a0; }
        .info-jam { margin-top: 16px; padding: 10px 12px; background: #f4f0e8; border-radius: 6px; font-size: 0.9rem; }
        .error { color: #b00020; font-size: 0.85rem; margin-top: 4px; }
    </style>
</head>
<body>
    <h1>☕ AI Rekomendasi Kopi</h1>
    <p>Masukkan kondisi saat ini untuk mendapatkan rekomendasi jenis kopi.</p>

    <form method="POST" action="{{ route('kopi.rekomendasi') }}">
        @csrf

        <label for="suhu_cuaca">Suhu Cuaca</label>
        <select name="suhu_cuaca" id="suhu_cuaca" required>
            <option value="">-- Pilih --</option>
            @foreach ($suhuOptions as $opt)
                <option value="{{ $opt->value }}" @selected(old('suhu_cuaca', $input['suhu_cuaca'] ?? null) === $opt->value)>
                    {{ $opt->value }}
                </option>
            @endforeach
        </select>
        @error('suhu_cuaca') <div class="error">{{ $message }}</div> @enderror

        <label for="kepadatan_pengunjung">Kepadatan Pengunjung</label>
        <select name="kepadatan_pengunjung" id="kepadatan_pengunjung" required>
            <option value="">-- Pilih --</option>
            @foreach ($kepadatanOptions as $opt)
                <option value="{{ $opt->value }}" @selected(old('kepadatan_pengunjung', $input['kepadatan_pengunjung'] ?? null) === $opt->value)>
                    {{ $opt->value }}
                </option>
            @endforeach
        </select>
        @error('kepadatan_pengunjung') <div class="error">{{ $message }}</div> @enderror

        <div class="info-jam">
            🕐 Waktu saat ini: <strong>{{ $jamSaatIni->value }}</strong> (pukul {{ now()->format('H:i') }})
        </div>

        <button type="submit">Dapatkan Rekomendasi</button>
    </form>

    @isset($hasil)
        <div class="hasil {{ $hasil ? 'sukses' : 'gagal' }}">
            @if ($hasil)
                <strong>Rekomendasi:</strong> {{ $hasil }}
            @else
                ⚠️ Maaf, sistem belum memiliki data yang cukup untuk kondisi ini.
            @endif
        </div>
    @endisset
</body>
</html>
