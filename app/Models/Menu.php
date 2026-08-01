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

    public function bahans()
    {
        return $this->belongsToMany(Bahan::class, 'menu_bahan', 'id_menu', 'id_bahan');
    }
}