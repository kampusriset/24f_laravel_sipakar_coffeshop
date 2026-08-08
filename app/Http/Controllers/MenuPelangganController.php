<?php

namespace App\Http\Controllers;

use App\Models\KategoriMenu;
use App\Models\Menu;
use Illuminate\Support\Facades\DB;

class MenuPelangganController extends Controller
{
    public function index()
    {
        // Eager load menus beserta relasi bahans untuk mencegah N+1 Query ke Supabase
        $kategoris = KategoriMenu::with('menus.bahans')->get();

        // ── Best Seller Hari Ini ────────────────────────────────────────────
        $bestSellerHariIni = DB::table('detail_pesanans')
            ->join('pesanans', 'detail_pesanans.pesanan_id', '=', 'pesanans.id')
            ->whereDate('pesanans.created_at', today())
            ->whereIn('pesanans.status', ['selesai', 'diproses', 'menunggu'])
            ->select('detail_pesanans.nama_menu', DB::raw('SUM(detail_pesanans.qty) as total_terjual'))
            ->groupBy('detail_pesanans.nama_menu')
            ->orderByDesc('total_terjual')
            ->first();

        // Cari data menu lengkap (gambar, harga, id) berdasarkan nama
        $bestSellerMenu = null;
        if ($bestSellerHariIni) {
            $bestSellerMenu = Menu::with(['kategori', 'bahans'])
                ->where('nama_menu', $bestSellerHariIni->nama_menu)
                ->first();
            if ($bestSellerMenu) {
                $bestSellerMenu->total_terjual = $bestSellerHariIni->total_terjual;
            }
        }

        // Fallback: jika belum ada transaksi hari ini, tampilkan menu pertama
        if (!$bestSellerMenu) {
            $bestSellerMenu = Menu::with(['kategori', 'bahans'])->first();
            if ($bestSellerMenu) {
                $bestSellerMenu->total_terjual = 0;
            }
        }

        return view('coffeeshop', compact('kategoris', 'bestSellerMenu'));
    }
}