<?php

namespace Database\Seeders;

use App\Models\Menu;
use App\Models\Promo;
use Illuminate\Database\Seeder;

class PromoSeeder extends Seeder
{
    public function run(): void
    {
        // Promo 1: Diskon 15%
        $promo1 = Promo::firstOrCreate(
            ['judul' => 'Promo Special Coffee Week'],
            [
                'deskripsi'     => 'Nikmati potongan harga 15% khusus untuk menu kopi pilihan minggu ini!',
                'diskon_persen' => 15,
                'is_active'     => true,
            ]
        );

        // Tempelkan ke beberapa menu jika ada
        $menuKopi = Menu::where('nama_menu', 'LIKE', '%kopi%')
            ->orWhere('nama_menu', 'LIKE', '%coffee%')
            ->orWhere('nama_menu', 'LIKE', '%americano%')
            ->orWhere('nama_menu', 'LIKE', '%latte%')
            ->pluck('id_menu');

        if ($menuKopi->isNotEmpty()) {
            $promo1->menus()->sync($menuKopi->take(3));
        }

        // Promo 2: Diskon 20%
        $promo2 = Promo::firstOrCreate(
            ['judul' => 'Promo Weekend Delight'],
            [
                'deskripsi'     => 'Diskon 20% untuk pembelian menu favorit pilihan!',
                'diskon_persen' => 20,
                'is_active'     => false, // Default nonaktif sebagai contoh
            ]
        );

        $allMenu = Menu::pluck('id_menu');
        if ($allMenu->isNotEmpty()) {
            $promo2->menus()->sync($allMenu->take(2));
        }
    }
}
