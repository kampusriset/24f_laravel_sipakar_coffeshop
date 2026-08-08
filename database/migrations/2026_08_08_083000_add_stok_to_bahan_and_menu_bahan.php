<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('bahan', function (Blueprint $table) {
            $table->integer('stok')->default(100)->after('nama_bahan');
            $table->string('satuan', 50)->default('porsi')->after('stok');
        });

        Schema::table('menu_bahan', function (Blueprint $table) {
            $table->integer('jumlah_dibutuhkan')->default(1)->after('id_bahan');
        });
    }

    public function down(): void
    {
        Schema::table('menu_bahan', function (Blueprint $table) {
            $table->dropColumn('jumlah_dibutuhkan');
        });

        Schema::table('bahan', function (Blueprint $table) {
            $table->dropColumn(['stok', 'satuan']);
        });
    }
};
