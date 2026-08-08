<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Ubah enum role: tambah 'kasir', dan perbaiki user lama.
     */
    public function up(): void
    {
        // MySQL: ubah enum dengan MODIFY COLUMN
        DB::statement("ALTER TABLE users MODIFY COLUMN role ENUM('admin', 'kasir', 'user') NOT NULL DEFAULT 'user'");

        // Perbaiki user 'admin' lama (email = 'admin') yang role-nya salah
        DB::table('users')
            ->where('email', 'admin')
            ->update(['role' => 'admin']);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("ALTER TABLE users MODIFY COLUMN role ENUM('admin', 'user') NOT NULL DEFAULT 'user'");
    }
};
