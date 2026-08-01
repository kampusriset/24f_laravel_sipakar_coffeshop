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
        Schema::table('users', function (Blueprint $table) {
            // Role: 'admin' atau 'user'
            $table->enum('role', ['admin', 'user'])->default('user')->after('email');
            // Google ID untuk Social Login (fitur berikutnya)
            $table->string('google_id')->nullable()->after('remember_token');
            // Avatar dari Google
            $table->string('avatar')->nullable()->after('google_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['role', 'google_id', 'avatar']);
        });
    }
};
