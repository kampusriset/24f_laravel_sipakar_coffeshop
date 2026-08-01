<?php

namespace Database\Seeders;

use App\Models\KategoriMenu;
use App\Models\Menu;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    /**
     * PENTING: nama_menu di bawah ini HARUS PERSIS SAMA (termasuk huruf besar/kecil
     * dan spasi) dengan kategori "Menu" yang dikenali OneHotEncoder saat training model.
     * Kalau ada perbedaan penulisan, ml-api akan menolak (400) karena
     * dianggap menu yang tidak dikenali model.
     */
    public function run(): void
    {
        $kopi = KategoriMenu::where('nama_kategori', 'Kopi')->first();
        $nonKopi = KategoriMenu::where('nama_kategori', 'Non-Kopi')->first();
        $makanan = KategoriMenu::where('nama_kategori', 'Makanan')->first();
        $dessert = KategoriMenu::where('nama_kategori', 'Dessert')->first();

        $menus = [
            // --- Kopi ---
            ['nama_menu' => 'Affogato', 'harga' => 28000, 'kategori' => $kopi],
            ['nama_menu' => 'Americano', 'harga' => 15000, 'kategori' => $kopi],
            ['nama_menu' => 'Cappuccino', 'harga' => 20000, 'kategori' => $kopi],
            ['nama_menu' => 'Cold Brew', 'harga' => 22000, 'kategori' => $kopi],
            ['nama_menu' => 'Es Kopi Susu Gula Aren', 'harga' => 18000, 'kategori' => $kopi],
            ['nama_menu' => 'Espresso', 'harga' => 14000, 'kategori' => $kopi],
            ['nama_menu' => 'Flat White', 'harga' => 21000, 'kategori' => $kopi],
            ['nama_menu' => 'Iced Americano', 'harga' => 16000, 'kategori' => $kopi],
            ['nama_menu' => 'Iced Latte', 'harga' => 20000, 'kategori' => $kopi],
            ['nama_menu' => 'Latte', 'harga' => 20000, 'kategori' => $kopi],
            ['nama_menu' => 'Macchiato', 'harga' => 19000, 'kategori' => $kopi],
            ['nama_menu' => 'Mocha', 'harga' => 21000, 'kategori' => $kopi],
            ['nama_menu' => 'Vietnamese Coffee', 'harga' => 19000, 'kategori' => $kopi],

            // --- Non-Kopi ---
            ['nama_menu' => 'Chocolate', 'harga' => 18000, 'kategori' => $nonKopi],
            ['nama_menu' => 'Green Tea', 'harga' => 17000, 'kategori' => $nonKopi],
            ['nama_menu' => 'Lemon Tea', 'harga' => 15000, 'kategori' => $nonKopi],
            ['nama_menu' => 'Lychee Tea', 'harga' => 16000, 'kategori' => $nonKopi],
            ['nama_menu' => 'Matcha Latte', 'harga' => 22000, 'kategori' => $nonKopi],
            ['nama_menu' => 'Mineral Water', 'harga' => 8000, 'kategori' => $nonKopi],
            ['nama_menu' => 'Peach Tea', 'harga' => 16000, 'kategori' => $nonKopi],
            ['nama_menu' => 'Red Velvet Latte', 'harga' => 22000, 'kategori' => $nonKopi],
            ['nama_menu' => 'Taro Latte', 'harga' => 22000, 'kategori' => $nonKopi],
            ['nama_menu' => 'Tea Latte', 'harga' => 18000, 'kategori' => $nonKopi],

            // --- Makanan ---
            ['nama_menu' => 'Burger', 'harga' => 30000, 'kategori' => $makanan],
            ['nama_menu' => 'Chicken Wings', 'harga' => 28000, 'kategori' => $makanan],
            ['nama_menu' => 'French Fries', 'harga' => 18000, 'kategori' => $makanan],
            ['nama_menu' => 'Pain au Chocolat', 'harga' => 20000, 'kategori' => $makanan],
            ['nama_menu' => 'Sandwich', 'harga' => 25000, 'kategori' => $makanan],
            ['nama_menu' => 'Spaghetti', 'harga' => 32000, 'kategori' => $makanan],
            ['nama_menu' => 'Toast', 'harga' => 15000, 'kategori' => $makanan],

            // --- Dessert ---
            ['nama_menu' => 'Brownies', 'harga' => 17000, 'kategori' => $dessert],
            ['nama_menu' => 'Cheesecake', 'harga' => 25000, 'kategori' => $dessert],
            ['nama_menu' => 'Cinnamon Roll', 'harga' => 18000, 'kategori' => $dessert],
            ['nama_menu' => 'Cookies', 'harga' => 12000, 'kategori' => $dessert],
            ['nama_menu' => 'Croissant', 'harga' => 16000, 'kategori' => $dessert],
            ['nama_menu' => 'Donut', 'harga' => 12000, 'kategori' => $dessert],
            ['nama_menu' => 'Muffin', 'harga' => 15000, 'kategori' => $dessert],
            ['nama_menu' => 'Red Velvet Cake', 'harga' => 22000, 'kategori' => $dessert],
            ['nama_menu' => 'Tiramisu', 'harga' => 27000, 'kategori' => $dessert],
        ];

        foreach ($menus as $item) {
            Menu::firstOrCreate(
                ['nama_menu' => $item['nama_menu']],
                [
                    'harga' => $item['harga'],
                    'id_kategori' => $item['kategori']->id_kategori,
                ]
            );
        }
    }
}
