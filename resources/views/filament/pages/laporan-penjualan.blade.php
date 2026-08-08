<x-filament-panels::page>

<style>
/* ── Custom Styling (Matching Filament Pesanan Masuk Theme) ────────────────── */
.lap-wrap { display: flex; flex-direction: column; gap: 1.25rem; }

/* Card & Section Container (Warna Zinc 900 netral persis Pesanan Masuk) */
.lap-card, .lap-stat {
    background: #ffffff;
    border-radius: 0.75rem;
    border: 1px solid rgba(0, 0, 0, 0.08);
    box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.05);
    padding: 1.25rem;
}
.dark .lap-card, .dark .lap-stat {
    background: #18181b; /* Neutral Charcoal Zinc-900 (bukan Navy Blue) */
    border: 1px solid rgba(255, 255, 255, 0.08);
    box-shadow: none;
}

.lap-filter-row { display: flex; flex-wrap: wrap; gap: 1rem; align-items: flex-end; }
.lap-filter-group { display: flex; flex-direction: column; gap: 0.375rem; flex: 1; min-width: 150px; }
.lap-label { font-size: 0.75rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.05em; color: #6b7280; }
.dark .lap-label { color: #a1a1aa; }

.lap-input {
    border: 1px solid #d1d5db;
    border-radius: 0.5rem;
    padding: 0.5rem 0.75rem;
    font-size: 0.875rem;
    background: #ffffff;
    color: #111827;
    outline: none;
    width: 100%;
    transition: border-color 0.2s, box-shadow 0.2s;
}
.dark .lap-input {
    background: #27272a;
    border-color: #3f3f46;
    color: #f4f4f5;
}
.lap-input:focus { border-color: #f59e0b; box-shadow: 0 0 0 3px rgba(245, 158, 11, 0.15); }

.lap-btn-row { display: flex; gap: 0.5rem; flex-shrink: 0; }
.lap-btn {
    display: inline-flex;
    align-items: center;
    gap: 0.4rem;
    padding: 0.5rem 1rem;
    border-radius: 0.5rem;
    font-size: 0.8125rem;
    font-weight: 600;
    text-decoration: none;
    border: 1px solid transparent;
    cursor: pointer;
    white-space: nowrap;
    transition: all 0.15s ease-in-out;
}
.lap-btn-amber {
    background: #f59e0b;
    color: #ffffff;
}
.lap-btn-amber:hover { background: #d97706; }
.lap-btn-outline {
    background: transparent;
    border-color: #d1d5db;
    color: #374151;
}
.dark .lap-btn-outline { border-color: #3f3f46; color: #e5e7eb; }
.lap-btn-outline:hover { background: rgba(255, 255, 255, 0.05); }

/* Stat Cards */
.lap-stats { display: grid; grid-template-columns: repeat(3, 1fr); gap: 1rem; }
@media (max-width: 640px) { .lap-stats { grid-template-columns: 1fr; } }

.lap-stat {
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}

.lap-stat-header { display: flex; align-items: center; justify-content: space-between; margin-bottom: 0.75rem; }
.lap-stat-lbl { font-size: 0.75rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.05em; color: #6b7280; }
.dark .lap-stat-lbl { color: #a1a1aa; }
.lap-stat-icon {
    width: 2.25rem;
    height: 2.25rem;
    border-radius: 0.5rem;
    display: flex;
    align-items: center;
    justify-content: center;
    background: rgba(245, 158, 11, 0.1);
    color: #d97706;
}
.dark .lap-stat-icon { color: #f59e0b; }

.lap-stat-val { font-size: 1.625rem; font-weight: 800; color: #111827; line-height: 1.2; }
.dark .lap-stat-val { color: #f4f4f5; }
.lap-stat-val.accent { color: #d97706; }
.dark .lap-stat-val.accent { color: #f59e0b; }
.lap-stat-sub { font-size: 0.75rem; color: #9ca3af; margin-top: 0.25rem; }

/* Grid 2 Column */
.lap-grid-2 { display: grid; grid-template-columns: 2fr 3fr; gap: 1rem; }
@media (max-width: 900px) { .lap-grid-2 { grid-template-columns: 1fr; } }

.lap-section-title {
    font-size: 0.875rem;
    font-weight: 700;
    color: #111827;
    margin-bottom: 1rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}
.dark .lap-section-title { color: #f4f4f5; }

/* Top Menu Bars */
.lap-bar-row { margin-bottom: 0.875rem; }
.lap-bar-row:last-child { margin-bottom: 0; }
.lap-bar-label { display: flex; justify-content: space-between; font-size: 0.8125rem; margin-bottom: 0.35rem; }
.lap-bar-name { font-weight: 500; color: #374151; max-width: 75%; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; }
.dark .lap-bar-name { color: #d4d4d8; }
.lap-bar-qty { font-weight: 700; color: #111827; }
.dark .lap-bar-qty { color: #f4f4f5; }
.lap-bar-track { height: 0.5rem; background: rgba(156, 163, 175, 0.15); border-radius: 9999px; overflow: hidden; }
.dark .lap-bar-track { background: #27272a; }
.lap-bar-fill { height: 100%; background: #f59e0b; border-radius: 9999px; transition: width 0.4s ease-in-out; }

/* Chart Harian */
.lap-chart-area { display: flex; align-items: flex-end; gap: 0.35rem; height: 120px; width: 100%; padding-top: 1rem; }
.lap-chart-col { flex: 1; display: flex; flex-direction: column; align-items: center; justify-content: flex-end; gap: 0.25rem; height: 100%; position: relative; }
.lap-chart-bar {
    width: 100%;
    background: rgba(245, 158, 11, 0.75);
    border-radius: 0.25rem 0.25rem 0 0;
    min-height: 4px;
    transition: background 0.15s ease-in-out, height 0.3s ease-in-out;
}
.lap-chart-col:hover .lap-chart-bar { background: #d97706; }
.lap-chart-lbl { font-size: 0.65rem; color: #9ca3af; white-space: nowrap; transform: rotate(-35deg); transform-origin: top left; margin-top: 0.25rem; }
.lap-chart-meta { display: flex; justify-content: space-between; font-size: 0.75rem; color: #9ca3af; margin-top: 1rem; border-top: 1px solid rgba(156, 163, 175, 0.15); padding-top: 0.5rem; }
.dark .lap-chart-meta { border-top-color: #27272a; }

/* Table Styling */
.lap-tbl-header { padding: 1rem 1.25rem; border-bottom: 1px solid rgba(156, 163, 175, 0.15); }
.dark .lap-tbl-header { border-bottom-color: #27272a; }
.lap-tbl-title { font-size: 0.875rem; font-weight: 700; color: #111827; }
.dark .lap-tbl-title { color: #f4f4f5; }
.lap-tbl-count { font-size: 0.75rem; color: #9ca3af; font-weight: 400; margin-left: 0.35rem; }
.lap-tbl { width: 100%; border-collapse: collapse; font-size: 0.8125rem; }
.lap-tbl thead th {
    background: rgba(156, 163, 175, 0.05);
    padding: 0.75rem 1rem;
    text-align: left;
    font-size: 0.6875rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.05em;
    color: #6b7280;
    border-bottom: 1px solid rgba(156, 163, 175, 0.15);
}
.dark .lap-tbl thead th { background: #27272a; color: #a1a1aa; border-bottom-color: #3f3f46; }
.lap-tbl thead th.r { text-align: right; }
.lap-tbl thead th.c { text-align: center; }
.lap-tbl tbody tr { border-bottom: 1px solid rgba(156, 163, 175, 0.1); transition: background 0.15s; }
.dark .lap-tbl tbody tr { border-bottom-color: #27272a; }
.lap-tbl tbody tr:hover { background: rgba(245, 158, 11, 0.04); }
.dark .lap-tbl tbody tr:hover { background: rgba(255, 255, 255, 0.03); }
.lap-tbl td { padding: 0.75rem 1rem; vertical-align: top; color: #374151; }
.dark .lap-tbl td { color: #d4d4d8; }
.lap-tbl td.r { text-align: right; }
.lap-tbl td.c { text-align: center; }

.lap-kode {
    font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, monospace;
    font-size: 0.75rem;
    background: rgba(156, 163, 175, 0.1);
    color: #4b5563;
    padding: 0.15rem 0.4rem;
    border-radius: 0.25rem;
    display: inline-block;
}
.dark .lap-kode { background: #27272a; color: #a1a1aa; }
.lap-item-sub { font-size: 0.75rem; color: #9ca3af; margin-top: 0.15rem; }

.lap-tbl-foot { background: rgba(245, 158, 11, 0.08); border-top: 2px solid #f59e0b; }
.dark .lap-tbl-foot { background: rgba(245, 158, 11, 0.12); border-top-color: #d97706; }
.lap-tbl-foot td { padding: 0.75rem 1rem; font-weight: 700; font-size: 0.875rem; color: #b45309; }
.dark .lap-tbl-foot td { color: #f59e0b; }
.lap-tbl-foot td.r { text-align: right; }

/* Status Badges */
.badge { display: inline-flex; align-items: center; padding: 0.15rem 0.5rem; border-radius: 9999px; font-size: 0.6875rem; font-weight: 600; letter-spacing: 0.02em; }
.badge-selesai { background: rgba(16, 185, 129, 0.12); color: #059669; border: 1px solid rgba(16, 185, 129, 0.3); }
.badge-diproses { background: rgba(59, 130, 246, 0.12); color: #2563eb; border: 1px solid rgba(59, 130, 246, 0.3); }
.badge-menunggu { background: rgba(245, 158, 11, 0.12); color: #d97706; border: 1px solid rgba(245, 158, 11, 0.3); }
.badge-default { background: rgba(156, 163, 175, 0.12); color: #6b7280; border: 1px solid rgba(156, 163, 175, 0.3); }

/* Empty State */
.lap-empty { display: flex; flex-direction: column; align-items: center; justify-content: center; padding: 2.5rem; color: #9ca3af; text-align: center; }
.lap-empty p { font-size: 0.8125rem; margin-top: 0.5rem; }
</style>

<div class="lap-wrap">

    {{-- ── Filter & Action Bar ───────────────────────────────────────── --}}
    <div class="lap-card">
        <div class="lap-filter-row">
            <div class="lap-filter-group">
                <label class="lap-label">Dari Tanggal</label>
                <input type="date" wire:model.live="dari" value="{{ $this->dari }}" class="lap-input">
            </div>
            <div class="lap-filter-group">
                <label class="lap-label">Sampai Tanggal</label>
                <input type="date" wire:model.live="sampai" value="{{ $this->sampai }}" class="lap-input">
            </div>
            <div class="lap-btn-row">
                <a href="{{ $this->exportCsvUrl }}" target="_blank" class="lap-btn lap-btn-outline">
                    <x-heroicon-o-document-arrow-down style="width:1rem; height:1rem;" />
                    Export Excel
                </a>
                <a href="{{ $this->exportPdfUrl }}" target="_blank" class="lap-btn lap-btn-amber">
                    <x-heroicon-o-printer style="width:1rem; height:1rem;" />
                    Cetak / PDF
                </a>
            </div>
        </div>
    </div>

    {{-- ── Ringkasan Statistik ───────────────────────────────────────── --}}
    <div class="lap-stats">

        <div class="lap-stat">
            <div class="lap-stat-header">
                <span class="lap-stat-lbl">Total Transaksi</span>
                <div class="lap-stat-icon">
                    <x-heroicon-o-shopping-bag style="width:1.1rem; height:1.1rem;" />
                </div>
            </div>
            <div class="lap-stat-val">{{ $this->totalTransaksi }}</div>
            <div class="lap-stat-sub">Pesanan berhasil selesai</div>
        </div>

        <div class="lap-stat">
            <div class="lap-stat-header">
                <span class="lap-stat-lbl">Rata-Rata / Transaksi</span>
                <div class="lap-stat-icon">
                    <x-heroicon-o-calculator style="width:1.1rem; height:1.1rem;" />
                </div>
            </div>
            <div class="lap-stat-val">Rp {{ number_format($this->rataRata, 0, ',', '.') }}</div>
            <div class="lap-stat-sub">Nilai transaksi rata-rata</div>
        </div>

        <div class="lap-stat">
            <div class="lap-stat-header">
                <span class="lap-stat-lbl">Total Pendapatan</span>
                <div class="lap-stat-icon">
                    <x-heroicon-o-banknotes style="width:1.1rem; height:1.1rem;" />
                </div>
            </div>
            <div class="lap-stat-val accent">Rp {{ number_format($this->totalPendapatan, 0, ',', '.') }}</div>
            <div class="lap-stat-sub">Bersih setelah PPN &amp; diskon</div>
        </div>

    </div>

    {{-- ── Grid 2 Kolom: Top Menu & Trend Harian ────────────────────── --}}
    <div class="lap-grid-2">

        {{-- Top 5 Menu Terlaris --}}
        <div class="lap-card">
            <div class="lap-section-title">
                <x-heroicon-o-fire style="width:1.1rem; height:1.1rem; color:#f59e0b;" />
                Top 5 Menu Terlaris
            </div>
            @if(count($this->topMenus) > 0)
                @php $max = max(array_values($this->topMenus)); @endphp
                @foreach($this->topMenus as $nama => $qty)
                <div class="lap-bar-row">
                    <div class="lap-bar-label">
                        <span class="lap-bar-name">{{ $nama }}</span>
                        <span class="lap-bar-qty">{{ $qty }}×</span>
                    </div>
                    <div class="lap-bar-track">
                        <div class="lap-bar-fill" style="width:{{ $max > 0 ? round(($qty/$max)*100) : 0 }}%"></div>
                    </div>
                </div>
                @endforeach
            @else
                <div class="lap-empty">
                    <x-heroicon-o-chart-bar style="width:2rem; height:2rem; color:#9ca3af;" />
                    <p>Belum ada data transaksi</p>
                </div>
            @endif
        </div>

        {{-- Chart Pendapatan Harian --}}
        <div class="lap-card">
            <div class="lap-section-title">
                <x-heroicon-o-chart-bar-square style="width:1.1rem; height:1.1rem; color:#f59e0b;" />
                Tren Pendapatan Harian
            </div>
            @php
                $harian = $this->pendapatanHarian;
                $maxVal = count($harian) > 0 ? max(array_values($harian)) : 1;
            @endphp
            @if(count($harian) > 0)
                <div class="lap-chart-area">
                    @foreach($harian as $tgl => $total)
                    @php $pct = $maxVal > 0 ? round(($total/$maxVal)*100) : 0; @endphp
                    <div class="lap-chart-col" title="{{ $tgl }}: Rp {{ number_format($total,0,',','.') }}">
                        <div class="lap-chart-bar" style="height:{{ $pct }}%"></div>
                        <span class="lap-chart-lbl">{{ \Carbon\Carbon::parse($tgl)->format('d/m') }}</span>
                    </div>
                    @endforeach
                </div>
                <div class="lap-chart-meta">
                    <span>Rp 0</span>
                    <span>Maks: Rp {{ number_format($maxVal,0,',','.') }}</span>
                </div>
            @else
                <div class="lap-empty">
                    <x-heroicon-o-arrow-trending-up style="width:2rem; height:2rem; color:#9ca3af;" />
                    <p>Tidak ada data pada periode ini</p>
                </div>
            @endif
        </div>

    </div>

    {{-- ── Tabel Detail Transaksi ──────────────────────────────────────── --}}
    <div class="lap-card" style="padding:0; overflow:hidden;">
        <div class="lap-tbl-header">
            <span class="lap-tbl-title">Detail Transaksi</span>
            <span class="lap-tbl-count">({{ $this->totalTransaksi }} pesanan)</span>
        </div>
        <div style="overflow-x:auto;">
            <table class="lap-tbl">
                <thead>
                    <tr>
                        <th>Kode Pesanan</th>
                        <th>Pelanggan</th>
                        <th>Item</th>
                        <th>Waktu</th>
                        <th class="r">Total</th>
                        <th class="c">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($this->pesanans as $pesanan)
                    <tr>
                        <td><span class="lap-kode">{{ $pesanan->kode_pesanan }}</span></td>
                        <td>
                            <strong style="display:block">{{ $pesanan->nama_pelanggan }}</strong>
                            <span class="lap-item-sub">{{ $pesanan->nomor_meja ? 'Meja '.$pesanan->nomor_meja : 'Takeaway' }}</span>
                        </td>
                        <td style="max-width:240px">
                            <span class="lap-item-sub" style="font-size:0.75rem; color:#9ca3af;">
                                {{ $pesanan->details->map(fn($d) => $d->nama_menu.' ×'.$d->qty)->join(', ') }}
                            </span>
                        </td>
                        <td>
                            <span style="display:block; font-size:0.75rem;">{{ $pesanan->created_at->format('d/m/Y') }}</span>
                            <span class="lap-item-sub">{{ $pesanan->created_at->format('H:i') }}</span>
                        </td>
                        <td class="r" style="font-weight:700; white-space:nowrap;">
                            Rp {{ number_format($pesanan->total_akhir, 0, ',', '.') }}
                        </td>
                        <td class="c">
                            @php
                                $bc = match($pesanan->status){
                                    'selesai'  =>'badge-selesai',
                                    'diproses' =>'badge-diproses',
                                    'menunggu' =>'badge-menunggu',
                                    default    =>'badge-default'
                                };
                            @endphp
                            <span class="badge {{ $bc }}">{{ ucfirst($pesanan->status) }}</span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6">
                            <div class="lap-empty">
                                <x-heroicon-o-inbox style="width:2rem; height:2rem; color:#9ca3af;" />
                                <p>Tidak ada transaksi pada periode yang dipilih.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
                @if($this->pesanans->isNotEmpty())
                <tfoot class="lap-tbl-foot">
                    <tr>
                        <td colspan="4">TOTAL ({{ $this->totalTransaksi }} transaksi)</td>
                        <td class="r">Rp {{ number_format($this->totalPendapatan, 0, ',', '.') }}</td>
                        <td></td>
                    </tr>
                </tfoot>
                @endif
            </table>
        </div>
    </div>

</div>
</x-filament-panels::page>
