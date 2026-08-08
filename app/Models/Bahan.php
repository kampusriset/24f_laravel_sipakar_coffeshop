<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bahan extends Model
{
    protected $table = 'bahan';
    protected $primaryKey = 'id_bahan';

    protected $fillable = [
        'nama_bahan',
        'stok',
        'satuan',
    ];

    public function menus()
    {
        return $this->belongsToMany(Menu::class, 'menu_bahan', 'id_bahan', 'id_menu')
                    ->withPivot('jumlah_dibutuhkan')
                    ->withTimestamps();
    }
}
