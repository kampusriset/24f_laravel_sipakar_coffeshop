<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pesanan extends Model
{
    protected $table = 'pesanans';

    protected $fillable = [
        'kode_pesanan',
        'user_id',
        'nama_pelanggan',
        'nomor_hp',
        'nomor_meja',
        'status',
        'metode_bayar',
        'subtotal',
        'ppn',
        'diskon',
        'total_akhir',
        'persen_diskon',
        'catatan',
    ];

    protected $casts = [
        'subtotal'   => 'integer',
        'ppn'        => 'integer',
        'diskon'     => 'integer',
        'total_akhir'=> 'integer',
    ];

    // ─── Relasi ─────────────────────────────────────────────────

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function details(): HasMany
    {
        return $this->hasMany(DetailPesanan::class, 'pesanan_id');
    }

    // ─── Helper: label status ────────────────────────────────────

    public function statusLabel(): string
    {
        return match ($this->status) {
            'menunggu'   => '⏳ Menunggu',
            'diproses'   => '🔄 Diproses',
            'selesai'    => '✅ Selesai',
            'dibatalkan' => '❌ Dibatalkan',
            default      => $this->status,
        };
    }

    // ─── Generate kode unik ──────────────────────────────────────

    public static function generateKode(): string
    {
        $tanggal = now()->format('Ymd');
        $last    = static::whereDate('created_at', today())->count() + 1;
        return 'ORD-' . $tanggal . '-' . str_pad($last, 4, '0', STR_PAD_LEFT);
    }
}
