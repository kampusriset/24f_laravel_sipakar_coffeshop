<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Bahan;
use App\Models\Menu;

class BahanSeeder extends Seeder
{
    public function run(): void
    {
        // ── Master data bahan ──────────────────────────────────────────────
        // Termasuk bahan add-on (Oat Milk, Whipped Cream, Sirup Karamel)
        // agar admin bisa mengelolanya di Filament, TAPI tidak di-link ke menu
        // secara statis — konsumsinya dihitung dari data order nyata.
        $bahans = [
            // Kopi & espresso
            'Espresso Shot',
            'Kopi Arabika',
            'Kopi Robusta',

            // Susu & alternatif susu
            'Susu Segar',
            'Susu Kental Manis',
            'Oat Milk (Oatside)',       // ADD-ON opsional

            // Topping & garnish — ADD-ON opsional, tidak di-link ke menu
            'Whipped Cream',            // ADD-ON opsional
            'Sirup Karamel',            // ADD-ON opsional (Caramel Drizzle)
            'Busa Susu (Foam)',

            // Bahan dasar minuman
            'Gula Aren',
            'Gula Pasir',
            'Es Batu',
            'Air Panas',
            'Air Mineral',

            // Powder & syrup
            'Coklat Bubuk',
            'Matcha Bubuk',
            'Taro Powder',
            'Sirup Vanilla',
            'Sirup Lychee',
            'Sirup Peach',
            'Teh Celup',
            'Buah Lemon',

            // Bahan kue & pastry
            'Cream Cheese',
            'Biskuit Graham',
            'Tepung Terigu',
            'Telur',
            'Mentega',
            'Coklat Batang',
            'Keju',

            // Bahan makanan berat
            'Daging Ayam',
            'Roti Tawar',
            'Selai',
        ];

        foreach ($bahans as $nama) {
            Bahan::firstOrCreate(['nama_bahan' => $nama]);
        }

        // ── Mapping menu → bahan (HANYA bahan DASAR/WAJIB) ───────────────
        // Add-on TIDAK dimasukkan karena opsional per order.
        // Konsumsi add-on yang akurat harus dihitung dari tabel detail_pesanans
        // (kolom: jenis_susu, topping) berdasarkan pesanan nyata pelanggan.
        $menuBahan = [
            // ── Kopi Panas ─────────────────────────────────────────────────
            'Cappuccino'      => ['Espresso Shot', 'Susu Segar', 'Busa Susu (Foam)'],
            'Latte'           => ['Espresso Shot', 'Susu Segar', 'Sirup Vanilla'],
            'Americano'       => ['Espresso Shot', 'Air Panas'],
            'Espresso'        => ['Kopi Arabika', 'Espresso Shot'],
            'Flat White'      => ['Espresso Shot', 'Susu Segar'],
            'Macchiato'       => ['Espresso Shot', 'Susu Segar', 'Busa Susu (Foam)'],

            // ── Es Kopi ────────────────────────────────────────────────────
            'Iced Latte'      => ['Espresso Shot', 'Susu Segar', 'Es Batu', 'Sirup Vanilla'],
            'Iced Americano'  => ['Espresso Shot', 'Air Panas', 'Es Batu'],
            'Cold Brew'       => ['Kopi Arabika', 'Air Mineral', 'Es Batu'],
            'Mocha'           => ['Espresso Shot', 'Susu Segar', 'Coklat Bubuk'],
            'Affogato'        => ['Espresso Shot', 'Es Batu', 'Susu Kental Manis'],
            'Vietnamese Coffee'      => ['Kopi Robusta', 'Susu Kental Manis', 'Es Batu'],
            'Es Kopi Susu Gula Aren' => ['Espresso Shot', 'Susu Segar', 'Gula Aren', 'Es Batu'],

            // ── Non Kopi (Latte berbasis powder) ───────────────────────────
            'Matcha Latte'    => ['Matcha Bubuk', 'Susu Segar', 'Es Batu'],
            'Taro Latte'      => ['Taro Powder', 'Susu Segar', 'Es Batu'],
            'Red Velvet Latte'=> ['Espresso Shot', 'Susu Segar', 'Sirup Vanilla', 'Coklat Bubuk'],
            'Tea Latte'       => ['Teh Celup', 'Susu Segar'],
            'Chocolate'       => ['Coklat Bubuk', 'Susu Segar'],

            // ── Minuman Segar & Non-Susu ───────────────────────────────────
            'Green Tea'       => ['Matcha Bubuk', 'Air Panas'],
            'Lemon Tea'       => ['Teh Celup', 'Buah Lemon', 'Air Panas', 'Gula Pasir'],
            'Lychee Tea'      => ['Teh Celup', 'Sirup Lychee', 'Es Batu'],
            'Peach Tea'       => ['Teh Celup', 'Sirup Peach', 'Es Batu'],
            'Mineral Water'   => ['Air Mineral'],

            // ── Pastry & Dessert ───────────────────────────────────────────
            'Cheesecake'      => ['Cream Cheese', 'Biskuit Graham', 'Gula Pasir'],
            'Red Velvet Cake' => ['Tepung Terigu', 'Telur', 'Mentega', 'Gula Pasir', 'Coklat Bubuk', 'Cream Cheese'],
            'Tiramisu'        => ['Cream Cheese', 'Kopi Arabika', 'Coklat Bubuk', 'Telur', 'Gula Pasir'],
            'Brownies'        => ['Coklat Batang', 'Tepung Terigu', 'Telur', 'Mentega', 'Gula Pasir'],
            'Muffin'          => ['Tepung Terigu', 'Telur', 'Mentega', 'Gula Pasir'],
            'Cinnamon Roll'   => ['Tepung Terigu', 'Mentega', 'Gula Pasir', 'Telur'],
            'Croissant'       => ['Tepung Terigu', 'Mentega', 'Telur'],
            'Pain au Chocolat'=> ['Tepung Terigu', 'Mentega', 'Coklat Batang'],
            'Donut'           => ['Tepung Terigu', 'Telur', 'Gula Pasir', 'Mentega'],
            'Cookies'         => ['Tepung Terigu', 'Mentega', 'Gula Pasir', 'Telur', 'Coklat Batang'],
            'Toast'           => ['Roti Tawar', 'Mentega', 'Selai'],

            // ── Makanan Berat ──────────────────────────────────────────────
            'Sandwich'        => ['Roti Tawar', 'Keju', 'Telur', 'Mentega'],
            'Burger'          => ['Daging Ayam', 'Roti Tawar', 'Keju', 'Telur'],
            'French Fries'    => ['Tepung Terigu', 'Gula Pasir'],
            'Chicken Wings'   => ['Daging Ayam', 'Tepung Terigu', 'Mentega'],
            'Spaghetti'       => ['Tepung Terigu', 'Daging Ayam', 'Keju'],
        ];

        foreach ($menuBahan as $namaMenu => $namabahanList) {
            $menu = Menu::where('nama_menu', $namaMenu)->first();
            if (!$menu) continue;
            $bahanIds = Bahan::whereIn('nama_bahan', $namabahanList)->pluck('id_bahan')->toArray();
            $menu->bahans()->sync($bahanIds);
        }

        $this->command->info('✅ BahanSeeder selesai — bahan dasar diisi. Add-on opsional tersedia sebagai master bahan tanpa link ke menu.');
    }
}
