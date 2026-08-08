<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('menu_bahan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_menu');
            $table->unsignedBigInteger('id_bahan');
            $table->timestamps();

            $table->foreign('id_menu')->references('id_menu')->on('menu')->onDelete('cascade');
            $table->foreign('id_bahan')->references('id_bahan')->on('bahan')->onDelete('cascade');
            $table->unique(['id_menu', 'id_bahan']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('menu_bahan');
    }
};
