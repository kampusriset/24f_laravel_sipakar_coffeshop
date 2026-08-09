<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $table = 'menu';
    protected $primaryKey = 'id_menu';

    protected $fillable = [
        'nama_menu',
        'harga',
        'gambar',
        'id_kategori',
    ];

    public function kategori()
    {
        return $this->belongsTo(KategoriMenu::class, 'id_kategori', 'id_kategori');
    }

    public function promos()
    {
        return $this->belongsToMany(Promo::class, 'menu_promo', 'menu_id', 'promo_id');
    }

    public function bahans()
    {
        return $this->belongsToMany(Bahan::class, 'menu_bahan', 'id_menu', 'id_bahan')
                    ->withPivot('jumlah_dibutuhkan')
                    ->withTimestamps();
    }

    /**
     * Cek apakah stok semua bahan baku menu ini mencukupi untuk minimal 1 porsi.
     */
    public function isTersedia(): bool
    {
        if ($this->relationLoaded('bahans') ? $this->bahans->isEmpty() : $this->bahans()->count() === 0) {
            return true;
        }

        $bahans = $this->relationLoaded('bahans') ? $this->bahans : $this->bahans()->get();

        foreach ($bahans as $bahan) {
            $needed = $bahan->pivot->jumlah_dibutuhkan ?? 1;
            if ($bahan->stok < $needed) {
                return false;
            }
        }

        return true;
    }
}