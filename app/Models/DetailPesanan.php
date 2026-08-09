<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DetailPesanan extends Model
{
    protected $table = 'detail_pesanans';

    protected $fillable = [
        'pesanan_id',
        'nama_menu',
        'harga_satuan',
        'qty',
        'subtotal',
        'suhu',
        'sugar_level',
        'ukuran',
        'jenis_susu',
        'topping',
        'catatan',
    ];

    protected $casts = [
        'harga_satuan' => 'integer',
        'qty'          => 'integer',
        'subtotal'     => 'integer',
    ];

    public function pesanan(): BelongsTo
    {
        return $this->belongsTo(Pesanan::class, 'pesanan_id');
    }

    /**
     * Ringkasan add-on dalam satu string untuk ditampilkan di Filament/struk.
     */
    public function addOnSummary(): string
    {
        $parts = array_filter([
            $this->suhu,
            $this->sugar_level,
            $this->ukuran,
            $this->jenis_susu,
            $this->topping,
        ]);
        return implode(', ', $parts) ?: '-';
    }

    /**
     * Cek apakah menu ini sedang dalam promo aktif.
     */
    public function getIsPromoAttribute(): bool
    {
        $menu = \App\Models\Menu::where('nama_menu', $this->nama_menu)->first();
        if ($menu) {
            return $menu->promos()->where('is_active', true)->exists();
        }
        return false;
    }
}
