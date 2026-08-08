<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Penjualan — Aura Coffee</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', Arial, sans-serif; font-size: 12px; color: #1c1917; background: #fff; padding: 32px; }

        .header { display: flex; justify-content: space-between; align-items: flex-start; padding-bottom: 18px; border-bottom: 2px solid #d97706; margin-bottom: 22px; }
        .brand-name { font-size: 20px; font-weight: 800; color: #1c1917; }
        .brand-sub  { font-size: 11px; color: #78716c; margin-top: 2px; }
        .doc-info   { text-align: right; }
        .doc-title  { font-size: 14px; font-weight: 700; color: #d97706; }
        .doc-meta   { font-size: 11px; color: #78716c; margin-top: 3px; }

        .summary { display: grid; grid-template-columns: repeat(3,1fr); gap: 12px; margin-bottom: 22px; }
        .card { background: #fafaf9; border: 1px solid #e7e5e4; border-radius: 8px; padding: 12px 14px; }
        .card.accent { background: #fffbeb; border-color: #fde68a; }
        .card-label { font-size: 9px; font-weight: 700; text-transform: uppercase; letter-spacing: .6px; color: #78716c; }
        .card.accent .card-label { color: #b45309; }
        .card-value { font-size: 17px; font-weight: 800; color: #1c1917; margin-top: 4px; }
        .card.accent .card-value { color: #d97706; }

        table { width: 100%; border-collapse: collapse; font-size: 11px; }
        thead th { background: #1c1917; color: #fff; padding: 9px 10px; text-align: left; font-size: 9px; text-transform: uppercase; letter-spacing: .5px; }
        thead th.right { text-align: right; }
        tbody tr:nth-child(even) { background: #fafaf9; }
        tbody td { padding: 8px 10px; border-bottom: 1px solid #e7e5e4; vertical-align: top; }
        tbody td.right { text-align: right; }
        .kode { font-family: monospace; font-size: 10px; color: #78716c; }
        .item-sub { font-size: 9.5px; color: #a8a29e; margin-top: 1px; }
        .badge { display: inline-block; padding: 1.5px 6px; border-radius: 9px; font-size: 9px; font-weight: 700; }
        .badge-selesai  { background: #d1fae5; color: #065f46; }
        .badge-diproses { background: #dbeafe; color: #1e40af; }
        .badge-menunggu { background: #fef9c3; color: #854d0e; }

        tfoot td { background: #fffbeb; font-weight: 700; border-top: 2px solid #f59e0b; font-size: 12px; padding: 9px 10px; color: #b45309; }
        tfoot td.right { text-align: right; }

        .footer { margin-top: 28px; padding-top: 14px; border-top: 1px solid #e7e5e4; display: flex; justify-content: space-between; font-size: 9.5px; color: #a8a29e; }

        .print-bar { position: fixed; top: 16px; right: 16px; display: flex; gap: 8px; z-index: 100; }
        .btn { padding: 9px 18px; border-radius: 7px; font-size: 13px; font-weight: 600; cursor: pointer; border: none; text-decoration: none; display: inline-block; }
        .btn-print { background: #f59e0b; color: white; }
        .btn-print:hover { background: #d97706; }
        .btn-back  { background: #e7e5e4; color: #1c1917; }

        @media print {
            .print-bar { display: none !important; }
            body { padding: 18px; }
            @page { margin: 1cm; size: A4 landscape; }
        }
    </style>
</head>
<body>

<div class="print-bar">
    <a href="javascript:history.back()" class="btn btn-back">← Kembali</a>
    <button onclick="window.print()" class="btn btn-print">🖨️ Cetak / Save PDF</button>
</div>

<div class="header">
    <div>
        <div class="brand-name">☕ Aura Coffee</div>
        <div class="brand-sub">Premium Coffeehouse</div>
    </div>
    <div class="doc-info">
        <div class="doc-title">LAPORAN PENJUALAN</div>
        <div class="doc-meta">Periode: {{ \Carbon\Carbon::parse($tanggalMulai)->isoFormat('D MMMM Y') }} s.d. {{ \Carbon\Carbon::parse($tanggalAkhir)->isoFormat('D MMMM Y') }}</div>
        <div class="doc-meta">Digenerate: {{ now()->isoFormat('D MMMM Y, HH:mm') }} WIB</div>
    </div>
</div>

<div class="summary">
    <div class="card">
        <div class="card-label">Total Transaksi</div>
        <div class="card-value">{{ $totalTransaksi }}</div>
    </div>
    <div class="card">
        <div class="card-label">Rata-rata / Transaksi</div>
        <div class="card-value">Rp {{ number_format($rataRata, 0, ',', '.') }}</div>
    </div>
    <div class="card accent">
        <div class="card-label">Total Pendapatan</div>
        <div class="card-value">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</div>
    </div>
</div>

<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Kode Pesanan</th>
            <th>Tanggal</th>
            <th>Pelanggan</th>
            <th>Meja</th>
            <th>Item Dipesan</th>
            <th class="right">Subtotal</th>
            <th class="right">PPN</th>
            <th class="right">Diskon</th>
            <th class="right">Total</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        @forelse($pesanans as $i => $pesanan)
        <tr>
            <td>{{ $i + 1 }}</td>
            <td><span class="kode">{{ $pesanan->kode_pesanan }}</span></td>
            <td>{{ $pesanan->created_at->format('d/m/Y') }}<br><span class="item-sub">{{ $pesanan->created_at->format('H:i') }}</span></td>
            <td>{{ $pesanan->nama_pelanggan }}</td>
            <td>{{ $pesanan->nomor_meja ?? '—' }}</td>
            <td>
                {{ $pesanan->details->map(fn($d) => $d->nama_menu . ' ×' . $d->qty)->join(', ') }}
            </td>
            <td class="right">Rp {{ number_format($pesanan->subtotal, 0, ',', '.') }}</td>
            <td class="right">Rp {{ number_format($pesanan->subtotal > 0 ? $pesanan->ppn : 0, 0, ',', '.') }}</td>
            <td class="right">{{ $pesanan->diskon > 0 ? '-Rp ' . number_format($pesanan->diskon, 0, ',', '.') : '—' }}</td>
            <td class="right"><strong>Rp {{ number_format($pesanan->total_akhir, 0, ',', '.') }}</strong></td>
            <td>
                <span class="badge badge-{{ $pesanan->status }}">{{ ucfirst($pesanan->status) }}</span>
            </td>
        </tr>
        @empty
        <tr><td colspan="11" style="text-align:center;padding:28px;color:#78716c;">Tidak ada transaksi pada periode ini.</td></tr>
        @endforelse
    </tbody>
    @if($pesanans->isNotEmpty())
    <tfoot>
        <tr>
            <td colspan="6"><strong>TOTAL ({{ $totalTransaksi }} Transaksi)</strong></td>
            <td class="right">Rp {{ number_format($pesanans->sum('subtotal'), 0, ',', '.') }}</td>
            <td class="right">Rp {{ number_format($pesanans->sum('ppn'), 0, ',', '.') }}</td>
            <td class="right">-Rp {{ number_format($pesanans->sum('diskon'), 0, ',', '.') }}</td>
            <td class="right"><strong>Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</strong></td>
            <td></td>
        </tr>
    </tfoot>
    @endif
</table>

<div class="footer">
    <div>Laporan dihasilkan secara otomatis oleh sistem Aura Coffee.</div>
    <div>Dokumen ini bersifat resmi.</div>
</div>

</body>
</html>
