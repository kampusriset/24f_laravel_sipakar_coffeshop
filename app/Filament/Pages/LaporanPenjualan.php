<?php

namespace App\Filament\Pages;

use App\Models\Pesanan;
use Filament\Pages\Page;
use Livewire\Attributes\Url;

class LaporanPenjualan extends Page
{
    protected static \BackedEnum|string|null $navigationIcon = 'heroicon-o-document-chart-bar';
    protected static ?string $navigationLabel = 'Laporan Penjualan';
    protected static ?string $title           = 'Laporan Penjualan';
    protected static string|\UnitEnum|null $navigationGroup = 'Analitik & AI';
    protected static ?int $navigationSort     = 2;

    protected string $view = 'filament.pages.laporan-penjualan';

    /** Hanya Admin yang bisa mengakses laporan. */
    public static function canAccess(): bool
    {
        return auth()->check() && auth()->user()->isAdmin();
    }

    #[Url]
    public string $dari   = '';

    #[Url]
    public string $sampai = '';

    public function mount(): void
    {
        $this->dari   = now()->startOfMonth()->toDateString();
        $this->sampai = now()->toDateString();
    }

    /** Daftar pesanan sesuai filter tanggal. */
    public function getPesanansProperty()
    {
        return Pesanan::with('details')
            ->whereDate('created_at', '>=', $this->dari)
            ->whereDate('created_at', '<=', $this->sampai)
            ->where('status', '!=', 'dibatalkan')
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public function getTotalPendapatanProperty(): int
    {
        return (int) $this->pesanans->sum('total_akhir');
    }

    public function getTotalTransaksiProperty(): int
    {
        return $this->pesanans->count();
    }

    public function getRataRataProperty(): float
    {
        return $this->totalTransaksi > 0
            ? $this->totalPendapatan / $this->totalTransaksi
            : 0;
    }

    /** Top 5 menu terlaris berdasarkan qty terjual. */
    public function getTopMenusProperty(): array
    {
        $counts = [];
        foreach ($this->pesanans as $pesanan) {
            foreach ($pesanan->details as $detail) {
                $counts[$detail->nama_menu] = ($counts[$detail->nama_menu] ?? 0) + $detail->qty;
            }
        }
        arsort($counts);
        return array_slice($counts, 0, 5, true);
    }

    /** Pendapatan per hari untuk chart mini. */
    public function getPendapatanHarianProperty(): array
    {
        return Pesanan::selectRaw("DATE(created_at) as tanggal, SUM(total_akhir) as total")
            ->whereDate('created_at', '>=', $this->dari)
            ->whereDate('created_at', '<=', $this->sampai)
            ->where('status', '!=', 'dibatalkan')
            ->groupByRaw("DATE(created_at)")
            ->orderBy('tanggal')
            ->pluck('total', 'tanggal')
            ->toArray();
    }

    public function getExportCsvUrlProperty(): string
    {
        return route('laporan.csv', ['dari' => $this->dari, 'sampai' => $this->sampai]);
    }

    public function getExportPdfUrlProperty(): string
    {
        return route('laporan.pdf', ['dari' => $this->dari, 'sampai' => $this->sampai]);
    }
}
