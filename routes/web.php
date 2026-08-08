<?php

use App\Http\Controllers\MenuPelangganController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| 1. Halaman Utama Coffeeshop (Customer Front-End)
|--------------------------------------------------------------------------
*/
Route::get('/', [MenuPelangganController::class, 'index'])->name('coffeeshop.index');

Route::get('/review-order', function () {
    return view('review-order');
})->name('review-order');

// Halaman pembayaran lama (redirect ke review-order)
Route::get('/pembayaran', function () {
    return view('pembayaran');
})->name('pembayaran');

/*
|--------------------------------------------------------------------------
| Sistem Pemesanan — POST cart → DB → QRIS
|--------------------------------------------------------------------------
*/
Route::post('/pesanan/simpan', [\App\Http\Controllers\PesananController::class, 'simpan'])
    ->name('pesanan.simpan');

Route::get('/pesanan/{kode}/bayar', [\App\Http\Controllers\PesananController::class, 'qris'])
    ->name('pesanan.qris');

Route::get('/pesanan/{kode}/status', [\App\Http\Controllers\PesananController::class, 'checkStatus'])
    ->name('pesanan.status');

Route::post('/pesanan/{kode}/simulasi-bayar', [\App\Http\Controllers\PesananController::class, 'simulasiBayar'])
    ->name('pesanan.simulasi-bayar');


/*
|--------------------------------------------------------------------------
| 2. Dashboard Breeze — Redirect berdasarkan Role
|--------------------------------------------------------------------------
*/
Route::get('/dashboard', function () {
    $user = auth()->user();
    // Admin & Kasir → ke panel Filament
    if ($user && in_array($user->role, ['admin', 'kasir'])) {
        return redirect('/admin');
    }
    // User biasa → halaman dashboard pelanggan
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

/*
|--------------------------------------------------------------------------
| 3. Profile (dari Breeze)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| 3b. Laporan Penjualan Export (Admin Only)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->prefix('laporan')->name('laporan.')->group(function () {
    Route::get('/csv', [\App\Http\Controllers\LaporanController::class, 'exportCsv'])->name('csv');
    Route::get('/pdf', [\App\Http\Controllers\LaporanController::class, 'exportPdf'])->name('pdf');
});

/*
|--------------------------------------------------------------------------
| 4. Auth Routes Breeze (login, register, logout, password reset)
|--------------------------------------------------------------------------
*/
require __DIR__.'/auth.php';

/*
|--------------------------------------------------------------------------
| 5. Google OAuth (Socialite)
|--------------------------------------------------------------------------
*/
Route::get('/auth/google/redirect', [\App\Http\Controllers\Auth\GoogleAuthController::class, 'redirect'])
    ->name('auth.google.redirect');

Route::get('/auth/google/callback', [\App\Http\Controllers\Auth\GoogleAuthController::class, 'callback'])
    ->name('auth.google.callback');
