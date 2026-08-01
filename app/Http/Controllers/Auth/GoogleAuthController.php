<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GoogleAuthController extends Controller
{
    /**
     * Redirect user ke halaman login Google.
     */
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Handle callback dari Google setelah user login.
     * - Jika email sudah terdaftar → login langsung
     * - Jika belum → buat akun baru dengan role 'user'
     */
    public function callback()
    {
        try {
            $googleUser = Socialite::driver('google')->stateless()->user();
        } catch (\Exception $e) {
            return redirect()->route('login')
                ->withErrors(['email' => 'Login Google gagal. Silakan coba lagi.']);
        }

        // Cari user berdasarkan google_id atau email
        $user = User::where('google_id', $googleUser->getId())
                    ->orWhere('email', $googleUser->getEmail())
                    ->first();

        if ($user) {
            // Update google_id & avatar jika belum ada
            $user->update([
                'google_id' => $googleUser->getId(),
                'avatar'    => $googleUser->getAvatar(),
            ]);
        } else {
            // Buat akun baru — role default 'user' (pelanggan)
            $user = User::create([
                'name'      => $googleUser->getName(),
                'email'     => $googleUser->getEmail(),
                'google_id' => $googleUser->getId(),
                'avatar'    => $googleUser->getAvatar(),
                'password'  => bcrypt(\Illuminate\Support\Str::random(24)), // password acak
                'role'      => User::ROLE_USER,
            ]);
        }

        Auth::login($user, remember: true);

        // Redirect berdasarkan role
        if ($user->isAdmin() || $user->isKasir()) {
            return redirect('/admin');
        }

        return redirect()->intended('/');
    }
}
