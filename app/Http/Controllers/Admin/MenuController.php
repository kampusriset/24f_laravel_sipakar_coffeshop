<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\KategoriMenu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MenuController extends Controller
{
    public function index()
    {
        $menus = Menu::with('kategori')->latest()->paginate(10);
        return view('admin.menu.index', compact('menus'));
    }

    public function create()
    {
        $kategoris = KategoriMenu::all();
        return view('admin.menu.create', compact('kategoris'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_menu'   => ['required', 'string', 'max:100'],
            'harga'       => ['required', 'integer', 'min:0'],
            'id_kategori' => ['required', 'exists:kategori_menu,id_kategori'],
            'gambar'      => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ]);

        if ($request->hasFile('gambar')) {
            $validated['gambar'] = $request->file('gambar')->store('menu', 'public');
        }

        Menu::create($validated);

        return redirect()->route('admin.menu.index')
                         ->with('success', 'Menu berhasil ditambahkan.');
    }

    public function edit(Menu $menu)
    {
        $kategoris = KategoriMenu::all();
        return view('admin.menu.edit', compact('menu', 'kategoris'));
    }

    public function update(Request $request, Menu $menu)
    {
        $validated = $request->validate([
            'nama_menu'   => ['required', 'string', 'max:100'],
            'harga'       => ['required', 'integer', 'min:0'],
            'id_kategori' => ['required', 'exists:kategori_menu,id_kategori'],
            'gambar'      => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ]);

        if ($request->hasFile('gambar')) {
            // Hapus gambar lama kalau ada
            if ($menu->gambar) {
                Storage::disk('public')->delete($menu->gambar);
            }
            $validated['gambar'] = $request->file('gambar')->store('menu', 'public');
        }

        $menu->update($validated);

        return redirect()->route('admin.menu.index')
                         ->with('success', 'Menu berhasil diperbarui.');
    }

    public function destroy(Menu $menu)
    {
        if ($menu->gambar) {
            Storage::disk('public')->delete($menu->gambar);
        }

        $menu->delete();

        return redirect()->route('admin.menu.index')
                         ->with('success', 'Menu berhasil dihapus.');
    }
}