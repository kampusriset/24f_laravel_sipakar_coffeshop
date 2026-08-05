<?php

namespace Database\Seeders;

use App\Models\Menu;
use Illuminate\Database\Seeder;

class UpdateGambarMenuSeeder extends Seeder
{
    /**
     * Hanya mengupdate kolom 'gambar' pada menu yang sudah ada di database.
     * Aman dijalankan berkali-kali (idempotent).
     */
    public function run(): void
    {
        $peta = [
            'Affogato'              => 'affogato.webp',
            'Americano'             => 'americano.webp',
            'Brownies'              => 'brownies.webp',
            'Burger'                => 'burger.webp',
            'Cappuccino'            => 'cappuccino.webp',
            'Cheesecake'            => 'cheesecake.webp',
            'Chicken Wings'         => 'chicken-wings.webp',
            'Chocolate'             => 'chocolate.webp',
            'Cinnamon Roll'         => 'cinnamon-roll.webp',
            'Cold Brew'             => 'cold-brew.webp',
            'Cookies'               => 'cookies.webp',
            'Croissant'             => 'croissant.webp',
            'Donut'                 => 'donut.webp',
            'Es Kopi Susu Gula Aren'=> 'es-kopi-susu-gula-aren.webp',
            'Espresso'              => 'espresso.webp',
            'Flat White'            => 'flat-white.webp',
            'French Fries'          => 'french-fries.webp',
            'Green Tea'             => 'green-tea.webp',
            'Iced Americano'        => 'iced-americano.webp',
            'Iced Latte'            => 'iced-latte.webp',
            'Latte'                 => 'latte.webp',
            'Lemon Tea'             => 'lemon-tea.webp',
            'Lychee Tea'            => 'lychee-tea.webp',
            'Macchiato'             => 'macchiato.webp',
            'Matcha Latte'          => 'matcha-latte.webp',
            'Mineral Water'         => 'mineral-water.webp',
            'Mocha'                 => 'mocha.webp',
            'Muffin'                => 'muffin.webp',
            'Pain au Chocolat'      => 'pain-au-chocolat.webp',
            'Peach Tea'             => 'peach-tea.webp',
            'Red Velvet Cake'       => 'red-velvet-cake.webp',
            'Red Velvet Latte'      => 'red-velvet-latte.webp',
            'Sandwich'              => 'gourmet-sandwich.webp',
            'Spaghetti'             => 'spaghetti-bolognese.webp',
            'Taro Latte'            => 'taro-latte.webp',
            'Tea Latte'             => 'tea-latte.webp',
            'Tiramisu'              => 'tiramisu.webp',
            'Toast'                 => 'artisanal-toast.webp',
            'Vietnamese Coffee'     => 'vietnamese-coffee.webp',
        ];

        $berhasil = 0;
        $tidakDitemukan = [];

        foreach ($peta as $namaMenu => $namaFile) {
            $menu = Menu::where('nama_menu', $namaMenu)->first();

            if ($menu) {
                $menu->update(['gambar' => $namaFile]);
                $berhasil++;
            } else {
                $tidakDitemukan[] = $namaMenu;
            }
        }

        $this->command->info("✅ Berhasil update gambar: {$berhasil} menu.");

        if (!empty($tidakDitemukan)) {
            $this->command->warn('⚠️  Menu berikut TIDAK ditemukan di database:');
            foreach ($tidakDitemukan as $nama) {
                $this->command->warn("   - {$nama}");
            }
        }
    }
}
