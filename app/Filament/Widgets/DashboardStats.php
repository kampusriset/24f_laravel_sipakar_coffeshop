<?php

namespace App\Filament\Widgets;

use App\Models\Pesanan;
use App\Models\DetailPesanan;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\DB;

class DashboardStats extends BaseWidget
{
    protected static ?int $sort = 1;

    // Auto-refresh setiap 15 detik
    protected ?string $pollingInterval = '15s';

    protected function getStats(): array
    {
        $today = today();

        // Pesanan hari ini (semua status kecuali dibatalkan)
        $menunggu = Pesanan::whereDate('created_at', $today)
            ->where('status', 'menunggu')
            ->count();

        $diproses = Pesanan::whereDate('created_at', $today)
            ->where('status', 'diproses')
            ->count();

        // Pendapatan hari ini (hanya yang sudah selesai)
        $pendapatan = Pesanan::whereDate('created_at', $today)
            ->where('status', 'selesai')
            ->sum('total_akhir');

        // Total transaksi hari ini (semua yang bukan dibatalkan)
        $totalTransaksi = Pesanan::whereDate('created_at', $today)
            ->whereIn('status', ['menunggu', 'diproses', 'selesai'])
            ->count();

        // Best seller hari ini
        $bestSeller = DB::table('detail_pesanans')
            ->join('pesanans', 'detail_pesanans.pesanan_id', '=', 'pesanans.id')
            ->whereDate('pesanans.created_at', $today)
            ->whereIn('pesanans.status', ['diproses', 'selesai', 'menunggu'])
            ->select('detail_pesanans.nama_menu', DB::raw('SUM(detail_pesanans.qty) as total_terjual'))
            ->groupBy('detail_pesanans.nama_menu')
            ->orderByDesc('total_terjual')
            ->first();

        $bestSellerLabel = $bestSeller
            ? "{$bestSeller->nama_menu} ({$bestSeller->total_terjual}x)"
            : 'Belum ada data';

        return [
            Stat::make('⏳ Menunggu Konfirmasi', $menunggu)
                ->description('Pesanan perlu diproses hari ini')
                ->descriptionIcon('heroicon-m-clock')
                ->color($menunggu > 0 ? 'warning' : 'gray'),

            Stat::make('🔄 Sedang Diproses', $diproses)
                ->description('Pesanan sedang dibuat')
                ->descriptionIcon('heroicon-m-arrow-path')
                ->color($diproses > 0 ? 'info' : 'gray'),

            Stat::make('📦 Total Transaksi Hari Ini', $totalTransaksi)
                ->description('Semua pesanan masuk hari ini')
                ->descriptionIcon('heroicon-m-shopping-bag')
                ->color('primary'),

            Stat::make('💰 Pendapatan Hari Ini', 'Rp ' . number_format($pendapatan, 0, ',', '.'))
                ->description('Dari pesanan yang sudah selesai')
                ->descriptionIcon('heroicon-m-banknotes')
                ->color('success'),

            Stat::make('🏆 Best Seller Hari Ini', $bestSellerLabel)
                ->description('Berdasarkan jumlah terjual hari ini')
                ->descriptionIcon('heroicon-m-star')
                ->color('warning'),
        ];
    }
}
