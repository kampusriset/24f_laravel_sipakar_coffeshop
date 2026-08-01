<?php

namespace Database\Seeders;

use App\Models\KategoriMenu;
use Illuminate\Database\Seeder;

class KategoriMenuSeeder extends Seeder
{
    public function run(): void
    {
        $kategoris = ['Kopi', 'Non-Kopi', 'Makanan', 'Dessert'];

        foreach ($kategoris as $nama) {
            KategoriMenu::firstOrCreate(['nama_kategori' => $nama]);
        }
    }
}
