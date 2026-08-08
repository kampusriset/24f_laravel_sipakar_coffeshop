<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('menu_promo', function (Blueprint $table) {
            $table->id();
            $table->foreignId('menu_id')->constrained('menu', 'id_menu')->cascadeOnDelete();
            $table->foreignId('promo_id')->constrained('promos')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menu_promo');
    }
};
