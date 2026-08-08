<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Ubah ENUM metode_bayar agar menerima 'qris' dan 'cash'
        DB::statement("ALTER TABLE pesanans MODIFY COLUMN metode_bayar ENUM('qris', 'cash') NOT NULL DEFAULT 'qris'");
    }

    public function down(): void
    {
        // Kembalikan hanya 'qris'
        DB::statement("ALTER TABLE pesanans MODIFY COLUMN metode_bayar ENUM('qris') NOT NULL DEFAULT 'qris'");
    }
};
