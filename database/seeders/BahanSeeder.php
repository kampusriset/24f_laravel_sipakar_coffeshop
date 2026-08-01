<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Bahan;
use App\Models\Menu;

class BahanSeeder extends Seeder
{
    public function run(): void
    {
        // Master data bahan
        $bahans = [
            'Espresso Shot',
            'Susu Segar',
            'Busa Susu (Foam)',
            'Kopi Arabika',
            'Kopi Robusta',
            'Gula Aren',
            'Es Batu',
            'Air Panas',
            'Coklat Bubuk',
            'Matcha Bubuk',
            'Taro Powder',
            'Sirup Vanilla',
            'Whipped Cream',
            'Susu Kental Manis',
            'Cream Cheese',
            'Biskuit Graham',
            'Gula Pasir',
            'Telur',
            'Tepung Terigu',
            'Mentega',
            'Coklat Batang',
            'Keju',
            'Daging Ayam',
            'Roti Tawar',
            'Selai',
            'Buah Lemon',
            'Teh Celup',
            'Sirup Lychee',
            'Sirup Peach',
            'Air Mineral',
        ];

        foreach ($bahans as $nama) {
            Bahan::firstOrCreate(['nama_bahan' => $nama]);
        }

        // Mapping menu → bahan
        $menuBahan = [
            'Cappuccino'           => ['Espresso Shot', 'Susu Segar', 'Busa Susu (Foam)'],
            'Latte'                => ['Espresso Shot', 'Susu Segar', 'Sirup Vanilla'],
            'Americano'            => ['Espresso Shot', 'Air Panas'],
            'Espresso'             => ['Kopi Arabika'],
            'Iced Latte'           => ['Espresso Shot', 'Susu Segar', 'Es Batu', 'Sirup Vanilla'],
            'Iced Americano'       => ['Espresso Shot', 'Air Panas', 'Es Batu'],
            'Cold Brew'            => ['Kopi Arabika', 'Air Mineral', 'Es Batu'],
            'Flat White'           => ['Espresso Shot', 'Susu Segar'],
            'Macchiato'            => ['Espresso Shot', 'Susu Segar', 'Busa Susu (Foam)'],
            'Mocha'                => ['Espresso Shot', 'Susu Segar', 'Coklat Bubuk', 'Whipped Cream'],
            'Affogato'             => ['Espresso Shot', 'Es Batu', 'Susu Kental Manis'],
            'Vietnamese Coffee'    => ['Kopi Robusta', 'Susu Kental Manis', 'Es Batu'],
            'Es Kopi Susu Gula Aren' => ['Espresso Shot', 'Susu Segar', 'Gula Aren', 'Es Batu'],
            'Matcha Latte'         => ['Matcha Bubuk', 'Susu Segar', 'Es Batu'],
            'Taro Latte'           => ['Taro Powder', 'Susu Segar', 'Es Batu'],
            'Red Velvet Latte'     => ['Espresso Shot', 'Susu Segar', 'Sirup Vanilla', 'Coklat Bubuk'],
            'Tea Latte'            => ['Teh Celup', 'Susu Segar'],
            'Chocolate'            => ['Coklat Bubuk', 'Susu Segar', 'Whipped Cream'],
            'Green Tea'            => ['Matcha Bubuk', 'Air Panas'],
            'Lemon Tea'            => ['Teh Celup', 'Buah Lemon', 'Air Panas', 'Gula Pasir'],
            'Lychee Tea'           => ['Teh Celup', 'Sirup Lychee', 'Es Batu'],
            'Peach Tea'            => ['Teh Celup', 'Sirup Peach', 'Es Batu'],
            'Mineral Water'        => ['Air Mineral'],
            'Cheesecake'           => ['Cream Cheese', 'Biskuit Graham', 'Gula Pasir', 'Whipped Cream'],
            'Red Velvet Cake'      => ['Tepung Terigu', 'Telur', 'Mentega', 'Gula Pasir', 'Coklat Bubuk'],
            'Tiramisu'             => ['Cream Cheese', 'Kopi Arabika', 'Coklat Bubuk', 'Telur', 'Gula Pasir'],
            'Brownies'             => ['Coklat Batang', 'Tepung Terigu', 'Telur', 'Mentega', 'Gula Pasir'],
            'Muffin'               => ['Tepung Terigu', 'Telur', 'Mentega', 'Gula Pasir'],
            'Cinnamon Roll'        => ['Tepung Terigu', 'Mentega', 'Gula Pasir', 'Telur'],
            'Croissant'            => ['Tepung Terigu', 'Mentega', 'Telur'],
            'Pain au Chocolat'     => ['Tepung Terigu', 'Mentega', 'Coklat Batang'],
            'Donut'                => ['Tepung Terigu', 'Telur', 'Gula Pasir', 'Mentega'],
            'Cookies'              => ['Tepung Terigu', 'Mentega', 'Gula Pasir', 'Telur', 'Coklat Batang'],
            'Toast'                => ['Roti Tawar', 'Mentega', 'Selai'],
            'Sandwich'             => ['Roti Tawar', 'Keju', 'Telur', 'Mentega'],
            'Burger'               => ['Daging Ayam', 'Roti Tawar', 'Keju', 'Telur'],
            'French Fries'         => ['Tepung Terigu', 'Gula Pasir'],
            'Chicken Wings'        => ['Daging Ayam', 'Tepung Terigu', 'Mentega'],
            'Spaghetti'            => ['Tepung Terigu', 'Daging Ayam', 'Keju'],
        ];

        foreach ($menuBahan as $namaMenu => $namabahanList) {
            $menu = Menu::where('nama_menu', $namaMenu)->first();

            if (!$menu) {
                continue; // skip kalau menu belum ada di DB
            }

            $bahanIds = Bahan::whereIn('nama_bahan', $namabahanList)->pluck('id_bahan')->toArray();
            $menu->bahans()->sync($bahanIds);
        }

        $this->command->info('✅ Seeder BahanSeeder selesai — bahan & relasi menu-bahan berhasil diisi.');
    }
}
