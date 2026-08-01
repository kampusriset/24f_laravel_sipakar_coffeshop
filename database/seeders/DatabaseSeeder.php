<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // ── Akun Admin ─────────────────────────────────────────
        User::firstOrCreate(
            ['email' => 'admin@coffeeshop.com'],
            [
                'name'     => 'Admin Coffeeshop',
                'password' => Hash::make('admin123'),
                'role'     => 'admin',
            ]
        );

        // ── Akun Kasir ─────────────────────────────────────────
        User::firstOrCreate(
            ['email' => 'kasir@coffeeshop.com'],
            [
                'name'     => 'Kasir 1',
                'password' => Hash::make('kasir123'),
                'role'     => 'kasir',
            ]
        );

        // ── Akun User (Pelanggan Terdaftar) ────────────────────
        User::firstOrCreate(
            ['email' => 'user@coffeeshop.com'],
            [
                'name'     => 'Pelanggan Demo',
                'password' => Hash::make('user123'),
                'role'     => 'user',
            ]
        );

        // ── Seeder Data Menu ───────────────────────────────────
        $this->call([
            KategoriMenuSeeder::class,
            MenuSeeder::class,
            BahanSeeder::class,
        ]);
    }
}
