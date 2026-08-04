<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('detail_pesanans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pesanan_id')->constrained('pesanans')->cascadeOnDelete();
            $table->string('nama_menu');
            $table->unsignedBigInteger('harga_satuan');
            $table->unsignedTinyInteger('qty');
            $table->unsignedBigInteger('subtotal'); // harga_satuan * qty
            // Add-on kopi (nullable untuk food / no-addon)
            $table->string('suhu', 10)->nullable();        // Ice / Hot
            $table->string('sugar_level', 20)->nullable(); // No Sugar / Less Sugar / Normal Sugar
            $table->string('ukuran', 15)->nullable();      // Reguler / Large / Extra Large
            $table->string('jenis_susu', 15)->nullable();  // Milk / Oatside
            $table->string('topping', 100)->nullable();    // comma-separated: "Extra Shot, Whipped Cream"
            $table->text('catatan')->nullable();           // catatan per item
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('detail_pesanans');
    }
};
