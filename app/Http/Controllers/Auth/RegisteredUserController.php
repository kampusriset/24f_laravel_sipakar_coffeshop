<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Tampilkan form registrasi utama.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Step 1: Validasi form registrasi, generate OTP dummy, dan simpan di session.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name'     => ['required', 'string', 'max:255'],
            'email'    => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // Generate 6 digit dummy OTP
        $otp = (string)rand(100000, 999999);

        // Simpan data pendaftaran ke session sementara
        session([
            'otp_registration' => [
                'name'       => $request->name,
                'email'      => $request->email,
                'password'   => Hash::make($request->password),
                'otp'        => $otp,
                'expires_at' => now()->addMinutes(15),
            ]
        ]);

        return redirect()->route('register.otp');
    }

    /**
     * Step 2: Tampilkan form verifikasi OTP dummy.
     */
    public function showOtpForm(): View|RedirectResponse
    {
        if (!session()->has('otp_registration')) {
            return redirect()->route('register')
                ->withErrors(['email' => 'Sesi pendaftaran tidak ditemukan. Silakan isi form kembali.']);
        }

        return view('auth.verify-otp');
    }

    /**
     * Step 3: Verifikasi OTP yang dimasukkan user.
     */
    public function verifyOtp(Request $request): RedirectResponse
    {
        $request->validate([
            'otp' => ['required', 'string', 'size:6'],
        ]);

        $data = session('otp_registration');

        if (!$data) {
            return redirect()->route('register')
                ->withErrors(['email' => 'Sesi pendaftaran telah kadaluarsa. Silakan daftar ulang.']);
        }

        if ($request->otp !== $data['otp']) {
            return back()->withErrors(['otp' => 'Kode OTP yang Anda masukkan salah. Silakan periksa kembali kode di atas.']);
        }

        // Buat user baru dengan role default 'user' (Pelanggan)
        $user = User::create([
            'name'     => $data['name'],
            'email'    => $data['email'],
            'password' => $data['password'],
            'role'     => User::ROLE_USER,
        ]);

        event(new Registered($user));

        // Hapus sesi OTP
        session()->forget('otp_registration');

        // Login otomatis
        Auth::login($user, remember: true);

        return redirect('/')->with('success', 'Selamat! Registrasi akun berhasil.');
    }

    /**
     * Generate ulang OTP dummy.
     */
    public function resendOtp(): RedirectResponse
    {
        $data = session('otp_registration');

        if (!$data) {
            return redirect()->route('register')
                ->withErrors(['email' => 'Sesi pendaftaran telah kadaluarsa. Silakan daftar ulang.']);
        }

        // Buat OTP baru
        $data['otp'] = (string)rand(100000, 999999);
        session(['otp_registration' => $data]);

        return back()->with('status', 'Kode OTP dummy baru berhasil dibuat.');
    }
}
