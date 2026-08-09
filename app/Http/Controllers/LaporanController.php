<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class LaporanController extends Controller
{
    /**
     * Export laporan penjualan dalam format CSV (dapat dibuka di Excel).
     */
    public function exportCsv(Request $request): Response
    {
        $tanggalMulai = $request->query('dari', now()->startOfMonth()->toDateString());
        $tanggalAkhir = $request->query('sampai', now()->toDateString());

        $pesanans = Pesanan::with('details')
            ->whereDate('created_at', '>=', $tanggalMulai)
            ->whereDate('created_at', '<=', $tanggalAkhir)
            ->where('status', '!=', 'dibatalkan')
            ->orderBy('created_at', 'asc')
            ->get();

        $namaFile = 'laporan-penjualan-' . $tanggalMulai . '-sd-' . $tanggalAkhir . '.csv';
        $bom = "\xEF\xBB\xBF"; // BOM UTF-8 agar terbaca benar di Excel Windows

        $output  = $bom;
        $output .= "LAPORAN PENJUALAN - AURA COFFEE\r\n";
        $output .= "Periode: " . \Carbon\Carbon::parse($tanggalMulai)->isoFormat('D MMMM Y')
            . " s.d. " . \Carbon\Carbon::parse($tanggalAkhir)->isoFormat('D MMMM Y') . "\r\n";
        $output .= "Digenerate: " . now()->format('d/m/Y H:i') . "\r\n";
        $output .= "\r\n";

        $output .= implode(',', ['"No"', '"Kode Pesanan"', '"Tanggal"', '"Pelanggan"', '"Meja"', '"Item Dipesan"', '"Promo"', '"Subtotal (Rp)"', '"PPN (Rp)"', '"Diskon (Rp)"', '"Total (Rp)"', '"Status"']) . "\r\n";

        $totalPendapatan = 0;
        $no = 1;

        foreach ($pesanans as $pesanan) {
            $namaItem = $pesanan->details->map(fn ($d) => $d->nama_menu . ' x' . $d->qty)->join('; ');
            $isPromo = $pesanan->details->contains('is_promo', true) ? 'Ya' : 'Tidak';
            $output .= implode(',', [
                $no++,
                '"' . $pesanan->kode_pesanan . '"',
                '"' . $pesanan->created_at->format('d/m/Y H:i') . '"',
                '"' . $pesanan->nama_pelanggan . '"',
                '"' . ($pesanan->nomor_meja ?? 'Takeaway') . '"',
                '"' . $namaItem . '"',
                '"' . $isPromo . '"',
                $pesanan->subtotal,
                $pesanan->ppn,
                $pesanan->diskon,
                $pesanan->total_akhir,
                '"' . ucfirst($pesanan->status) . '"',
            ]) . "\r\n";
            $totalPendapatan += $pesanan->total_akhir;
        }

        $output .= "\r\n";
        $output .= '"","","","","","TOTAL PENDAPATAN","","","","","' . $totalPendapatan . '","' . count($pesanans) . ' Transaksi"' . "\r\n";

        return response($output, 200, [
            'Content-Type'        => 'text/csv; charset=UTF-8',
            'Content-Disposition' => 'attachment; filename="' . $namaFile . '"',
        ]);
    }

    /**
     * Tampilkan laporan penjualan dalam format HTML siap cetak / save PDF via browser.
     */
    public function exportPdf(Request $request)
    {
        $tanggalMulai = $request->query('dari', now()->startOfMonth()->toDateString());
        $tanggalAkhir = $request->query('sampai', now()->toDateString());

        $pesanans = Pesanan::with('details')
            ->whereDate('created_at', '>=', $tanggalMulai)
            ->whereDate('created_at', '<=', $tanggalAkhir)
            ->where('status', '!=', 'dibatalkan')
            ->orderBy('created_at', 'asc')
            ->get();

        $totalPendapatan = $pesanans->sum('total_akhir');
        $totalTransaksi  = $pesanans->count();
        $rataRata        = $totalTransaksi > 0 ? $totalPendapatan / $totalTransaksi : 0;

        return view('laporan.pdf', compact(
            'pesanans', 'tanggalMulai', 'tanggalAkhir',
            'totalPendapatan', 'totalTransaksi', 'rataRata'
        ));
    }
}
