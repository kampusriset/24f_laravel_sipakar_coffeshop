<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use App\Models\DetailPesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PesananController extends Controller
{
    /**
     * Simpan pesanan dari review-order ke database.
     * POST /pesanan/simpan
     */
    public function simpan(Request $request)
    {
        $request->validate([
            'nama_pelanggan' => 'required|string|max:100',
            'nomor_hp'       => 'nullable|string|max:20',
            'nomor_meja'     => 'nullable|integer|min:1',
            'cart'           => 'required|json',
            'metode_bayar'   => 'nullable|in:qris,cash',
        ]);

        $cart = json_decode($request->cart, true);

        if (empty($cart)) {
            return back()->withErrors(['cart' => 'Keranjang tidak boleh kosong.']);
        }

        // ── Pengecekan Ketersediaan Stok Bahan Baku ───────────────────────
        foreach ($cart as $item) {
            $menuName = $item['nama'] ?? '';
            $menuQty  = (int)($item['qty'] ?? 1);

            $menuObj = \App\Models\Menu::with('bahans')->where('nama_menu', $menuName)->first();
            if ($menuObj) {
                foreach ($menuObj->bahans as $bahan) {
                    $needed = ($bahan->pivot->jumlah_dibutuhkan ?? 1) * $menuQty;
                    if ($bahan->stok < $needed) {
                        return back()->withErrors([
                            'cart' => "Maaf, stok bahan baku '{$bahan->nama_bahan}' tidak mencukupi untuk memesan '{$menuName}'. (Sisa stok: {$bahan->stok} {$bahan->satuan})."
                        ]);
                    }
                }
            }
        }

        // Hitung total
        $subtotal = 0;
        foreach ($cart as $item) {
            $subtotal += (int)($item['finalPrice'] ?? 0) * (int)($item['qty'] ?? 1);
        }
        $ppn = (int)round($subtotal * 0.10);

        // Random diskon hanya untuk user yang sudah login
        $diskon       = 0;
        $persenDiskon = 0;
        if (auth()->check() && auth()->user()->isUser()) {
            if (rand(1, 10) <= 3) {
                $persenDiskon = collect([10, 15, 20])->random();
                $diskon       = (int)round($subtotal * $persenDiskon / 100);
            }
        }

        $totalAkhir = $subtotal + $ppn - $diskon;

        DB::transaction(function () use ($request, $cart, $subtotal, $ppn, $diskon, $totalAkhir, $persenDiskon, &$pesanan) {
            $pesanan = Pesanan::create([
                'kode_pesanan'  => Pesanan::generateKode(),
                'user_id'       => auth()->id(),
                'nama_pelanggan'=> $request->nama_pelanggan,
                'nomor_hp'      => $request->nomor_hp,
                'nomor_meja'    => $request->nomor_meja,
                'status'        => 'menunggu',
                'metode_bayar'  => $request->metode_bayar === 'cash' ? 'cash' : 'qris',
                'subtotal'      => $subtotal,
                'ppn'           => $ppn,
                'diskon'        => $diskon,
                'total_akhir'   => $totalAkhir,
                'persen_diskon' => $persenDiskon,
            ]);

            foreach ($cart as $item) {
                $menuName = $item['nama'] ?? '';
                $menuQty  = (int)($item['qty'] ?? 1);

                DetailPesanan::create([
                    'pesanan_id'   => $pesanan->id,
                    'nama_menu'    => $menuName,
                    'harga_satuan' => (int)($item['finalPrice'] ?? 0),
                    'qty'          => $menuQty,
                    'subtotal'     => (int)($item['finalPrice'] ?? 0) * $menuQty,
                    'suhu'         => $item['temp']   ?? null,
                    'sugar_level'  => $item['sugar']  ?? null,
                    'ukuran'       => $item['size']   ?? null,
                    'jenis_susu'   => $item['milk']   ?? null,
                    'topping'      => !empty($item['toppings']) ? implode(', ', $item['toppings']) : null,
                    'catatan'      => $item['notes']  ?? null,
                ]);

                // Kurangi stok bahan baku yang terikat dengan menu ini
                $menuObj = \App\Models\Menu::with('bahans')->where('nama_menu', $menuName)->first();
                if ($menuObj) {
                    foreach ($menuObj->bahans as $bahan) {
                        $needed = ($bahan->pivot->jumlah_dibutuhkan ?? 1) * $menuQty;
                        $bahan->decrement('stok', $needed);
                    }
                }
            }
        });

        // Redirect berdasarkan metode bayar:
        // cash → halaman konfirmasi pesanan diterima (tanpa perlu scan QR)
        // qris → halaman QRIS pembayaran
        if ($request->metode_bayar === 'cash') {
            return redirect()->route('pesanan.qris', ['kode' => $pesanan->kode_pesanan])
                ->with('metode', 'cash');
        }

        return redirect()->route('pesanan.qris', ['kode' => $pesanan->kode_pesanan]);
    }

    /**
     * Halaman QRIS / konfirmasi pembayaran.
     * GET /pesanan/{kode}/bayar
     */
    public function qris(string $kode)
    {
        $pesanan = Pesanan::with('details')
            ->where('kode_pesanan', $kode)
            ->firstOrFail();

        return view('pesanan.qris', compact('pesanan'));
    }

    /**
     * Update status pesanan (untuk kasir via Filament).
     * Endpoint ini tidak dipakai langsung dari view,
     * kasir update status lewat Filament Resource.
     */
    public function updateStatus(Request $request, Pesanan $pesanan)
    {
        $request->validate([
            'status' => 'required|in:menunggu,diproses,selesai,dibatalkan',
        ]);

        $pesanan->update(['status' => $request->status]);

        return back()->with('success', 'Status pesanan diperbarui.');
    }

    /**
     * Cek status pesanan saat ini (Polling AJAX).
     * GET /pesanan/{kode}/status
     */
    public function checkStatus(string $kode)
    {
        $pesanan = Pesanan::where('kode_pesanan', $kode)->first();

        if (!$pesanan) {
            return response()->json(['error' => 'Pesanan tidak ditemukan'], 404);
        }

        return response()->json([
            'status' => $pesanan->status,
            'status_label' => match($pesanan->status) {
                'menunggu'   => '⏳ Menunggu Pembayaran',
                'diproses'   => '🔄 Sedang Diproses/Dibuat',
                'selesai'    => '✅ Selesai (Silakan Ambil)',
                'dibatalkan' => '❌ Dibatalkan',
                default      => $pesanan->status,
            }
        ]);
    }

    /**
     * Simulasi Pembayaran QRIS Sukses.
     * POST /pesanan/{kode}/simulasi-bayar
     */
    public function simulasiBayar(string $kode)
    {
        $pesanan = Pesanan::where('kode_pesanan', $kode)->firstOrFail();

        if ($pesanan->status === 'menunggu') {
            $pesanan->update(['status' => 'diproses']);
            return response()->json(['success' => true, 'message' => 'Simulasi pembayaran sukses! Status diubah menjadi Diproses.']);
        }

        return response()->json(['success' => false, 'message' => 'Status pesanan sudah berubah.'], 400);
    }
}

