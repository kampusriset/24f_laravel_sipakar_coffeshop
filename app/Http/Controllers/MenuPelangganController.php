<?php

namespace App\Http\Controllers;

use App\Models\KategoriMenu; // Pastikan model ini di-import

class MenuPelangganController extends Controller
{
    public function index()
    {
        // Mengambil semua data kategori beserta menu yang berelasi
        $kategoris = KategoriMenu::with('menus')->get();
        
        // Mengirim data ke view
        return view('coffeeshop', compact('kategoris'));
    }
}