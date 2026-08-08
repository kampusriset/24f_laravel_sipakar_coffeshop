<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran - Aura Coffee</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* ===== PEMBAYARAN DESKTOP LAYOUT ===== */
        @media (min-width: 768px) {
            #konfirmasi-overlay > div {
                border-radius: 1rem !important;
                max-width: 680px !important;
            }
        }
        @media (min-width: 1024px) {
            body { background-color: #f5f3ee; }

            #pmb-wrapper {
                max-width: 1100px;
                margin: 0 auto;
                min-height: 100vh;
                background: white;
                box-shadow: 0 0 60px rgba(0,0,0,0.08);
                display: flex;
                flex-direction: column;
            }

            #pmb-body {
                display: grid;
                grid-template-columns: 1fr 360px;
                gap: 0;
                flex: 1;
            }

            /* Kolom kiri: form data + metode bayar */
            #pmb-left {
                padding: 2rem;
                border-right: 1px solid #e7e5e4;
                overflow-y: auto;
            }

            /* Kolom kanan: ringkasan + tombol bayar */
            #pmb-right {
                position: sticky;
                top: 0;
                height: 100vh;
                overflow-y: auto;
                background: #faf9f6;
                display: flex;
                flex-direction: column;
            }

            /* Tombol bayar di kanan tidak sticky lagi */
            #pmb-right .sticky { position: static !important; }

            #konfirmasi-overlay > div {
                border-radius: 1rem !important;
                max-width: 700px !important;
            }
        }
    </style>
</head>

<body class="bg-stone-50 antialiased text-stone-800">

<div id="pmb-wrapper" class="max-w-screen-sm md:max-w-2xl lg:max-w-none mx-auto bg-white min-h-screen shadow-sm border border-stone-100 flex flex-col">

    <!-- Header -->
    <div class="p-4 border-b flex items-center bg-white sticky top-0 z-10">
        <button onclick="history.back()" class="mr-4 text-xl">
            ←
        </button>
        <h1 class="font-bold text-lg">
            Pembayaran
        </h1>
    </div>

    <!-- BODY: stack di mobile, 2-kolom di desktop -->
    <div id="pmb-body" class="flex flex-col lg:block flex-1">

        <!-- KOLOM KIRI / AREA ATAS: form data + metode -->
        <div id="pmb-left">
    <!-- Content -->
    <div class="flex-1 pb-28">

        <div class="p-4 space-y-5">

            <!-- Tipe Pesanan -->
            <div class="border border-[#C4854A] rounded-xl p-4 bg-[#C4854A]/10">
                <div class="flex justify-between items-center">
                    <div>
                        <p class="font-bold text-stone-900">
                            Makan di Tempat
                        </p>
                        <p class="text-xs text-stone-500">
                            Silakan isi data berikut
                        </p>
                    </div>

                    <div class="text-amber-900 text-xl">
                        ✓
                    </div>
                </div>
            </div>

            <!-- Data Pemesan -->
            <div class="border rounded-xl bg-white shadow-sm p-4 space-y-4">

                <h3 class="font-bold border-b pb-2">
                    Data Pemesan
                </h3>

                <div>
                    <label class="text-sm font-semibold">
                        Nama Lengkap
                    </label>

                    <input
                        type="text"
                        placeholder="Masukkan nama..."
                        class="mt-1 w-full border rounded-xl p-3 outline-none focus:border-amber-900">
                </div>

                <div>
                    <label class="text-sm font-semibold">
                        Nomor HP
                    </label>

                    <input
                        type="tel"
                        placeholder="08xxxxxxxxxx"
                        class="mt-1 w-full border rounded-xl p-3 outline-none focus:border-amber-900">
                </div>

                <div>
                    <label class="text-sm font-semibold">
                        Email
                    </label>

                    <input
                        type="email"
                        placeholder="email@gmail.com"
                        class="mt-1 w-full border rounded-xl p-3 outline-none focus:border-amber-900">
                </div>

                <div>
                    <label class="text-sm font-semibold">
                        Nomor Meja <span class="text-red-500">*</span>
                    </label>

                    <div class="mt-1 relative">
                        <span class="absolute left-3 top-1/2 -translate-y-1/2 text-stone-400">🪑</span>
                        <input
                            type="number"
                            placeholder="Contoh : 12"
                            class="w-full border rounded-xl p-3 pl-10 outline-none focus:border-amber-900 bg-stone-50">
                    </div>
                </div>

            </div>

        </div>

        <!-- Kamu pesan dari -->
        <div class="bg-stone-50 border-t border-b border-stone-100 px-4 py-4">
            <h3 class="font-bold text-stone-900">Kamu pesan dari</h3>
            <p class="text-sm text-stone-600 mt-0.5">Opoan Coffee</p>
        </div>

        <!-- Metode Pembayaran -->
        <div class="px-4 py-4 space-y-3">
            <h3 class="font-bold text-stone-900">Metode Pembayaran</h3>

            <div class="flex gap-3">
                <button id="btn-online" onclick="pilihMetode('online')"
                    class="flex-1 flex items-center gap-2 border-2 rounded-xl p-3 transition text-left">
                    <span class="text-2xl">💳</span>
                    <span class="text-sm font-semibold text-stone-800">Pembayaran Online</span>
                </button>

                <button id="btn-kasir" onclick="pilihMetode('kasir')"
                    class="flex-1 flex items-center gap-2 border-2 rounded-xl p-3 transition text-left">
                    <span class="text-2xl">💵</span>
                    <span class="text-sm font-semibold text-stone-800">Bayar di Kasir</span>
                </button>
            </div>
        </div>

        <!-- ===== Konten Metode: Pembayaran Online ===== -->
        <div id="section-online" class="hidden bg-stone-50 border-t border-stone-100 px-4 py-4 space-y-3">
            <h3 class="font-bold text-stone-900">Selesaikan Pembayaran</h3>

            <label class="flex items-center justify-between border rounded-xl p-3.5 bg-white cursor-pointer">
                <div class="flex items-center gap-3">
                    <span class="text-xl">⬜</span>
                    <span class="text-sm font-semibold text-stone-800">QRIS</span>
                </div>
                <input type="radio" name="metode_online" value="QRIS" checked class="w-4 h-4 text-amber-800 focus:ring-amber-800 border-stone-300">
            </label>
        </div>

        <!-- ===== Konten Metode: Bayar di Kasir ===== -->
        <div id="section-kasir" class="hidden bg-stone-50 border-t border-stone-100 px-4 py-8 flex flex-col items-center text-center">
            <div class="text-7xl mb-4">🧑‍💼</div>
            <p class="text-sm text-stone-600">
                Klik <span class="font-bold">'Bayar di Kasir'</span> lalu tunjukkan QR ke kasir.
            </p>
        </div>

        </div><!-- end section-kasir -->

        </div><!-- end pmb-left -->

        <!-- KOLOM KANAN / AREA BAWAH: bottom action bar -->
        <div id="pmb-right">
    <!-- Bottom: Promo, Total Pembayaran (collapsible), Tombol Bayar -->
    <div class="bg-white border-t sticky bottom-0 shadow-[0_-2px_10px_rgba(0,0,0,0.04)]">

        <!-- Promo -->
        <div class="px-4 pt-4">
            <button class="w-full flex justify-between items-center bg-[#C4854A]/10 border border-[#C4854A]/30 rounded-xl p-3.5">
                <div class="text-left">
                    <p class="font-bold text-amber-900 text-sm">
                        🎁 Promo / Voucher
                    </p>
                    <p class="text-xs text-stone-500">
                        Gunakan voucher jika tersedia
                    </p>
                </div>
                <span class="text-stone-400">
                    >
                </span>
            </button>
        </div>

        <!-- Rincian ringkasan pembayaran (collapsible, tersembunyi secara default) -->
        <div id="ringkasan-detail" class="hidden px-4 pt-4 space-y-2">
            <div class="flex justify-between text-sm text-stone-600">
                <span>Subtotal</span>
                <span id="subtotal-display" class="font-medium text-stone-900">Rp0</span>
            </div>
            <div class="flex justify-between text-sm text-stone-600">
                <span>PPN (10%)</span>
                <span id="ppn-display" class="font-medium text-stone-900">Rp0</span>
            </div>
        </div>

        <!-- Baris Total Pembayaran + Tombol Bayar -->
        <div class="p-4 flex items-center justify-between gap-3">

            <button onclick="toggleRingkasan()" class="text-left flex items-center gap-1.5 shrink-0">
                <div>
                    <p class="text-xs text-stone-500 flex items-center gap-1">
                        Total Pembayaran
                        <svg id="ringkasan-arrow" xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 text-stone-500 transition-transform" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 9l6 6 6-6" />
                        </svg>
                    </p>
                    <p id="final-total" class="text-lg font-bold text-stone-900">Rp0</p>
                </div>
            </button>

            <button
                onclick="showKonfirmasiPopup()"
                class="flex-1 max-w-[55%] bg-[#2c1d11] hover:bg-[#3d2a1a] text-amber-50 py-3.5 rounded-xl font-bold transition">
                Bayar Sekarang
            </button>

        </div>

    </div><!-- end sticky bottom -->
    </div><!-- end pmb-right -->
    </div><!-- end pmb-body -->
</div><!-- end pmb-wrapper -->

    <!-- ============ POPUP KONFIRMASI PEMBAYARAN ============ -->
    <div id="konfirmasi-overlay" class="hidden fixed inset-0 bg-black/60 z-50 flex items-end justify-center">
        <div class="w-full max-w-md bg-white rounded-t-3xl px-6 pt-8 pb-6 shadow-2xl">

            <!-- Ilustrasi -->
            <div class="flex justify-center mb-6">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 200" class="w-40 h-40">
                    <circle cx="100" cy="105" r="80" fill="#FDEBD3"/>
                    <ellipse cx="100" cy="170" rx="55" ry="10" fill="#DDEEDD" opacity="0.6"/>
                    <path d="M40 150 Q30 120 55 110 Q50 90 75 95 L75 150 Z" fill="#4CAF7D"/>
                    <path d="M160 150 Q170 115 145 105 Q150 85 120 92 L125 150 Z" fill="#4CAF7D"/>
                    <ellipse cx="100" cy="185" rx="70" ry="8" fill="#EDEDED"/>
                    <rect x="72" y="110" width="56" height="55" rx="8" fill="#4A6FA5"/>
                    <path d="M70 108 Q100 95 130 108 L130 118 Q100 105 70 118 Z" fill="#8FB4E3"/>
                    <circle cx="100" cy="70" r="28" fill="#F4B183"/>
                    <path d="M75 60 Q72 35 100 32 Q128 35 125 60 Q128 45 100 42 Q72 45 75 60 Z" fill="#7B3F1D"/>
                    <path d="M70 65 Q65 90 72 108 L80 105 Q75 85 78 65 Z" fill="#7B3F1D"/>
                    <path d="M130 65 Q135 90 128 108 L120 105 Q125 85 122 65 Z" fill="#7B3F1D"/>
                    <circle cx="90" cy="72" r="3" fill="#3D2A1A"/>
                    <circle cx="110" cy="72" r="3" fill="#3D2A1A"/>
                    <path d="M90 82 Q100 88 110 82" stroke="#3D2A1A" stroke-width="2" fill="none" stroke-linecap="round"/>
                    <rect x="60" y="120" width="30" height="35" rx="4" fill="#2c1d11"/>
                    <circle cx="145" cy="45" r="16" fill="white" stroke="#DDD" stroke-width="1.5"/>
                    <text x="145" y="52" font-size="18" font-weight="bold" text-anchor="middle" fill="#3D2A1A">?</text>
                    <path d="M133 55 L125 65 L138 60 Z" fill="white" stroke="#DDD" stroke-width="1"/>
                </svg>
            </div>

            <h3 class="text-center font-bold text-lg text-stone-900 mb-2">Proses pembayaran sekarang?</h3>
            <p class="text-center text-sm text-stone-500 mb-6">Pesananmu tidak bisa dibatalkan setelah pembayaran dilakukan</p>

            <div class="flex gap-3">
                <button onclick="hideKonfirmasiPopup()"
                    class="flex-1 border-2 border-orange-700 text-orange-700 font-bold py-3 rounded-xl hover:bg-orange-50 transition">
                    Cek Lagi
                </button>
                <button onclick="konfirmasiBayar()"
                    class="flex-1 bg-orange-700 hover:bg-orange-800 text-white font-bold py-3 rounded-xl transition">
                    Bayar Sekarang
                </button>
            </div>

        </div>
    </div>

<script>

const cart = JSON.parse(localStorage.getItem("aura_cart")) || [];

let subtotal = 0;

cart.forEach(item=>{

    subtotal += (parseInt(item.finalPrice)||0) * item.qty;

});

const ppn = subtotal * 0.10;

const total = subtotal + ppn;

document.getElementById("subtotal-display").innerHTML =
"Rp"+subtotal.toLocaleString("id-ID");

document.getElementById("ppn-display").innerHTML =
"Rp"+ppn.toLocaleString("id-ID");

document.getElementById("final-total").innerHTML =
"Rp"+total.toLocaleString("id-ID");

// ============ Popup Konfirmasi Bayar ============
function showKonfirmasiPopup() {
    document.getElementById('konfirmasi-overlay').classList.remove('hidden');
}

function hideKonfirmasiPopup() {
    document.getElementById('konfirmasi-overlay').classList.add('hidden');
}

function konfirmasiBayar() {
    window.location.href = '/pesanan';
}


function toggleRingkasan() {
    const detail = document.getElementById('ringkasan-detail');
    const arrow = document.getElementById('ringkasan-arrow');
    const isHidden = detail.classList.contains('hidden');

    if (isHidden) {
        detail.classList.remove('hidden');
        arrow.style.transform = 'rotate(180deg)';
    } else {
        detail.classList.add('hidden');
        arrow.style.transform = 'rotate(0deg)';
    }
}

// ============ Pilih metode pembayaran: Online / Kasir ============
let metodeTerpilih = null;

function pilihMetode(metode) {
    metodeTerpilih = metode;

    const btnOnline = document.getElementById('btn-online');
    const btnKasir = document.getElementById('btn-kasir');
    const sectionOnline = document.getElementById('section-online');
    const sectionKasir = document.getElementById('section-kasir');

    // Reset style kedua tombol dulu
    btnOnline.classList.remove('border-orange-700', 'bg-orange-50');
    btnOnline.classList.add('border-stone-200');
    btnKasir.classList.remove('border-orange-700', 'bg-orange-50');
    btnKasir.classList.add('border-stone-200');

    sectionOnline.classList.add('hidden');
    sectionKasir.classList.add('hidden');

    if (metode === 'online') {
        btnOnline.classList.remove('border-stone-200');
        btnOnline.classList.add('border-orange-700', 'bg-orange-50');
        sectionOnline.classList.remove('hidden');
    } else if (metode === 'kasir') {
        btnKasir.classList.remove('border-stone-200');
        btnKasir.classList.add('border-orange-700', 'bg-orange-50');
        sectionKasir.classList.remove('hidden');
    }
}

// Default: tombol belum terpilih saat halaman dibuka
document.getElementById('btn-online').classList.add('border-stone-200');
document.getElementById('btn-kasir').classList.add('border-stone-200');

</script>

</body>
</html>