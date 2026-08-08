<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pesanans', function (Blueprint $table) {
            $table->id();
            $table->string('kode_pesanan', 20)->unique(); // ORD-20260804-0001
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('nama_pelanggan');
            $table->string('nomor_hp', 20)->nullable();
            $table->integer('nomor_meja')->nullable();
            $table->enum('status', ['menunggu', 'diproses', 'selesai', 'dibatalkan'])->default('menunggu');
            $table->enum('metode_bayar', ['qris', 'cash'])->default('qris');
            $table->unsignedBigInteger('subtotal');     // sebelum PPN
            $table->unsignedBigInteger('ppn');          // 10%
            $table->unsignedBigInteger('diskon')->default(0); // diskon random untuk user login
            $table->unsignedBigInteger('total_akhir'); // subtotal + ppn - diskon
            $table->tinyInteger('persen_diskon')->default(0); // 0, 10, 15, 20, dst
            $table->text('catatan')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pesanans');
    }
};
