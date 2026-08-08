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
     */
    public function run(): void
    {
        $kopi = KategoriMenu::where('nama_kategori', 'Kopi')->first();
        $nonKopi = KategoriMenu::where('nama_kategori', 'Non-Kopi')->first();
        $makanan = KategoriMenu::where('nama_kategori', 'Makanan')->first();
        $dessert = KategoriMenu::where('nama_kategori', 'Dessert')->first();

        $menus = [
            // --- Kopi ---
            ['nama_menu' => 'Affogato', 'harga' => 28000, 'kategori' => $kopi, 'gambar' => 'affogato.webp'],
            ['nama_menu' => 'Americano', 'harga' => 15000, 'kategori' => $kopi, 'gambar' => 'americano.webp'],
            ['nama_menu' => 'Cappuccino', 'harga' => 20000, 'kategori' => $kopi, 'gambar' => 'cappuccino.webp'],
            ['nama_menu' => 'Cold Brew', 'harga' => 22000, 'kategori' => $kopi, 'gambar' => 'cold-brew.webp'],
            ['nama_menu' => 'Es Kopi Susu Gula Aren', 'harga' => 18000, 'kategori' => $kopi, 'gambar' => 'es-kopi-susu-gula-aren.webp'],
            ['nama_menu' => 'Espresso', 'harga' => 14000, 'kategori' => $kopi, 'gambar' => 'espresso.webp'],
            ['nama_menu' => 'Flat White', 'harga' => 21000, 'kategori' => $kopi, 'gambar' => 'flat-white.webp'],
            ['nama_menu' => 'Iced Americano', 'harga' => 16000, 'kategori' => $kopi, 'gambar' => 'iced-americano.webp'],
            ['nama_menu' => 'Iced Latte', 'harga' => 20000, 'kategori' => $kopi, 'gambar' => 'iced-latte.webp'],
            ['nama_menu' => 'Latte', 'harga' => 20000, 'kategori' => $kopi, 'gambar' => 'latte.webp'],
            ['nama_menu' => 'Macchiato', 'harga' => 19000, 'kategori' => $kopi, 'gambar' => 'macchiato.webp'],
            ['nama_menu' => 'Mocha', 'harga' => 21000, 'kategori' => $kopi, 'gambar' => 'mocha.webp'],
            ['nama_menu' => 'Vietnamese Coffee', 'harga' => 19000, 'kategori' => $kopi, 'gambar' => 'vietnamese-coffee.webp'],

            // --- Non-Kopi ---
            ['nama_menu' => 'Chocolate', 'harga' => 18000, 'kategori' => $nonKopi, 'gambar' => 'chocolate.webp'],
            ['nama_menu' => 'Green Tea', 'harga' => 17000, 'kategori' => $nonKopi, 'gambar' => 'green-tea.webp'],
            ['nama_menu' => 'Lemon Tea', 'harga' => 15000, 'kategori' => $nonKopi, 'gambar' => 'lemon-tea.webp'],
            ['nama_menu' => 'Lychee Tea', 'harga' => 16000, 'kategori' => $nonKopi, 'gambar' => 'lychee-tea.webp'],
            ['nama_menu' => 'Matcha Latte', 'harga' => 22000, 'kategori' => $nonKopi, 'gambar' => 'matcha-latte.webp'],
            ['nama_menu' => 'Mineral Water', 'harga' => 8000, 'kategori' => $nonKopi, 'gambar' => 'mineral-water.webp'],
            ['nama_menu' => 'Peach Tea', 'harga' => 16000, 'kategori' => $nonKopi, 'gambar' => 'peach-tea.webp'],
            ['nama_menu' => 'Red Velvet Latte', 'harga' => 22000, 'kategori' => $nonKopi, 'gambar' => 'red-velvet-latte.webp'],
            ['nama_menu' => 'Taro Latte', 'harga' => 22000, 'kategori' => $nonKopi, 'gambar' => 'taro-latte.webp'],
            ['nama_menu' => 'Tea Latte', 'harga' => 18000, 'kategori' => $nonKopi, 'gambar' => 'tea-latte.webp'],

            // --- Makanan ---
            ['nama_menu' => 'Burger', 'harga' => 30000, 'kategori' => $makanan, 'gambar' => 'burger.webp'],
            ['nama_menu' => 'Chicken Wings', 'harga' => 28000, 'kategori' => $makanan, 'gambar' => 'chicken-wings.webp'],
            ['nama_menu' => 'French Fries', 'harga' => 18000, 'kategori' => $makanan, 'gambar' => 'french-fries.webp'],
            ['nama_menu' => 'Pain au Chocolat', 'harga' => 20000, 'kategori' => $makanan, 'gambar' => 'pain-au-chocolat.webp'],
            ['nama_menu' => 'Sandwich', 'harga' => 25000, 'kategori' => $makanan, 'gambar' => 'gourmet-sandwich.webp'],
            ['nama_menu' => 'Spaghetti', 'harga' => 32000, 'kategori' => $makanan, 'gambar' => 'spaghetti-bolognese.webp'],
            ['nama_menu' => 'Toast', 'harga' => 15000, 'kategori' => $makanan, 'gambar' => 'artisanal-toast.webp'],

            // --- Dessert ---
            ['nama_menu' => 'Brownies', 'harga' => 17000, 'kategori' => $dessert, 'gambar' => 'brownies.webp'],
            ['nama_menu' => 'Cheesecake', 'harga' => 25000, 'kategori' => $dessert, 'gambar' => 'cheesecake.webp'],
            ['nama_menu' => 'Cinnamon Roll', 'harga' => 18000, 'kategori' => $dessert, 'gambar' => 'cinnamon-roll.webp'],
            ['nama_menu' => 'Cookies', 'harga' => 12000, 'kategori' => $dessert, 'gambar' => 'cookies.webp'],
            ['nama_menu' => 'Croissant', 'harga' => 16000, 'kategori' => $dessert, 'gambar' => 'croissant.webp'],
            ['nama_menu' => 'Donut', 'harga' => 12000, 'kategori' => $dessert, 'gambar' => 'donut.webp'],
            ['nama_menu' => 'Muffin', 'harga' => 15000, 'kategori' => $dessert, 'gambar' => 'muffin.webp'],
            ['nama_menu' => 'Red Velvet Cake', 'harga' => 22000, 'kategori' => $dessert, 'gambar' => 'red-velvet-cake.webp'],
            ['nama_menu' => 'Tiramisu', 'harga' => 27000, 'kategori' => $dessert, 'gambar' => 'tiramisu.webp'],
        ];

        foreach ($menus as $item) {
            $menu = Menu::where('nama_menu', $item['nama_menu'])->first();
            if ($menu) {
                // Update gambar dan data pendukung jika sudah ada
                $menu->update([
                    'harga' => $item['harga'],
                    'id_kategori' => $item['kategori']->id_kategori,
                    'gambar' => $item['gambar']
                ]);
            } else {
                Menu::create([
                    'nama_menu' => $item['nama_menu'],
                    'harga' => $item['harga'],
                    'id_kategori' => $item['kategori']->id_kategori,
                    'gambar' => $item['gambar']
                ]);
            }
        }
    }
}
