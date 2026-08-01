<?php

namespace App\Models;

use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements FilamentUser
{
    use Notifiable;

    protected $table = 'users';

    /**
     * Role yang tersedia:
     * - 'admin'  : Kelola semua data, lihat laporan, download report
     * - 'kasir'  : Proses pemesanan dan pembayaran pelanggan
     * - 'user'   : Pelanggan terdaftar (bisa dapat diskon random)
     */
    const ROLE_ADMIN = 'admin';
    const ROLE_KASIR = 'kasir';
    const ROLE_USER  = 'user';

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'google_id',
        'avatar',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password'          => 'hashed',
    ];

    // ─── Role Helpers ──────────────────────────────────────────

    public function isAdmin(): bool
    {
        return $this->role === self::ROLE_ADMIN;
    }

    public function isKasir(): bool
    {
        return $this->role === self::ROLE_KASIR;
    }

    public function isUser(): bool
    {
        return $this->role === self::ROLE_USER;
    }

    /**
     * Admin dan Kasir bisa akses panel Filament (/admin).
     * - Admin : lihat semua + laporan penjualan + download
     * - Kasir : kelola pesanan + proses pembayaran
     */
    public function canAccessPanel(Panel $panel): bool
    {
        return in_array($this->role, [self::ROLE_ADMIN, self::ROLE_KASIR]);
    }
}