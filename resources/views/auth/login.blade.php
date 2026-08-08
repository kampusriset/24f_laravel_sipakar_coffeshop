<x-guest-layout>
    <div class="mb-4 text-center">
        <h2 class="text-xl font-bold text-gray-800">Masuk ke Akun Anda</h2>
        <p class="text-xs text-gray-500 mt-1">Silakan masuk untuk menikmati promo diskon &amp; kemudahan pemesanan.</p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="email@contoh.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" placeholder="••••••••" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me & Forgot Password -->
        <div class="flex items-center justify-between mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-amber-800 shadow-sm focus:ring-amber-500" name="remember">
                <span class="ms-2 text-xs text-gray-600">Ingat saya</span>
            </label>

            @if (Route::has('password.request'))
                <a class="text-xs text-amber-800 hover:text-amber-900 underline font-medium" href="{{ route('password.request') }}">
                    Lupa kata sandi?
                </a>
            @endif
        </div>

        <div class="mt-6">
            <button type="submit" class="w-full inline-flex items-center justify-center px-4 py-2.5 bg-amber-800 border border-transparent rounded-lg font-semibold text-xs text-white uppercase tracking-widest hover:bg-amber-700 active:bg-amber-900 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:ring-offset-2 transition ease-in-out duration-150 shadow-md">
                LOG IN
            </button>
        </div>
    </form>

    <!-- Opsi Registrasi Akun Baru -->
    <div class="mt-4 text-center">
        <p class="text-xs text-gray-600">
            Belum memiliki akun?
            <a href="{{ route('register') }}" class="font-bold text-amber-800 hover:text-amber-900 underline ml-1">
                Daftar Sekarang →
            </a>
        </p>
    </div>

    <!-- Divider -->
    <div class="mt-6 flex items-center">
        <div class="flex-1 border-t border-gray-200"></div>
        <span class="px-4 text-xs text-gray-400 uppercase tracking-wider">atau</span>
        <div class="flex-1 border-t border-gray-200"></div>
    </div>

    <!-- Tombol Google Sign In -->
    <div class="mt-4">
        <a href="{{ route('auth.google.redirect') }}"
           class="w-full flex items-center justify-center gap-3 px-4 py-2.5 border border-gray-300 rounded-lg bg-white hover:bg-gray-50 transition shadow-sm text-sm font-medium text-gray-700 active:scale-[0.98]">
            {{-- Google "G" SVG Logo --}}
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" class="w-5 h-5">
                <path fill="#EA4335" d="M24 9.5c3.54 0 6.71 1.22 9.21 3.6l6.85-6.85C35.9 2.38 30.47 0 24 0 14.62 0 6.51 5.38 2.56 13.22l7.98 6.19C12.43 13.72 17.74 9.5 24 9.5z"/>
                <path fill="#4285F4" d="M46.98 24.55c0-1.57-.15-3.09-.38-4.55H24v9.02h12.94c-.58 2.96-2.26 5.48-4.78 7.18l7.73 6c4.51-4.18 7.09-10.36 7.09-17.65z"/>
                <path fill="#FBBC05" d="M10.53 28.59c-.48-1.45-.76-2.99-.76-4.59s.27-3.14.76-4.59l-7.98-6.19C.92 16.46 0 20.12 0 24c0 3.88.92 7.54 2.56 10.78l7.97-6.19z"/>
                <path fill="#34A853" d="M24 48c6.48 0 11.93-2.13 15.89-5.81l-7.73-6c-2.15 1.45-4.92 2.3-8.16 2.3-6.26 0-11.57-4.22-13.47-9.91l-7.98 6.19C6.51 42.62 14.62 48 24 48z"/>
                <path fill="none" d="M0 0h48v48H0z"/>
            </svg>
            <span>Lanjutkan dengan Google</span>
        </a>
    </div>

    <!-- Link ke halaman utama (guest bisa browsing tanpa login) -->
    <div class="mt-5 text-center">
        <a href="{{ route('coffeeshop.index') }}" class="text-xs text-gray-500 hover:text-gray-700 underline">
            ← Kembali ke menu tanpa login
        </a>
    </div>
</x-guest-layout>
