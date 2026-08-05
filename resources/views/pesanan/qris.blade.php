<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $pesanan->metode_bayar === 'cash' ? 'Pesanan Diterima' : 'Pembayaran QRIS' }} - {{ $pesanan->kode_pesanan }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap');
        body { font-family: 'Inter', sans-serif; }

        @keyframes pulse-ring {
            0%   { transform: scale(0.9); opacity: 0.7; }
            50%  { transform: scale(1.05); opacity: 0.3; }
            100% { transform: scale(0.9); opacity: 0.7; }
        }
        .qris-pulse::before {
            content: '';
            position: absolute;
            inset: -8px;
            border-radius: 20px;
            background: linear-gradient(135deg, #d97706, #92400e);
            animation: pulse-ring 2.5s ease-in-out infinite;
            z-index: -1;
        }

        @keyframes countdown {
            from { stroke-dashoffset: 0; }
            to   { stroke-dashoffset: 440; }
        }
        #timer-circle {
            animation: countdown 300s linear forwards; /* 5 menit */
        }

        @keyframes slideUp {
            from { transform: translateY(20px); opacity: 0; }
            to   { transform: translateY(0); opacity: 1; }
        }
        .slide-up { animation: slideUp 0.4s ease both; }
    </style>
</head>
<body class="bg-stone-100 antialiased text-stone-800">

<div class="max-w-md mx-auto bg-white min-h-screen shadow-xl flex flex-col">

    {{-- ── Header ─────────────────────────────────── --}}
    <div class="p-4 border-b border-stone-100 flex items-center justify-between bg-white sticky top-0 z-10">
        <div class="flex items-center gap-3">
            <a href="{{ route('coffeeshop.index') }}" class="text-stone-500 hover:text-stone-800 transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            </a>
            <div>
                <h1 class="font-bold text-stone-900 leading-tight">
                    {{ $pesanan->metode_bayar === 'cash' ? 'Pesanan Diterima' : 'Pembayaran QRIS' }}
                </h1>
                <p class="text-[11px] text-stone-400 font-mono">{{ $pesanan->kode_pesanan }}</p>
            </div>
        </div>
        <span class="text-[10px] font-bold uppercase tracking-wider px-2.5 py-1 rounded-full
            {{ $pesanan->status === 'menunggu' ? 'bg-amber-100 text-amber-700' :
               ($pesanan->status === 'diproses' ? 'bg-blue-100 text-blue-700' :
               ($pesanan->status === 'selesai'  ? 'bg-green-100 text-green-700' :
                'bg-red-100 text-red-700')) }}">
            {{ match($pesanan->status) {
                'menunggu'   => '⏳ Menunggu',
                'diproses'   => '🔄 Diproses',
                'selesai'    => '✅ Selesai',
                'dibatalkan' => '❌ Dibatalkan',
                default      => $pesanan->status,
            } }}
        </span>
    </div>

    <div class="flex-1 overflow-y-auto pb-6">

        {{-- ── Diskon Random (hanya muncul jika user login & dapat diskon) ── --}}
        @if($pesanan->persen_diskon > 0)
        <div class="mx-4 mt-4 bg-gradient-to-r from-emerald-500 to-teal-600 rounded-2xl p-4 text-white slide-up">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-semibold uppercase tracking-wider opacity-80">🎉 Selamat! Anda mendapat diskon</p>
                    <p class="text-2xl font-extrabold mt-0.5">{{ $pesanan->persen_diskon }}% OFF</p>
                    <p class="text-xs opacity-75 mt-1">Hemat Rp{{ number_format($pesanan->diskon, 0, ',', '.') }} dari pesanan ini</p>
                </div>
                <div class="text-5xl">🎊</div>
            </div>
        </div>
        @endif

        {{-- ── Konten berdasarkan metode bayar ──────────────────────────── --}}
        @if($pesanan->metode_bayar === 'cash')
            {{-- Tampilan Cash / Bayar di Kasir --}}
            <div class="px-4 pt-5">
                <div class="bg-gradient-to-b from-stone-50 to-white border border-stone-200 rounded-2xl p-6 text-center shadow-sm">
                    <div class="text-6xl mb-4">🧾</div>
                    <h2 class="font-bold text-lg text-stone-900">Pesanan Diterima!</h2>
                    <p class="text-sm text-stone-500 mt-2 leading-relaxed">Pesananmu sudah masuk ke sistem. Silakan <strong class="text-stone-800">bayar tunai di kasir</strong> dan tunjukkan kode pesanan ini.</p>
                    <div class="mt-5 bg-stone-900 text-amber-400 font-mono font-bold text-xl tracking-widest rounded-xl py-4 px-6">
                        {{ $pesanan->kode_pesanan }}
                    </div>
                    <p class="text-xs text-stone-400 mt-3">Tunjukkan kode ini ke kasir untuk konfirmasi pesanan</p>
                </div>
            </div>
        @else
            {{-- Tampilan QRIS Scan --}}
            <div class="px-4 pt-5">
                <div class="bg-gradient-to-b from-stone-50 to-white border border-stone-200 rounded-2xl p-5 text-center shadow-sm">

                    {{-- Header QRIS --}}
                    <div class="flex items-center justify-between mb-4">
                        <div class="text-left">
                            <p class="text-[9px] text-stone-400 uppercase tracking-widest">Bayar via</p>
                            <p class="text-base font-extrabold text-stone-900 tracking-tight">QRIS</p>
                            <p class="text-[10px] text-stone-500">Quick Response Code Indonesian Standard</p>
                        </div>
                        {{-- Logo QRIS placeholder --}}
                        <div class="bg-red-600 text-white text-[10px] font-black px-3 py-1.5 rounded-lg tracking-widest">
                            QRIS
                        </div>
                    </div>

                    {{-- QR Code box (dummy SVG pattern) --}}
                    <div class="relative inline-block qris-pulse mx-auto">
                        <div class="w-56 h-56 mx-auto bg-white border-2 border-stone-900 rounded-2xl p-3 shadow-inner">
                            <svg viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg" class="w-full h-full">
                                <!-- Corner squares -->
                                <rect x="10" y="10" width="55" height="55" fill="none" stroke="#1c1c1c" stroke-width="8" rx="4"/>
                                <rect x="20" y="20" width="35" height="35" fill="#1c1c1c" rx="2"/>
                                <rect x="135" y="10" width="55" height="55" fill="none" stroke="#1c1c1c" stroke-width="8" rx="4"/>
                                <rect x="145" y="20" width="35" height="35" fill="#1c1c1c" rx="2"/>
                                <rect x="10" y="135" width="55" height="55" fill="none" stroke="#1c1c1c" stroke-width="8" rx="4"/>
                                <rect x="20" y="145" width="35" height="35" fill="#1c1c1c" rx="2"/>
                                <!-- Data modules -->
                                <rect x="80" y="10" width="8" height="8" fill="#1c1c1c"/><rect x="95" y="10" width="8" height="8" fill="#1c1c1c"/><rect x="110" y="10" width="8" height="8" fill="#1c1c1c"/>
                                <rect x="80" y="25" width="8" height="8" fill="#1c1c1c"/><rect x="110" y="25" width="8" height="8" fill="#1c1c1c"/>
                                <rect x="10" y="80" width="8" height="8" fill="#1c1c1c"/><rect x="25" y="80" width="8" height="8" fill="#1c1c1c"/>
                                <rect x="10" y="95" width="8" height="8" fill="#1c1c1c"/><rect x="25" y="95" width="8" height="8" fill="#1c1c1c"/>
                                <rect x="10" y="110" width="8" height="8" fill="#1c1c1c"/>
                                <!-- Center modules -->
                                <rect x="80" y="80" width="12" height="12" fill="#1c1c1c" rx="1"/><rect x="100" y="80" width="12" height="12" fill="#1c1c1c" rx="1"/>
                                <rect x="80" y="100" width="12" height="12" fill="#1c1c1c" rx="1"/><rect x="100" y="100" width="12" height="12" fill="#1c1c1c" rx="1"/>
                                <rect x="120" y="80" width="12" height="12" fill="#1c1c1c" rx="1"/><rect x="120" y="100" width="12" height="12" fill="#1c1c1c" rx="1"/>
                                <rect x="80" y="120" width="12" height="12" fill="#1c1c1c" rx="1"/><rect x="100" y="120" width="12" height="12" fill="#1c1c1c" rx="1"/>
                                <!-- Right side -->
                                <rect x="150" y="80" width="8" height="8" fill="#1c1c1c"/><rect x="165" y="80" width="8" height="8" fill="#1c1c1c"/><rect x="180" y="80" width="8" height="8" fill="#1c1c1c"/>
                                <rect x="150" y="95" width="8" height="8" fill="#1c1c1c"/><rect x="180" y="95" width="8" height="8" fill="#1c1c1c"/>
                                <rect x="150" y="110" width="8" height="8" fill="#1c1c1c"/><rect x="165" y="110" width="8" height="8" fill="#1c1c1c"/><rect x="180" y="110" width="8" height="8" fill="#1c1c1c"/>
                                <!-- Bottom -->
                                <rect x="80" y="150" width="8" height="8" fill="#1c1c1c"/><rect x="95" y="150" width="8" height="8" fill="#1c1c1c"/><rect x="110" y="150" width="8" height="8" fill="#1c1c1c"/>
                                <rect x="80" y="165" width="8" height="8" fill="#1c1c1c"/><rect x="110" y="165" width="8" height="8" fill="#1c1c1c"/>
                                <rect x="80" y="180" width="8" height="8" fill="#1c1c1c"/><rect x="95" y="180" width="8" height="8" fill="#1c1c1c"/><rect x="110" y="180" width="8" height="8" fill="#1c1c1c"/>
                                <!-- Extra -->
                                <rect x="135" y="150" width="8" height="8" fill="#1c1c1c"/><rect x="150" y="150" width="8" height="8" fill="#1c1c1c"/>
                                <rect x="165" y="165" width="8" height="8" fill="#1c1c1c"/><rect x="180" y="150" width="8" height="8" fill="#1c1c1c"/>
                                <rect x="135" y="180" width="8" height="8" fill="#1c1c1c"/><rect x="180" y="180" width="8" height="8" fill="#1c1c1c"/>
                                <rect x="70" y="10" width="8" height="8" fill="#1c1c1c"/><rect x="70" y="25" width="8" height="8" fill="#1c1c1c"/>
                                <rect x="70" y="40" width="8" height="8" fill="#1c1c1c"/><rect x="70" y="55" width="8" height="8" fill="#1c1c1c"/>
                                <rect x="70" y="80" width="8" height="8" fill="#1c1c1c"/><rect x="70" y="95" width="8" height="8" fill="#1c1c1c"/>
                                <rect x="70" y="110" width="8" height="8" fill="#1c1c1c"/><rect x="70" y="135" width="8" height="8" fill="#1c1c1c"/>
                                <rect x="70" y="150" width="8" height="8" fill="#1c1c1c"/><rect x="70" y="165" width="8" height="8" fill="#1c1c1c"/>
                                <rect x="70" y="180" width="8" height="8" fill="#1c1c1c"/>
                            </svg>
                        </div>
                    </div>

                    {{-- Merchant info --}}
                    <div class="mt-4 space-y-0.5">
                        <p class="text-xs text-stone-500">Merchant</p>
                        <p class="font-bold text-stone-900">Opoan Coffee</p>
                        <p class="text-xs text-stone-400">NMID: ID2026080400001</p>
                    </div>

                    {{-- Timer --}}
                    <div class="mt-4 flex items-center justify-center gap-2">
                        <svg class="w-5 h-5 -rotate-90" viewBox="0 0 150 150">
                            <circle cx="75" cy="75" r="70" fill="none" stroke="#e7e5e4" stroke-width="10"/>
                            <circle id="timer-circle" cx="75" cy="75" r="70" fill="none"
                                    stroke="#d97706" stroke-width="10"
                                    stroke-dasharray="440"
                                    stroke-dashoffset="0"
                                    stroke-linecap="round"/>
                        </svg>
                        <p class="text-xs text-stone-500">QR berlaku <span id="countdown" class="font-bold text-amber-700">05:00</span></p>
                    </div>

                    <p class="text-[10px] text-stone-400 mt-2">Scan menggunakan aplikasi e-wallet apapun yang mendukung QRIS</p>
                </div>
            </div>
        @endif

        {{-- ── Ringkasan Pesanan ──────────────────────────────── --}}
        <div class="px-4 pt-4 space-y-3">
            <h2 class="font-bold text-stone-800 text-sm">Ringkasan Pesanan</h2>

            <div class="border border-stone-100 rounded-2xl overflow-hidden shadow-sm">
                {{-- Items --}}
                @foreach($pesanan->details as $item)
                <div class="px-4 py-3 {{ !$loop->last ? 'border-b border-stone-100' : '' }} flex justify-between items-start">
                    <div class="flex-1">
                        <p class="font-semibold text-sm text-stone-900">{{ $item->nama_menu }}</p>
                        @if($item->addOnSummary() !== '-')
                        <p class="text-[11px] text-stone-400 mt-0.5">{{ $item->addOnSummary() }}</p>
                        @endif
                        @if($item->catatan)
                        <p class="text-[11px] text-stone-400 italic">📝 {{ $item->catatan }}</p>
                        @endif
                        <p class="text-xs text-stone-500 mt-0.5">× {{ $item->qty }}</p>
                    </div>
                    <p class="font-bold text-sm text-stone-900 ml-3 shrink-0">
                        Rp{{ number_format($item->subtotal, 0, ',', '.') }}
                    </p>
                </div>
                @endforeach

                {{-- Breakdown harga --}}
                <div class="bg-stone-50 px-4 py-3 space-y-1.5">
                    <div class="flex justify-between text-xs text-stone-500">
                        <span>Subtotal</span>
                        <span class="font-medium text-stone-700">Rp{{ number_format($pesanan->subtotal, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between text-xs text-stone-500">
                        <span>PPN (10%)</span>
                        <span class="font-medium text-stone-700">Rp{{ number_format($pesanan->ppn, 0, ',', '.') }}</span>
                    </div>
                    @if($pesanan->diskon > 0)
                    <div class="flex justify-between text-xs text-emerald-600">
                        <span>Diskon {{ $pesanan->persen_diskon }}%</span>
                        <span class="font-semibold">- Rp{{ number_format($pesanan->diskon, 0, ',', '.') }}</span>
                    </div>
                    @endif
                    <div class="flex justify-between font-bold text-stone-900 text-sm border-t border-stone-200 pt-2 mt-1">
                        <span>Total Bayar</span>
                        <span class="text-amber-800">Rp{{ number_format($pesanan->total_akhir, 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>
        </div>

        {{-- ── Info Pemesan ──────────────────────────────────── --}}
        <div class="px-4 pt-3">
            <div class="bg-stone-50 border border-stone-100 rounded-2xl px-4 py-3 space-y-1.5">
                <p class="text-[10px] uppercase tracking-widest text-stone-400 font-semibold">Info Pemesan</p>
                <div class="flex justify-between text-xs">
                    <span class="text-stone-500">Nama</span>
                    <span class="font-semibold text-stone-800">{{ $pesanan->nama_pelanggan }}</span>
                </div>
                @if($pesanan->nomor_meja)
                <div class="flex justify-between text-xs">
                    <span class="text-stone-500">No. Meja</span>
                    <span class="font-semibold text-stone-800">{{ $pesanan->nomor_meja }}</span>
                </div>
                @endif
                @if($pesanan->nomor_hp)
                <div class="flex justify-between text-xs">
                    <span class="text-stone-500">No. HP</span>
                    <span class="font-semibold text-stone-800">{{ $pesanan->nomor_hp }}</span>
                </div>
                @endif
            </div>
        </div>

        {{-- ── Instruksi berdasarkan metode --}}
        <div class="px-4 pt-4">
            @if($pesanan->metode_bayar === 'cash')
            <div class="bg-stone-50 border border-stone-200 rounded-2xl p-4">
                <p class="text-xs font-bold text-stone-700 mb-2">📋 Langkah Selanjutnya:</p>
                <ol class="text-xs text-stone-600 space-y-1 list-decimal list-inside">
                    <li>Tunggu antrian pesananmu dipersiapkan</li>
                    <li>Datang ke kasir dengan menunjukkan kode pesanan</li>
                    <li>Lakukan pembayaran tunai sebesar <strong>Rp{{ number_format($pesanan->total_akhir, 0, ',', '.') }}</strong></li>
                    <li>Ambil pesananmu setelah kasir konfirmasi</li>
                </ol>
            </div>
            @else
            <div class="bg-amber-50 border border-amber-200 rounded-2xl p-4">
                <p class="text-xs font-bold text-amber-800 mb-2">📋 Cara Bayar:</p>
                <ol class="text-xs text-amber-700 space-y-1 list-decimal list-inside">
                    <li>Buka aplikasi e-wallet (GoPay, OVO, Dana, dll)</li>
                    <li>Pilih menu "Scan QR" atau "Bayar"</li>
                    <li>Arahkan kamera ke QR Code di atas</li>
                    <li>Konfirmasi jumlah: <strong>Rp{{ number_format($pesanan->total_akhir, 0, ',', '.') }}</strong></li>
                    <li>Tunjukkan bukti bayar ke kasir</li>
                </ol>
            </div>
            @endif
        </div>

        @if($pesanan->status === 'menunggu')
        <div id="simulasi-wrapper" class="px-4 pt-4">
            <div class="border border-dashed border-amber-400 bg-amber-50/50 rounded-2xl p-4 text-center">
                <p class="text-xs font-bold text-amber-800 mb-1">🛠️ Developer / Testing Mode</p>
                <p class="text-[11px] text-amber-700 mb-3">Klik tombol di bawah ini untuk mensimulasikan pembayaran QRIS berhasil tanpa scan asli.</p>
                <button type="button" onclick="simulasiPembayaran()" id="btn-simulasi"
                    class="w-full bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-bold py-2.5 px-4 rounded-xl transition active:scale-95">
                    Simulasikan Bayar Sukses
                </button>
            </div>
        </div>
        @endif

        {{-- ── Notifikasi Pembayaran Berhasil (Hidden by default) ── --}}
        <div id="notif-sukses" class="hidden mx-4 mt-4 bg-emerald-100 border border-emerald-300 text-emerald-800 rounded-2xl p-4 flex items-center gap-3 slide-up">
            <div class="text-2xl">🎉</div>
            <div>
                <p class="font-bold text-sm">Pembayaran Berhasil!</p>
                <p class="text-xs text-emerald-700">Pesanan Anda kini sedang diproses oleh Kasir.</p>
            </div>
        </div>

        {{-- ── Tombol Selesai / Kembali ke Menu ── --}}
        <div class="px-4 pt-4">
            <button onclick="selesaiPesanan()" 
                class="w-full bg-[#2c1d11] text-amber-50 py-3 rounded-xl font-bold hover:bg-[#3d2a1a] transition active:scale-95">
                ✓ Selesai — Kembali ke Menu
            </button>
        </div>

    </div>{{-- end flex-1 --}}
</div>

<script>
    const kodePesanan = "{{ $pesanan->kode_pesanan }}";
    let statusSekarang = "{{ $pesanan->status }}";

    // ── Countdown Timer 5 menit ──────────────────────────
    let totalSeconds = 300;
    const countdownEl = document.getElementById('countdown');

    const timer = setInterval(() => {
        totalSeconds--;
        if (totalSeconds <= 0) {
            clearInterval(timer);
            if(countdownEl) {
                countdownEl.textContent = 'Kedaluwarsa';
                countdownEl.classList.add('text-red-500');
            }
            return;
        }
        const m = String(Math.floor(totalSeconds / 60)).padStart(2, '0');
        const s = String(totalSeconds % 60).padStart(2, '0');
        if(countdownEl) {
            countdownEl.textContent = `${m}:${s}`;
        }
    }, 1000);

    // ── Bersihkan cart & kembali ke menu ────────────────
    function selesaiPesanan() {
        localStorage.removeItem('aura_cart');
        window.location.href = '/';
    }

    // ── Simulasi Bayar Sukses (AJAX POST) ────────────────
    function simulasiPembayaran() {
        const btn = document.getElementById('btn-simulasi');
        btn.disabled = true;
        btn.textContent = 'Memproses Simulasi...';

        fetch(`/pesanan/${kodePesanan}/simulasi-bayar`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Sembunyikan pembungkus simulasi
                const wrapper = document.getElementById('simulasi-wrapper');
                if(wrapper) wrapper.classList.add('hidden');
                
                // Tampilkan notifikasi sukses
                document.getElementById('notif-sukses').classList.remove('hidden');
                
                // Update badge status di atas secara instan
                updateBadge('diproses');
            } else {
                alert(data.message);
                btn.disabled = false;
                btn.textContent = 'Simulasikan Bayar Sukses';
            }
        })
        .catch(err => {
            console.error(err);
            alert('Gagal melakukan simulasi pembayaran.');
            btn.disabled = false;
            btn.textContent = 'Simulasikan Bayar Sukses';
        });
    }

    // ── Polling Status Pesanan (Mengecek status di database setiap 3 detik) ──
    const pollingInterval = setInterval(() => {
        // Hentikan polling jika status sudah selesai atau batal
        if (statusSekarang === 'selesai' || statusSekarang === 'dibatalkan') {
            clearInterval(pollingInterval);
            return;
        }

        fetch(`/pesanan/${kodePesanan}/status`)
        .then(res => res.json())
        .then(data => {
            if (data.status && data.status !== statusSekarang) {
                statusSekarang = data.status;
                updateBadge(statusSekarang);

                // Jika berubah dari menunggu ke diproses
                if (statusSekarang === 'diproses') {
                    const wrapper = document.getElementById('simulasi-wrapper');
                    if(wrapper) wrapper.classList.add('hidden');
                    document.getElementById('notif-sukses').classList.remove('hidden');
                }
            }
        })
        .catch(e => console.error('Gagal polling status:', e));
    }, 3000);

    // Helper untuk mengubah tampilan badge status di atas
    function updateBadge(status) {
        const badgeSpan = document.querySelector('span.rounded-full');
        if (!badgeSpan) return;

        badgeSpan.className = 'text-[10px] font-bold uppercase tracking-wider px-2.5 py-1 rounded-full ';
        
        if (status === 'menunggu') {
            badgeSpan.className += 'bg-amber-100 text-amber-700';
            badgeSpan.textContent = '⏳ Menunggu';
        } else if (status === 'diproses') {
            badgeSpan.className += 'bg-blue-100 text-blue-700';
            badgeSpan.textContent = '🔄 Diproses';
        } else if (status === 'selesai') {
            badgeSpan.className += 'bg-green-100 text-green-700';
            badgeSpan.textContent = '✅ Selesai';
        } else if (status === 'dibatalkan') {
            badgeSpan.className += 'bg-red-100 text-red-700';
            badgeSpan.textContent = '❌ Dibatalkan';
        }
    }
</script>

</body>
</html>
