<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class StokPredictionController extends Controller
{
    /**
     * Tampilkan form prediksi stok.
     * Mengambil daftar menu dari database Laravel (bukan dari ml-api),
     * supaya nama menu selalu sinkron dengan data menu yang aktif.
     */
    public function index()
    {
        $menus = Menu::orderBy('nama_menu')->get();

        $hariOptions = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
        $promoOptions = ['Ya', 'Tidak'];

        return view('admin.stok-prediction.index', compact('menus', 'hariOptions', 'promoOptions'));
    }

    /**
     * Kirim data ke ml-api (FastAPI) dan tampilkan hasil prediksi.
     */
    public function predict(Request $request)
    {
        $validated = $request->validate([
            'menu'  => ['required', 'string'],
            'promo' => ['required', 'string', 'in:Ya,Tidak'],
            'hari'  => ['required', 'string'],
            'bulan' => ['required', 'integer', 'min:1', 'max:12'],
        ]);

        $baseUrl = config('services.ml_api.base_url');

        try {
            $response = Http::timeout(5)->post("{$baseUrl}/predict", [
                'menu'  => $validated['menu'],
                'promo' => $validated['promo'],
                'hari'  => $validated['hari'],
                'bulan' => $validated['bulan'],
            ]);
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            return back()
                ->withInput()
                ->withErrors(['prediksi' => 'Tidak bisa terhubung ke server ML. Pastikan ml-api sudah dijalankan (lihat start-dev.sh).']);
        }

        if ($response->status() === 400) {
            return back()
                ->withInput()
                ->withErrors(['prediksi' => "Menu \"{$validated['menu']}\" belum dikenali oleh model (belum ada di data training). Prediksi hanya bisa dilakukan untuk menu yang sudah ada saat model dilatih."]);
        }

        if ($response->failed()) {
            return back()
                ->withInput()
                ->withErrors(['prediksi' => 'Gagal mendapatkan prediksi: ' . ($response->json('detail') ?? $response->body())]);
        }

        $hasil = $response->json();

        $menus = Menu::orderBy('nama_menu')->get();
        $hariOptions = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
        $promoOptions = ['Ya', 'Tidak'];

        return view('admin.stok-prediction.index', [
            'menus'        => $menus,
            'hariOptions'  => $hariOptions,
            'promoOptions' => $promoOptions,
            'hasil'        => $hasil['prediksi'],
            'input'        => $validated,
        ]);
    }
}