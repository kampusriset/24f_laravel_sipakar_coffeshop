<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Promo extends Model
{
    protected $fillable = [
        'judul',
        'deskripsi',
        'diskon_persen',
        'gambar',
        'is_active',
    ];

    public function menus()
    {
        return $this->belongsToMany(Menu::class, 'menu_promo', 'promo_id', 'menu_id');
    }
}
