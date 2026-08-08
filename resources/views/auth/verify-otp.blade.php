<x-guest-layout>
    <div class="mb-4 text-center">
        <h2 class="text-xl font-bold text-gray-800">Verifikasi Kode OTP</h2>
        <p class="text-xs text-gray-500 mt-1">
            Pendaftaran untuk <strong class="text-gray-700">{{ session('otp_registration.email') }}</strong>
        </p>
    </div>

    <!-- BANNER SIMULASI DUMMY OTP -->
    <div class="bg-amber-50 border border-amber-200/80 rounded-xl p-4 mb-5 text-center shadow-sm">
        <div class="inline-flex items-center gap-1.5 text-xs font-bold text-amber-800 uppercase tracking-wider mb-1">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-amber-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
            </svg>
            <span>KODE OTP SIMULASI (DUMMY)</span>
        </div>

        <div class="text-3xl font-extrabold font-mono text-amber-950 tracking-widest bg-white py-2 px-4 rounded-lg border border-amber-200 shadow-inner my-2">
            {{ session('otp_registration.otp') }}
        </div>

        <p class="text-[11px] text-amber-700 leading-relaxed font-medium">
            Masukkan 6 digit kode di atas pada kolom input di bawah untuk menyelesaikan registrasi.
        </p>
    </div>

    <!-- Status Notification -->
    @if (session('status'))
        <div class="mb-4 text-xs font-semibold text-emerald-600 text-center bg-emerald-50 p-2 rounded-lg border border-emerald-200">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('register.otp.verify') }}">
        @csrf

        <!-- Input Kode OTP -->
        <div>
            <x-input-label for="otp" value="Masukkan Kode OTP (6 Digit)" class="text-center font-semibold" />
            <input id="otp"
                   type="text"
                   name="otp"
                   maxlength="6"
                   required
                   autofocus
                   placeholder="123456"
                   class="block mt-1 w-full text-center text-2xl font-mono tracking-widest rounded-md border-gray-300 shadow-sm focus:border-amber-500 focus:ring-amber-500" />
            <x-input-error :messages="$errors->get('otp')" class="mt-2 text-center" />
        </div>

        <div class="mt-5">
            <button type="submit" class="w-full inline-flex items-center justify-center px-4 py-2.5 bg-amber-800 border border-transparent rounded-lg font-semibold text-xs text-white uppercase tracking-widest hover:bg-amber-700 active:bg-amber-900 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:ring-offset-2 transition ease-in-out duration-150 shadow-md">
                Verifikasi &amp; Buat Akun
            </button>
        </div>
    </form>

    <!-- Resend & Cancel Option -->
    <div class="mt-6 flex flex-col items-center gap-2 border-t border-gray-100 pt-4">
        <form method="POST" action="{{ route('register.otp.resend') }}">
            @csrf
            <button type="submit" class="text-xs text-amber-800 hover:text-amber-900 font-semibold underline">
                🔄 Kirim Ulang / Generate OTP Baru
            </button>
        </form>

        <a href="{{ route('register') }}" class="text-xs text-gray-500 hover:text-gray-700 underline">
            ← Ubah Data Pendaftaran
        </a>
    </div>
</x-guest-layout>
