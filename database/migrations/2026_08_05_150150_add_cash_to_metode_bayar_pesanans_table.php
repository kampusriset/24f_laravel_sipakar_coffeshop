<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        if (DB::getDriverName() === 'pgsql') {
            DB::statement("ALTER TABLE pesanans DROP CONSTRAINT IF EXISTS pesanans_metode_bayar_check");
            DB::statement("ALTER TABLE pesanans ALTER COLUMN metode_bayar TYPE VARCHAR(50)");
            DB::statement("ALTER TABLE pesanans ALTER COLUMN metode_bayar SET DEFAULT 'qris'");
            DB::statement("ALTER TABLE pesanans ADD CONSTRAINT pesanans_metode_bayar_check CHECK (metode_bayar IN ('qris', 'cash'))");
        } else {
            DB::statement("ALTER TABLE pesanans MODIFY COLUMN metode_bayar ENUM('qris', 'cash') NOT NULL DEFAULT 'qris'");
        }
    }

    public function down(): void
    {
        if (DB::getDriverName() === 'pgsql') {
            DB::statement("ALTER TABLE pesanans DROP CONSTRAINT IF EXISTS pesanans_metode_bayar_check");
            DB::statement("ALTER TABLE pesanans ADD CONSTRAINT pesanans_metode_bayar_check CHECK (metode_bayar IN ('qris'))");
        } else {
            DB::statement("ALTER TABLE pesanans MODIFY COLUMN metode_bayar ENUM('qris') NOT NULL DEFAULT 'qris'");
        }
    }
};
