<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Opoan Coffee</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        html { scroll-behavior: smooth; }
        body { background-color: #faf9f6; overflow-x: hidden; }
        .hide-scrollbar::-webkit-scrollbar { display: none; }
        .hide-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }

        #category-tabs-wrapper { position: relative; width: 100%; }
        #category-tabs { position: relative; }
        #category-tabs a {
            position: relative; display: inline-block;
            color: #78716c; transition: color 0.25s ease;
        }
        #category-tabs a.tab-active { color: #451a03; font-weight: 600; }
        #tab-indicator {
            position: absolute; bottom: 0; left: 0;
            height: 2px; width: 0; background-color: #451a03;
            transition: transform 0.3s cubic-bezier(0.4,0,0.2,1), width 0.3s cubic-bezier(0.4,0,0.2,1);
            pointer-events: none;
        }

        /* ====== DESKTOP SIDEBAR LAYOUT ====== */
        /* Di desktop, body menjadi layout 3-kolom */
        #desktop-layout {
            display: flex;
            align-items: flex-start;
            max-width: 1280px;
            margin: 0 auto;
        }

        /* Sidebar kiri: daftar kategori, sticky */
        #desktop-sidebar {
            display: none;
        }

        /* Sidebar kanan: cart preview, sticky */
        #desktop-cart-sidebar {
            display: none;
        }

        /* === TABLET (md) === */
        @media (min-width: 768px) {
            #floating-cart {
                max-width: 700px;
                left: 50%; transform: translateX(-50%);
                right: auto; border-radius: 1rem; bottom: 1.5rem;
            }
            #options-modal > div, #cart-modal > div,
            #search-overlay, #category-modal > div {
                border-radius: 1rem !important;
                max-width: 680px !important;
            }
            #search-overlay {
                left: 50%; transform: translateX(-50%);
                right: auto; width: 680px; max-width: 100vw;
            }
        }

        /* === DESKTOP (lg) === */
        @media (min-width: 1024px) {
            body { background-color: #f5f3ee; }

            /* Wrapper utama berubah jadi flex horizontal */
            #app-wrapper {
                max-width: 1280px;
                margin: 0 auto;
                display: flex;
                align-items: flex-start;
                gap: 0;
                min-height: 100vh;
                background: white;
                box-shadow: 0 0 60px rgba(0,0,0,0.08);
            }

            /* Sidebar kiri tampil */
            #desktop-sidebar {
                display: flex;
                flex-direction: column;
                width: 220px;
                flex-shrink: 0;
                position: sticky;
                top: 0;
                height: 100vh;
                overflow-y: auto;
                background: #1c1109;
                color: white;
                padding: 0;
                z-index: 20;
            }

            /* Kolom tengah (main) mengisi sisa */
            #main-col {
                flex: 1;
                min-width: 0;
                display: flex;
                flex-direction: column;
            }

            /* Sidebar kanan tampil */
            #desktop-cart-sidebar {
                display: flex;
                flex-direction: column;
                width: 300px;
                flex-shrink: 0;
                position: sticky;
                top: 0;
                height: 100vh;
                overflow-y: auto;
                background: #faf9f6;
                border-left: 1px solid #e7e5e4;
            }

            /* Floating cart hilang di desktop — digantikan sidebar */
            #floating-cart {
                display: none !important;
            }

            /* Modal overlay tetap terpusat */
            #options-modal > div, #cart-modal > div, #category-modal > div {
                border-radius: 1rem !important;
                max-width: 700px !important;
            }
            #search-overlay {
                max-width: 760px;
                left: 50%; transform: translateX(-50%);
                right: auto; width: 760px;
                border-radius: 0 0 1rem 1rem;
            }

            /* Tab kategori horizontal tetap ada di mobile-col, tapi di desktop
               navigasi sudah ada di sidebar — sembunyikan tab bar */
            #sticky-tabs-bar {
                display: none;
            }

            /* Header sedikit lebih besar di desktop */
            #main-header {
                border-bottom: 1px solid #e7e5e4;
            }
        }

        /* Styling khusus untuk desktop sidebar */
        .ds-logo {
            padding: 1.5rem 1.25rem 1rem;
            border-bottom: 1px solid rgba(255,255,255,0.08);
        }
        .ds-nav-link {
            display: block;
            padding: 0.65rem 1.25rem;
            font-size: 0.75rem;
            font-weight: 500;
            color: rgba(255,255,255,0.55);
            letter-spacing: 0.04em;
            text-decoration: none;
            border-left: 2px solid transparent;
            transition: all 0.2s;
        }
        .ds-nav-link:hover {
            color: rgba(255,255,255,0.9);
            background: rgba(255,255,255,0.05);
        }
        .ds-nav-link.active {
            color: #fbbf24;
            border-left-color: #d97706;
            background: rgba(251,191,36,0.07);
            font-weight: 600;
        }
        .ds-nav-section {
            padding: 1rem 1.25rem 0.4rem;
            font-size: 0.6rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.12em;
            color: rgba(255,255,255,0.25);
        }

        /* Styling sidebar cart kanan */
        #dc-cart-list { flex: 1; overflow-y: auto; }
        .dc-item {
            padding: 0.75rem 1rem;
            border-bottom: 1px solid #e7e5e4;
            font-size: 0.8rem;
        }
        .dc-item-name { font-weight: 600; color: #1c1917; }
        .dc-item-details { font-size: 0.68rem; color: #a8a29e; margin-top: 1px; }
        .dc-item-price { font-size: 0.78rem; font-weight: 700; color: #78350f; }
    </style>
</head>
<body class="antialiased text-stone-800">

    <!-- WRAPPER UTAMA — di desktop jadi flex 3 kolom -->
    <div id="app-wrapper" class="w-full mx-auto min-h-screen bg-white shadow-xl relative pb-32 lg:pb-0 flex flex-col lg:flex-row max-w-screen-sm md:max-w-2xl lg:max-w-none">

        <!-- ===== DESKTOP SIDEBAR KIRI (kategori navigasi) — hanya lg ===== -->
        <aside id="desktop-sidebar">
            <div class="ds-logo">
                <h1 class="text-base font-serif font-bold text-amber-100 tracking-tight">Opoan Coffee</h1>
                <p class="text-[10px] text-stone-400 mt-1">Open today · 10:00–00:00</p>
            </div>
            <div class="pt-3 pb-4 flex-1 overflow-y-auto hide-scrollbar">
                <p class="ds-nav-section">Menu</p>
                <a href="#signature" onclick="sidebarNav('signature')" class="ds-nav-link active" id="dsnav-signature">⭐ Signature</a>
                @foreach($kategoris as $kategori)
                <a href="#kategori-{{ $kategori->id_kategori }}"
                   onclick="sidebarNav('kategori-{{ $kategori->id_kategori }}')"
                   class="ds-nav-link"
                   id="dsnav-kategori-{{ $kategori->id_kategori }}">
                    {{ $kategori->nama_kategori }}
                </a>
                @endforeach
            </div>
            <div class="p-4 border-t border-white/10">
                @auth
                <div class="flex items-center gap-2 mb-3">
                    @if(auth()->user()->avatar)
                        <img src="{{ auth()->user()->avatar }}" class="w-8 h-8 rounded-full object-cover" alt="avatar">
                    @else
                        <div class="w-8 h-8 rounded-full bg-amber-800 flex items-center justify-center text-white text-xs font-bold">
                            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                        </div>
                    @endif
                    <div class="min-w-0">
                        <p class="text-xs font-semibold text-stone-200 truncate">{{ auth()->user()->name }}</p>
                        <p class="text-[10px] text-stone-500 truncate">{{ auth()->user()->email }}</p>
                    </div>
                </div>
                @if(auth()->user()->isAdmin() || auth()->user()->isKasir())
                <a href="/admin" class="ds-nav-link" style="border-radius:0.5rem;margin-bottom:0.25rem;">🛠 Admin Panel</a>
                @endif
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="ds-nav-link w-full text-left" style="color:#f87171;">← Sign Out</button>
                </form>
                @else
                <a href="{{ route('login') }}" class="ds-nav-link" style="border-radius:0.5rem;">Masuk</a>
                <a href="{{ route('register') }}" class="ds-nav-link" style="border-radius:0.5rem;color:#fbbf24;">+ Daftar</a>
                @endauth
            </div>
        </aside>

        <!-- ===== KOLOM TENGAH (main content) ===== -->
        <div id="main-col" class="flex flex-col flex-1 min-w-0">

        <!-- HEADER UTAMA -->
        <header id="main-header" class="p-5 border-b border-stone-100 bg-white sticky top-0 z-40">
            <div class="flex justify-between items-center mb-1">
                <h1 class="text-xl font-serif font-bold tracking-tight text-stone-900">Opoan Coffee</h1>

                <div class="flex items-center space-x-2">
                    <!-- Tombol Search -->
                    <button onclick="toggleSearch(true)" class="text-stone-700 p-1.5 hover:bg-stone-50 rounded-full transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
                    </button>

                    @auth
                        {{-- User sudah login: tampilkan avatar + dropdown --}}
                        <div class="relative" id="user-menu-wrapper">
                            <button onclick="toggleUserMenu()" class="flex items-center space-x-1.5 bg-stone-50 border border-stone-200 rounded-full pl-2 pr-3 py-1 hover:bg-stone-100 transition">
                                @if(auth()->user()->avatar)
                                    <img src="{{ auth()->user()->avatar }}" class="w-6 h-6 rounded-full object-cover" alt="avatar">
                                @else
                                    <div class="w-6 h-6 rounded-full bg-amber-800 flex items-center justify-center text-white text-[10px] font-bold">
                                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                                    </div>
                                @endif
                                <span class="text-xs font-semibold text-stone-800 max-w-[70px] truncate">{{ auth()->user()->name }}</span>
                            </button>

                            {{-- Dropdown menu --}}
                            <div id="user-dropdown" class="hidden absolute right-0 top-9 bg-white border border-stone-100 rounded-xl shadow-lg w-48 z-50 overflow-hidden">
                                <div class="px-4 py-3 border-b border-stone-100">
                                    <p class="text-xs text-stone-500">Signed in as</p>
                                    <p class="text-sm font-semibold text-stone-900 truncate">{{ auth()->user()->email }}</p>
                                    <span class="inline-block mt-1 text-[9px] font-bold uppercase tracking-wider px-2 py-0.5 rounded-full
                                        {{ auth()->user()->isAdmin() ? 'bg-red-100 text-red-700' : (auth()->user()->isKasir() ? 'bg-blue-100 text-blue-700' : 'bg-emerald-100 text-emerald-700') }}">
                                        {{ auth()->user()->role }}
                                    </span>
                                </div>
                                @if(auth()->user()->isAdmin() || auth()->user()->isKasir())
                                    <a href="/admin" class="flex items-center space-x-2 px-4 py-2.5 text-xs text-stone-700 hover:bg-stone-50 transition">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17V7m0 10a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2h2a2 2 0 012 2m0 10a2 2 0 002 2h2a2 2 0 002-2M9 7a2 2 0 012-2h2a2 2 0 012 2m0 10V7" /></svg>
                                        <span>Admin Panel</span>
                                    </a>
                                @endif
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="w-full flex items-center space-x-2 px-4 py-2.5 text-xs text-red-600 hover:bg-red-50 transition">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" /></svg>
                                        <span>Sign Out</span>
                                    </button>
                                </form>
                            </div>
                        </div>
                    @else
                        {{-- Guest: tampilkan tombol Masuk & Daftar --}}
                        <div class="flex items-center space-x-1">
                            <a href="{{ route('login') }}"
                               class="text-xs font-semibold text-stone-600 hover:text-stone-900 px-2 py-1 transition">
                                Masuk
                            </a>
                            <a href="{{ route('register') }}"
                               class="flex items-center space-x-1 bg-[#2c1d11] text-amber-50 text-xs font-semibold px-3 py-1.5 rounded-full hover:bg-[#3d2a1a] transition active:scale-95 shadow-sm">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" /></svg>
                                <span>Daftar</span>
                            </a>
                        </div>
                    @endauth
                </div>
            </div>
            <div class="flex items-center space-x-2 text-xs text-stone-500">
                <span class="w-1.5 h-1.5 rounded-full bg-emerald-600 inline-block"></span>
                <span>Open today, 10:00 - 00:00</span>
            </div>
        </header>

        <!-- KATEGORI TABS STICKY NAVIGATION (hanya mobile/tablet) -->
        <div id="sticky-tabs-bar" class="px-5 py-3.5 sticky top-[69px] bg-white z-30 border-b border-stone-100 flex items-center space-x-3">
            <button onclick="toggleCategoryModal(true)" class="bg-[#2c1d11] text-amber-50 text-xs font-semibold tracking-wide px-3.5 py-2 rounded-lg flex items-center space-x-1 shrink-0 transition hover:bg-[#3d2a1a]">
                <span>MENU</span>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>
            </button>

            <div id="category-tabs-wrapper" class="overflow-x-auto hide-scrollbar w-full">
                <div id="category-tabs" class="flex space-x-5 text-xs font-medium py-1 whitespace-nowrap tracking-wide">
                    <a href="#signature" data-tab="signature" class="tab-active pb-1">Signature</a>
                    @foreach($kategoris as $kategori)
                    <a href="#kategori-{{ $kategori->id_kategori }}" data-tab="kategori-{{ $kategori->id_kategori }}" class="pb-1">{{ $kategori->nama_kategori }}</a>
                    @endforeach
                    <span id="tab-indicator"></span>
                </div>
            </div>
        </div>

        <!-- AREA KONTEN DAFTAR MENU -->
        <main class="flex-1 bg-white">

            <!-- PROMO BANNER -->
            @if(isset($promos) && $promos->count() > 0)
            <div id="promo-banner" class="px-5 pt-5 mb-2 scroll-mt-36">
                <!-- Promo banner container with horizontal scroll or grid -->
                <div class="flex overflow-x-auto hide-scrollbar space-x-4 pb-4">
                    @foreach($promos as $promo)
                    <div class="min-w-[320px] sm:min-w-[360px] bg-gradient-to-r from-amber-600 to-amber-800 rounded-2xl p-5 text-white shadow-lg relative overflow-hidden shrink-0">
                        <!-- Decorative bg -->
                        <div class="absolute -right-6 -top-6 w-24 h-24 bg-white/20 rounded-full blur-xl"></div>
                        <div class="relative z-10 flex flex-col h-full justify-between">
                            <div>
                                <span class="bg-white/20 text-white text-[10px] font-bold tracking-widest uppercase px-2 py-1 rounded inline-block mb-3">
                                    Spesial Promo @if($promo->diskon_persen > 0) Diskon {{ $promo->diskon_persen }}% @endif
                                </span>
                                <h3 class="text-xl font-bold font-serif mb-1">{{ $promo->judul }}</h3>
                                <p class="text-xs text-amber-100/90 leading-relaxed max-w-[95%]">{{ $promo->deskripsi }}</p>
                            </div>
                            <div class="mt-4 pt-4 border-t border-white/20">
                                @if($promo->menus->count() > 0)
                                <p class="text-[10px] font-semibold uppercase tracking-wider text-amber-200 mb-2">Berlaku untuk Menu:</p>
                                <div class="flex flex-col gap-2">
                                    @foreach($promo->menus->take(3) as $m)
                                    @php
                                        $hargaNormal = $m->harga;
                                        $hargaDiskon = $hargaNormal - ($hargaNormal * ($promo->diskon_persen / 100));
                                    @endphp
                                    <div class="flex justify-between items-center bg-white/10 px-3 py-1.5 rounded-lg border border-white/20">
                                        <span class="text-xs font-bold">{{ $m->nama_menu }}</span>
                                        <div class="text-right">
                                            @if($promo->diskon_persen > 0)
                                            <span class="text-[9px] line-through text-amber-200/70 mr-1">Rp{{ number_format($hargaNormal, 0, ',', '.') }}</span>
                                            @endif
                                            <span class="text-xs font-bold text-amber-50">Rp{{ number_format($hargaDiskon, 0, ',', '.') }}</span>
                                        </div>
                                    </div>
                                    @endforeach
                                    @if($promo->menus->count() > 3)
                                    <span class="text-[10px] text-center text-amber-200/90 mt-1 cursor-pointer">+ {{ $promo->menus->count() - 3 }} Menu Lainnya</span>
                                    @endif
                                </div>
                                @else
                                <p class="text-[10px] text-amber-100">Cek info lengkap di kasir</p>
                                @endif
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif

            <!-- BEST SELLER HARI INI -->
            @if($bestSellerMenu)
            @php
                $bsPromo = $bestSellerMenu->promos->first();
                $bsHargaFinal = $bestSellerMenu->harga;
                if ($bsPromo && $bsPromo->diskon_persen > 0) {
                    $bsHargaFinal = $bestSellerMenu->harga - ($bestSellerMenu->harga * ($bsPromo->diskon_persen / 100));
                }
            @endphp
            <div id="signature" class="px-5 pt-5 mb-6 menu-item scroll-mt-36"
                 data-id="{{ $bestSellerMenu->id_menu }}"
                 data-nama="{{ $bestSellerMenu->nama_menu }}"
                 data-harga="{{ $bsHargaFinal }}"
                 data-tipe="{{ $bestSellerMenu->tipe ?? 'drink' }}"
                 data-kategori="{{ $bestSellerMenu->kategori->nama_kategori ?? '' }}">
                <div class="bg-gradient-to-r from-stone-950 via-[#2c1d11] to-stone-900 rounded-2xl p-5 text-white shadow-xl relative overflow-hidden border border-amber-950/40">
                    <div class="absolute -right-8 -top-8 w-28 h-28 bg-amber-500/10 rounded-full blur-2xl"></div>

                    <div class="flex items-center justify-between mb-4">
                        <div class="flex items-center space-x-1.5 bg-amber-400/10 text-amber-400 text-[10px] font-semibold tracking-widest uppercase px-2.5 py-1 rounded-md border border-amber-400/20">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2l2.4 7.4H22l-6.2 4.5 2.4 7.4L12 17l-6.2 4.3 2.4-7.4L2 9.4h7.6z"/></svg>
                            <span>Best Seller Hari Ini</span>
                        </div>
                        @if($bestSellerMenu->total_terjual > 0)
                            <span class="text-[10px] text-amber-300/70 tracking-wide font-light">{{ $bestSellerMenu->total_terjual }}x terjual hari ini</span>
                        @else
                            <span class="text-[10px] text-stone-400 tracking-wide font-light">Menu Unggulan</span>
                        @endif
                    </div>

                    <div class="flex items-start justify-between space-x-4">
                        <div class="flex-1">
                            <h3 class="text-base font-serif font-bold text-amber-100 tracking-wide">{{ $bestSellerMenu->nama_menu }}</h3>
                            <p class="text-xs text-stone-300 mt-1.5 leading-relaxed font-light">
                                Menu favorit pelanggan hari ini dari kategori {{ $bestSellerMenu->kategori->nama_kategori ?? 'kami' }}.
                            </p>
                            <div class="mt-4 flex items-center space-x-2.5">
                                @if($bsPromo && $bsPromo->diskon_persen > 0)
                                    <span class="text-xs font-bold text-stone-400 line-through mr-1">Rp{{ number_format($bestSellerMenu->harga, 0, ',', '.') }}</span>
                                @endif
                                <span class="text-base font-bold text-amber-400">Rp{{ number_format($bsHargaFinal, 0, ',', '.') }}</span>
                                @if($bestSellerMenu->total_terjual > 0)
                                    <span class="text-[9px] text-stone-400 bg-stone-900/60 px-2 py-0.5 rounded border border-stone-800 font-mono">🔥 {{ $bestSellerMenu->total_terjual }} sold today</span>
                                @endif
                            </div>
                        </div>

                        <div class="w-20 flex flex-col items-center space-y-2.5 shrink-0">
                            <div class="w-20 h-20 bg-stone-900 rounded-xl border border-stone-800 overflow-hidden relative">
                                @if($bestSellerMenu->gambar)
                                    <img src="{{ asset('menu-image/' . $bestSellerMenu->gambar) }}" alt="{{ $bestSellerMenu->nama_menu }}" class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full flex items-center justify-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-stone-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0114 0z"/></svg>
                                    </div>
                                @endif
                            </div>
                            <div class="w-full">
                                @if($bestSellerMenu->isTersedia())
                                    <button class="w-full bg-amber-800 hover:bg-amber-900 text-amber-50 text-xs font-semibold py-1.5 rounded-lg transition shadow-md" onclick="handleAddClick('{{ $bestSellerMenu->id_menu }}')">Add</button>
                                @else
                                    <button disabled class="w-full bg-stone-700 text-stone-400 text-xs font-semibold py-1.5 rounded-lg cursor-not-allowed">Stok Habis</button>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif

            <!-- DAFTAR MENU DINAMIS -->
            @foreach($kategoris as $kategori)
            <section id="kategori-{{ $kategori->id_kategori }}" class="px-5 py-6 scroll-mt-36">
                <h2 class="text-[10px] font-bold uppercase tracking-widest text-stone-400 mb-4">{{ $kategori->nama_kategori }}</h2>
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">

                    @foreach($kategori->menus as $menu)
                    @php 
                        $isAvailable = $menu->isTersedia(); 
                        $activePromo = $menu->promos->first();
                        $hargaFinal = $menu->harga;
                        if ($activePromo && $activePromo->diskon_persen > 0) {
                            $hargaFinal = $menu->harga - ($menu->harga * ($activePromo->diskon_persen / 100));
                        }
                    @endphp
                    <div class="bg-stone-50/60 rounded-2xl p-3.5 border border-stone-100 flex flex-col justify-between menu-item {{ !$isAvailable ? 'opacity-70' : '' }}"
                         data-id="{{ $menu->id_menu }}"
                         data-nama="{{ $menu->nama_menu }}"
                         data-harga="{{ $hargaFinal }}"
                         data-tipe="{{ $menu->tipe }}"
                         data-kategori="{{ $kategori->nama_kategori }}">
                        <div>
                            <!-- Dengan pemanggilan Storage::url -->
                            <div class="w-full aspect-square bg-stone-100 border border-stone-200/60 rounded-xl overflow-hidden mb-3 flex items-center justify-center relative">
                                @if($menu->gambar)
                                    @if(file_exists(public_path('menu-image/' . $menu->gambar)))
                                        <img src="{{ asset('menu-image/' . $menu->gambar) }}" alt="{{ $menu->nama_menu }}" class="w-full h-full object-cover">
                                    @else
                                        <img src="{{ Storage::url($menu->gambar) }}" alt="{{ $menu->nama_menu }}" class="w-full h-full object-cover">
                                    @endif
                                @else
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-stone-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0114 0z" /></svg>
                                @endif
                                @if(!$isAvailable)
                                    <span class="absolute top-2 left-2 bg-red-600/90 text-white text-[9px] font-bold px-2 py-0.5 rounded shadow">Stok Habis</span>
                                @endif
                            </div>
                              <h3 class="text-sm font-semibold text-stone-900 tracking-wide">{{ $menu->nama_menu }}</h3>
                            <p class="text-[11px] text-stone-500 line-clamp-2 mt-1 leading-relaxed font-light">{{ $menu->deskripsi }}</p>
                        </div>
                        <div class="mt-4">
                            @if($activePromo && $activePromo->diskon_persen > 0)
                                <span class="text-xs font-bold text-stone-400 line-through block mb-1">Rp{{ number_format($menu->harga, 0, ',', '.') }}</span>
                            @endif
                            <span class="text-sm font-bold text-amber-700 block mb-2.5">Rp{{ number_format($hargaFinal, 0, ',', '.') }}</span>
                            @if($isAvailable)
                                <button class="w-full border border-amber-800 text-amber-800 hover:bg-amber-800 hover:text-white text-xs font-semibold py-1.5 rounded-lg transition" onclick="handleAddClick('{{ $menu->id_menu }}')">Add</button>
                            @else
                                <button disabled class="w-full border border-stone-200 bg-stone-100 text-stone-400 cursor-not-allowed text-xs font-semibold py-1.5 rounded-lg">Stok Habis</button>
                            @endif
                        </div>
                    </div>
                    @endforeach

                </div>
            </section>
            @endforeach

        </main>
        </div><!-- end #main-col -->

        <!-- FLOATING BOTTOM CHECKOUT BAR (mobile/tablet only) -->
        <div id="floating-cart" class="hidden fixed bottom-0 left-0 right-0 bg-[#2c1d11] text-amber-50 p-4 justify-between items-center shadow-2xl z-40 rounded-t-2xl border-t border-amber-900/20 transition-transform">
            <div class="flex items-center space-x-3.5">
                <div class="relative bg-amber-950 text-amber-400 p-2.5 rounded-xl border border-amber-900/40 cursor-pointer" onclick="toggleCartModal(true)">
    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" /></svg>
    <span id="cart-badge" class="absolute -top-1.5 -right-1.5 bg-amber-600 text-amber-50 text-[9px] font-bold rounded-full px-1.5 py-0.5 border border-[#2c1d11]">0</span>
</div>
                <div>
                    <div class="text-[9px] uppercase tracking-widest opacity-60 font-medium">Subtotal Estimate</div>
                    <div id="cart-total" class="font-bold text-base tracking-wide text-amber-100">Rp0</div>
                </div>
            </div>
            <button onclick="window.location.href='/review-order'" class="bg-amber-800 hover:bg-amber-700 text-amber-50 px-4 py-2.5 rounded-xl text-xs font-semibold tracking-wider uppercase transition active:scale-95 shadow-sm">
                Review Order (<span id="checkout-count">0</span>)
            </button>
        </div>

        <!-- ===== DESKTOP CART SIDEBAR KANAN — hanya lg ===== -->
        <aside id="desktop-cart-sidebar">
            <div class="p-4 border-b border-stone-200 bg-white sticky top-0">
                <h2 class="font-bold text-sm text-stone-900">Pesanan Anda</h2>
                <p class="text-[10px] text-stone-400 mt-0.5">Item yang dipilih</p>
            </div>
            <div id="dc-cart-list" class="flex-1 overflow-y-auto hide-scrollbar">
                <div id="dc-empty" class="flex flex-col items-center justify-center h-48 text-center px-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-stone-200 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
                    <p class="text-xs text-stone-400">Keranjang masih kosong</p>
                </div>
                <div id="dc-items"></div>
            </div>
            <div class="p-4 border-t border-stone-200 bg-white">
                <div class="flex justify-between text-xs text-stone-500 mb-1">
                    <span>Subtotal</span>
                    <span id="dc-subtotal" class="font-semibold text-stone-800">Rp0</span>
                </div>
                <div class="flex justify-between text-xs text-stone-500 mb-3">
                    <span>PPN (10%)</span>
                    <span id="dc-ppn" class="font-semibold text-stone-800">Rp0</span>
                </div>
                <div class="flex justify-between font-bold text-stone-900 text-sm border-t pt-2 mb-4">
                    <span>Total</span>
                    <span id="dc-total" class="text-amber-900">Rp0</span>
                </div>
                <button onclick="window.location.href='/review-order'" id="dc-checkout-btn"
                    class="w-full bg-[#2c1d11] hover:bg-[#3d2a1a] text-amber-50 py-3 rounded-xl text-xs font-bold tracking-wider uppercase transition shadow-md disabled:opacity-40 disabled:cursor-not-allowed">
                    Review Order (<span id="dc-count">0</span> item)
                </button>
            </div>
        </aside>

        <!-- DYNAMIC CUSTOMIZATION OPTIONS BOTTOM SHEET (CUSTOMIZE DRINK/FOOD) -->
        <div id="options-modal" class="hidden fixed inset-0 bg-black/60 z-50 flex items-end justify-center p-0 animate-fade-in">
            <!-- Modal Box Container -->
            <div class="w-full max-w-md bg-white rounded-t-2xl max-h-[85%] flex flex-col overflow-hidden shadow-2xl transition-transform translate-y-0">

                <!-- Sticky Header Detail Item -->
                <div class="p-5 border-b border-stone-100 bg-white sticky top-0 flex justify-between items-start">
                    <div class="pr-6">
                        <h3 id="opt-item-name" class="text-lg font-serif font-bold text-stone-900 tracking-wide">Nama Item</h3>
                        <div id="opt-item-price" class="text-sm font-semibold text-amber-900 mt-0.5">Rp0</div>
                        <p id="opt-item-desc" class="text-xs text-stone-400 mt-2 font-light leading-relaxed">Deskripsi produk singkat otomatis masuk di sini.</p>
                    </div>
                    <button onclick="closeOptionsModal()" class="text-stone-400 hover:text-stone-700 p-1 bg-stone-50 rounded-full transition shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                    </button>
                </div>

                <!-- Scrollable Custom Options Area -->
                <div class="overflow-y-auto p-5 space-y-6 flex-1 bg-stone-50/50">

                    <!-- 1. TEMPERATURE (Ice / Hot) -->
                    <div id="temp-group" class="bg-white rounded-xl p-4 border border-stone-100 shadow-xs">
                        <div class="flex justify-between items-center mb-3">
                            <h4 class="text-xs font-bold uppercase tracking-wider text-stone-900">Temperature</h4>
                            <span class="text-[10px] font-semibold text-amber-800 bg-amber-50 px-2 py-0.5 rounded">Must be selected max. 1</span>
                        </div>
                        <div class="space-y-3 text-sm">
                            <label class="flex items-center justify-between cursor-pointer py-1">
                                <span class="text-stone-700 font-medium">Ice</span>
                                <input type="radio" name="temp_opt" value="Ice" checked data-price="0" onchange="calculateModalTotal()" class="w-4 h-4 text-amber-800 focus:ring-amber-800 border-stone-300">
                            </label>
                            <label class="flex items-center justify-between cursor-pointer py-1">
                                <span class="text-stone-700 font-medium">Hot</span>
                                <input type="radio" name="temp_opt" value="Hot" data-price="0" onchange="calculateModalTotal()" class="w-4 h-4 text-amber-800 focus:ring-amber-800 border-stone-300">
                            </label>
                        </div>
                    </div>

                    <!-- 2. SUGAR LEVEL (No sugar, Less sugar, Normal sugar) -->
                    <div id="sugar-group" class="bg-white rounded-xl p-4 border border-stone-100 shadow-xs">
                        <div class="flex justify-between items-center mb-3">
                            <h4 class="text-xs font-bold uppercase tracking-wider text-stone-900">Sugar Level</h4>
                            <span class="text-[10px] font-semibold text-amber-800 bg-amber-50 px-2 py-0.5 rounded">Must be selected max. 1</span>
                        </div>
                        <div class="space-y-3 text-sm">
                            <label class="flex items-center justify-between cursor-pointer py-1">
                                <span class="text-stone-700 font-medium">No Sugar</span>
                                <input type="radio" name="sugar_opt" value="No Sugar" data-price="0" onchange="calculateModalTotal()" class="w-4 h-4 text-amber-800 focus:ring-amber-800 border-stone-300">
                            </label>
                            <label class="flex items-center justify-between cursor-pointer py-1">
                                <span class="text-stone-700 font-medium">Less Sugar</span>
                                <input type="radio" name="sugar_opt" value="Less Sugar" data-price="0" onchange="calculateModalTotal()" class="w-4 h-4 text-amber-800 focus:ring-amber-800 border-stone-300">
                            </label>
                            <label class="flex items-center justify-between cursor-pointer py-1">
                                <span class="text-stone-700 font-medium">Normal Sugar</span>
                                <input type="radio" name="sugar_opt" value="Normal Sugar" checked data-price="0" onchange="calculateModalTotal()" class="w-4 h-4 text-amber-800 focus:ring-amber-800 border-stone-300">
                            </label>
                        </div>
                    </div>

                    <!-- 3. SIZE (Reguler, Large, Extra Large) -->
                    <div id="size-group" class="bg-white rounded-xl p-4 border border-stone-100 shadow-xs">
                        <div class="flex justify-between items-center mb-3">
                            <h4 class="text-xs font-bold uppercase tracking-wider text-stone-900">Cup Size</h4>
                            <span class="text-[10px] font-semibold text-amber-800 bg-amber-50 px-2 py-0.5 rounded">Must be selected max. 1</span>
                        </div>
                        <div class="space-y-3 text-sm">
                            <label class="flex items-center justify-between cursor-pointer py-1">
                                <span class="text-stone-700 font-medium">Reguler</span>
                                <input type="radio" name="size_opt" value="Reguler" checked data-price="0" onchange="calculateModalTotal()" class="w-4 h-4 text-amber-800 focus:ring-amber-800 border-stone-300">
                            </label>
                            <label class="flex items-center justify-between cursor-pointer py-1">
                                <span class="text-stone-700 font-medium">Large <span class="text-xs text-amber-800 font-semibold">(+Rp4.000)</span></span>
                                <input type="radio" name="size_opt" value="Large" data-price="4000" onchange="calculateModalTotal()" class="w-4 h-4 text-amber-800 focus:ring-amber-800 border-stone-300">
                            </label>
                            <label class="flex items-center justify-between cursor-pointer py-1">
                                <span class="text-stone-700 font-medium">Extra Large <span class="text-xs text-amber-800 font-semibold">(+Rp8.000)</span></span>
                                <input type="radio" name="size_opt" value="Extra Large" data-price="8000" onchange="calculateModalTotal()" class="w-4 h-4 text-amber-800 focus:ring-amber-800 border-stone-300">
                            </label>
                        </div>
                    </div>



                    <!-- CATATAN TAMBAHAN -->
                    <div class="bg-white rounded-xl p-4 border border-stone-100 shadow-xs">
                        <h4 class="text-xs font-bold uppercase tracking-wider text-stone-900 mb-2">Notes</h4>
                        <textarea id="opt-item-notes" rows="2" placeholder="Contoh: Es sedikit aja ya, atau pisah saus..." class="w-full bg-stone-50 border border-stone-200 rounded-lg p-2.5 text-xs focus:outline-hidden focus:ring-1 focus:ring-stone-400 focus:bg-white transition"></textarea>
                    </div>
                </div>

                <!-- Sticky Bottom Action Bar Di Dalam Modal -->
                <div class="p-4 border-t border-stone-100 bg-white sticky bottom-0 flex flex-col space-y-3 shadow-md">
                    <div class="flex justify-between items-center px-1">
                        <div>
                            <span class="text-[10px] uppercase text-stone-400 tracking-wider">Total Order</span>
                            <div id="modal-total-display" class="text-base font-bold text-stone-900">Rp0</div>
                        </div>
                        <!-- Kounter Quantity -->
                        <div class="flex items-center bg-stone-100 border border-stone-200 rounded-xl p-1 font-semibold text-stone-900 text-sm">
                            <button onclick="changeModalQty(-1)" class="w-8 h-7 flex items-center justify-center font-bold text-stone-600 hover:text-stone-900 transition">-</button>
                            <span id="modal-qty-count" class="px-3 font-bold">1</span>
                            <button onclick="changeModalQty(1)" class="w-8 h-7 flex items-center justify-center font-bold text-stone-600 hover:text-stone-900 transition">+</button>
                        </div>
                    </div>

                    <!-- Main Submit Button -->
                    <button id="modal-submit-btn" onclick="submitToCart()" class="w-full bg-[#2c1d11] hover:bg-[#3d2a1a] text-amber-50 py-3 rounded-xl text-xs font-bold tracking-wider uppercase transition shadow-md active:scale-[0.99]">
                        Add Orders - Rp0
                    </button>
                </div>

            </div>
        </div>
        <div id="cart-modal" class="hidden fixed inset-0 bg-black/60 z-50 flex items-end justify-center animate-fade-in">
    <div class="w-full max-w-md bg-white rounded-t-2xl max-h-[85%] flex flex-col shadow-2xl">
        <div class="p-5 border-b border-stone-100 flex justify-between items-center">
            <h3 class="font-bold text-lg">Your Cart</h3>
            <button onclick="toggleCartModal(false)" class="text-stone-400">Close</button>
        </div>
        <div id="cart-items-list" class="overflow-y-auto p-5 space-y-4 flex-1">
            </div>
        <div class="p-5 border-t border-stone-100 bg-stone-50">
            <button onclick="window.location.href='/review-order'" class="w-full bg-[#2c1d11] text-white py-3 rounded-xl font-bold">Checkout</button>
        </div>
    </div>
</div>
        <!-- SEARCH OVERLAY & MODAL KATEGORI -->
        <div id="search-overlay" class="hidden fixed inset-0 bg-white z-50 max-w-md mx-auto flex flex-col">
            <div class="p-4 flex items-center space-x-3 border-b border-stone-100">
                <button onclick="toggleSearch(false)" class="p-1 text-stone-500 hover:text-stone-900"><svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" /></svg></button>
                <div class="relative w-full">
                    <input id="search-input" type="text" placeholder="Search our creations..." autocomplete="off" oninput="handleSearchInput(this.value)" class="w-full bg-stone-50 border-none rounded-lg px-3 py-2 pr-8 text-sm focus:outline-hidden">
                    <button id="search-clear-btn" onclick="clearSearchInput()" class="hidden absolute right-2 top-1/2 -translate-y-1/2 text-stone-400 hover:text-stone-700">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                    </button>
                </div>
            </div>
            <div id="search-results" class="flex-1 overflow-y-auto px-4 py-2">
                <p id="search-empty-state" class="text-center text-xs text-stone-400 mt-10">Ketik nama menu, mis. "Kopi" atau "Croissant"...</p>
            </div>
        </div>
        <div id="category-modal" class="hidden fixed inset-0 bg-black/40 z-50 flex items-end justify-center p-0">
            <div class="w-full max-w-md bg-white rounded-t-2xl max-h-[65%] flex flex-col p-5 shadow-2xl">
                <div class="flex justify-between items-center pb-3.5 border-b border-stone-100">
                    <span class="text-xs font-bold uppercase tracking-widest text-stone-400">Select Collection</span>
                    <button onclick="toggleCategoryModal(false)" class="text-stone-400 hover:text-stone-700">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                    </button>
                </div>
                <div class="overflow-y-auto py-3 space-y-1.5 text-sm font-medium tracking-wide">
                    <a href="#signature" data-tab="signature" onclick="toggleCategoryModal(false)" class="modal-category-link block w-full text-left p-3.5 rounded-xl bg-stone-50 text-amber-950 font-semibold flex justify-between items-center">
                        <span>SIGNATURE BLEND</span>
                        <span class="w-1.5 h-1.5 rounded-full bg-amber-800"></span>
                    </a>
                    @foreach($kategoris as $kategori)
                    <a href="#kategori-{{ $kategori->id_kategori }}" data-tab="kategori-{{ $kategori->id_kategori }}" onclick="toggleCategoryModal(false)" class="modal-category-link block w-full text-left p-3.5 rounded-xl hover:bg-stone-50/80 text-stone-700 transition">{{ strtoupper($kategori->nama_kategori) }}</a>
                    @endforeach
                </div>
            </div>
        </div>

    </div>

    <!-- LOGIKA SKRIP OPERASIONAL KERANJANG & MODAL -->
    <!-- Satu-satunya sumber data cart: localStorage key 'aura_cart' -->
    <script>
        let activeItem = null;
        let currentModalQty = 1;

        // ============ HELPER: baca/tulis cart dari localStorage ============
        function getCart() {
            return JSON.parse(localStorage.getItem('aura_cart')) || [];
        }

        function saveCart(cartArr) {
            localStorage.setItem('aura_cart', JSON.stringify(cartArr));
        }

        // ============ Klasifikasi kategori menu ============
        // Kategori-kategori yang TIDAK memakai bottom sheet add-on sama sekali
        // (langsung masuk keranjang saat tombol "Add" ditekan).
        const NO_ADDON_KATEGORI = ['non kopi', 'non-kopi', 'minuman segar', 'pastry & dessert', 'pastry &amp; dessert', 'pastry', 'dessert', 'makanan berat'];

        // Kategori kopi panas: tampilkan bottom sheet, tapi TANPA grup Temperature
        const HOT_COFFEE_KATEGORI = ['kopi panas'];

        // Kategori es kopi: tampilkan bottom sheet, tapi TANPA grup Temperature
        const ICE_COFFEE_KATEGORI = ['es kopi'];

        function normalizeKategori(str) {
            return (str || '').toString().trim().toLowerCase();
        }

        function isNoAddonKategori(kategori) {
            const k = normalizeKategori(kategori);
            return NO_ADDON_KATEGORI.some(item => k.includes(item));
        }

        function isHotCoffeeKategori(kategori) {
            const k = normalizeKategori(kategori);
            return HOT_COFFEE_KATEGORI.some(item => k.includes(item));
        }

        function isIceCoffeeKategori(kategori) {
            const k = normalizeKategori(kategori);
            return ICE_COFFEE_KATEGORI.some(item => k.includes(item));
        }

        // ============ Router tombol "Add": tentukan langsung masuk keranjang atau buka modal ============
        function handleAddClick(id) {
            const menuElement = document.querySelector(`.menu-item[data-id="${id}"]`);
            if (!menuElement) {
                console.error('Menu item dengan id "' + id + '" tidak ditemukan.');
                return;
            }

            const kategori = menuElement.getAttribute('data-kategori') || '';

            if (isNoAddonKategori(kategori)) {
                addDirectlyToCart(id);
            } else {
                openOptionsModal(id);
            }
        }

        // ============ Langsung push ke keranjang tanpa bottom sheet add-on ============
        function addDirectlyToCart(id) {
            const menuElement = document.querySelector(`.menu-item[data-id="${id}"]`);
            if (!menuElement) return;

            const nama = menuElement.getAttribute('data-nama');
            const harga = parseInt(menuElement.getAttribute('data-harga')) || 0;
            const tipe = menuElement.getAttribute('data-tipe') || 'drink';
            const kategori = menuElement.getAttribute('data-kategori') || '';

            const currentCart = getCart();

            // Jika item yang sama (tanpa add-on) sudah ada di cart, tambah qty saja
            const existingIndex = currentCart.findIndex(item =>
                item.id === id && item.finalPrice === harga &&
                !item.temp && !item.sugar && !item.size && !item.milk &&
                (!item.toppings || item.toppings.length === 0)
            );

            if (existingIndex > -1) {
                currentCart[existingIndex].qty += 1;
            } else {
                currentCart.push({
                    id: id,
                    nama: nama,
                    baseHarga: harga,
                    finalPrice: harga,
                    qty: 1,
                    temp: null,
                    sugar: null,
                    size: null,
                    milk: null,
                    toppings: [],
                    notes: '',
                    kategori: kategori,
                    tipe: tipe
                });
            }

            saveCart(currentCart);
            updateMainCartUI();
        }

        // ============ Buka bottom sheet pilihan custom kopi/makanan ============
        function openOptionsModal(id) {
            const menuElement = document.querySelector(`.menu-item[data-id="${id}"]`);
            if (!menuElement) {
                console.error('Menu item dengan id "' + id + '" tidak ditemukan.');
                return;
            }

            const nama = menuElement.getAttribute('data-nama');
            const harga = parseInt(menuElement.getAttribute('data-harga')) || 0;
            const tipe = menuElement.getAttribute('data-tipe') || 'drink';
            const kategori = menuElement.getAttribute('data-kategori') || '';
            const deskripsiEl = menuElement.querySelector('p');
            const deskripsi = deskripsiEl ? deskripsiEl.innerText : '';

            activeItem = { id, nama, harga, tipe, kategori };
            currentModalQty = 1;

            // Masukkan data dasar ke modal UI
            document.getElementById('opt-item-name').innerText = nama;
            document.getElementById('opt-item-price').innerText = 'Rp' + harga.toLocaleString('id-ID');
            document.getElementById('opt-item-desc').innerText = deskripsi;
            document.getElementById('modal-qty-count').innerText = currentModalQty;
            document.getElementById('opt-item-notes').value = '';

            // PENTING: reset semua pilihan ke default setiap kali modal dibuka,
            // supaya pilihan add-on dari item sebelumnya tidak "nempel" ke item baru
            document.querySelector('input[name="temp_opt"][value="Ice"]').checked = true;
            document.querySelector('input[name="sugar_opt"][value="Normal Sugar"]').checked = true;
            document.querySelector('input[name="size_opt"][value="Reguler"]').checked = true;

            // Tampilkan/sembunyikan opsi kustomisasi berdasarkan tipe produk
            const groups = ['temp-group', 'sugar-group', 'size-group'];
            groups.forEach(gid => {
                const el = document.getElementById(gid);
                if (el) {
                    el.style.display = (tipe === 'food') ? 'none' : 'block';
                }
            });

            // Untuk kategori "Kopi Panas" dan "Es Kopi": sembunyikan grup Temperature saja,
            // add-on lain (Sugar, Size) tetap tampil seperti biasa.
            if (isHotCoffeeKategori(kategori) || isIceCoffeeKategori(kategori)) {
                const tempEl = document.getElementById('temp-group');
                if (tempEl) tempEl.style.display = 'none';
            }

            calculateModalTotal();
            document.getElementById('options-modal').style.display = 'flex';
        }

        function closeOptionsModal() {
            document.getElementById('options-modal').style.display = 'none';
            activeItem = null;
        }

        // ============ Hitung total harga real-time di dalam modal ============
        function calculateModalTotal() {
            if (!activeItem) return;

            let baseHarga = parseInt(activeItem.harga) || 0;
            let tambahanHarga = 0;

            document.querySelectorAll('#options-modal input:checked').forEach(input => {
                tambahanHarga += parseInt(input.getAttribute('data-price')) || 0;
            });

            let totalPerItem = baseHarga + tambahanHarga;
            let finalTotal = totalPerItem * currentModalQty;

            document.getElementById('modal-total-display').innerText = 'Rp' + finalTotal.toLocaleString('id-ID');
            document.getElementById('modal-submit-btn').innerText = 'Add Orders - Rp' + finalTotal.toLocaleString('id-ID');
        }

        function changeModalQty(delta) {
            currentModalQty = Math.max(1, currentModalQty + delta);
            document.getElementById('modal-qty-count').innerText = currentModalQty;
            calculateModalTotal();
        }

        // ============ Push hasil pilihan custom ke keranjang (localStorage) ============
        function submitToCart() {
            if (!activeItem) return;

            let selectedTemp = null;
            let selectedSugar = null;
            let selectedSize = null;
            let selectedMilk = null;
            let selectedToppings = [];
            let tambahanHarga = 0;

            if (activeItem.tipe === 'drink') {
                // Temperature hanya diambil kalau grupnya sedang ditampilkan
                // (disembunyikan untuk kategori "Kopi Panas" & "Es Kopi" karena sudah pasti)
                const tempGroupVisible = document.getElementById('temp-group').style.display !== 'none';
                selectedTemp = tempGroupVisible
                    ? (document.querySelector('input[name="temp_opt"]:checked')?.value || null)
                    : null;
                selectedSugar = document.querySelector('input[name="sugar_opt"]:checked')?.value || null;

                const sizeEl = document.querySelector('input[name="size_opt"]:checked');
                if (sizeEl) {
                    selectedSize = sizeEl.value;
                    tambahanHarga += parseInt(sizeEl.getAttribute('data-price')) || 0;
                }
            }

            const notes = document.getElementById('opt-item-notes').value;
            const finalPricePerItem = (parseInt(activeItem.harga) || 0) + tambahanHarga;

            // Ambil cart terbaru dari localStorage (bukan variabel in-memory yang bisa basi)
            const currentCart = getCart();

            currentCart.push({
                id: activeItem.id,
                nama: activeItem.nama,
                baseHarga: activeItem.harga,
                finalPrice: finalPricePerItem, // harga per item SUDAH termasuk semua add-on
                qty: currentModalQty,
                temp: selectedTemp,
                sugar: selectedSugar,
                size: selectedSize,
                milk: selectedMilk,
                toppings: selectedToppings,
                notes: notes,
                kategori: activeItem.kategori || '',
                tipe: activeItem.tipe || 'drink'
            });

            saveCart(currentCart);

            closeOptionsModal();
            updateMainCartUI();
        }

        // ============ Perbarui floating cart bar (subtotal & badge) ============
        function updateMainCartUI() {
            const cart = getCart();
            let totalHarga = 0;
            let totalItem = 0;

            cart.forEach(item => {
                const price = parseInt(item.finalPrice) || 0;
                totalHarga += price * item.qty;
                totalItem += item.qty;
            });

            const cartBar = document.getElementById('floating-cart');
            if (totalItem > 0) {
                cartBar.style.display = 'flex';
                document.getElementById('cart-total').innerText = 'Rp' + totalHarga.toLocaleString('id-ID');
                document.getElementById('cart-badge').innerText = totalItem;
                document.getElementById('checkout-count').innerText = totalItem;
            } else {
                cartBar.style.display = 'none';
            }
        }

        function toggleSearch(show) {
            const overlay = document.getElementById('search-overlay');
            overlay.style.display = show ? 'flex' : 'none';

            if (show) {
                // Fokus ke input & scroll ke atas tiap kali overlay dibuka
                const input = document.getElementById('search-input');
                setTimeout(() => input.focus(), 50);
            } else {
                // Reset pencarian saat overlay ditutup
                clearSearchInput();
            }
        }

        // ============ FITUR PENCARIAN MENU ============
        // Data menu diambil langsung dari elemen .menu-item yang sudah dirender
        // Blade (data-id, data-nama, data-harga, dst), jadi tidak perlu request
        // tambahan ke server — pencarian langsung terasa instan (client-side).
        function getAllMenuData() {
            const items = document.querySelectorAll('main .menu-item');
            return Array.from(items).map(el => ({
                id: el.getAttribute('data-id'),
                nama: el.getAttribute('data-nama') || '',
                harga: parseInt(el.getAttribute('data-harga')) || 0,
                kategori: el.getAttribute('data-kategori') || '',
                // Ambil deskripsi & gambar dari markup asli bila tersedia
                deskripsi: (el.querySelector('p')?.innerText || '').trim(),
                gambarSrc: el.querySelector('img')?.getAttribute('src') || null
            }));
        }

        let searchDebounceTimer = null;

        function handleSearchInput(rawValue) {
            const clearBtn = document.getElementById('search-clear-btn');
            clearBtn.classList.toggle('hidden', rawValue.trim().length === 0);

            // Debounce ringan supaya tidak render ulang di setiap keystroke super cepat
            clearTimeout(searchDebounceTimer);
            searchDebounceTimer = setTimeout(() => {
                renderSearchResults(rawValue.trim());
            }, 120);
        }

        function clearSearchInput() {
            const input = document.getElementById('search-input');
            input.value = '';
            document.getElementById('search-clear-btn').classList.add('hidden');
            renderSearchResults('');
        }

        function renderSearchResults(query) {
            const container = document.getElementById('search-results');
            const emptyState = document.getElementById('search-empty-state');

            if (!query) {
                container.innerHTML = '';
                container.appendChild(emptyState);
                emptyState.classList.remove('hidden');
                emptyState.innerText = 'Ketik nama menu, mis. "Kopi" atau "Croissant"...';
                return;
            }

            const q = query.toLowerCase();
            const allMenus = getAllMenuData();

            // Cocokkan berdasarkan nama menu maupun nama kategori
            const results = allMenus.filter(menu =>
                menu.nama.toLowerCase().includes(q) ||
                menu.kategori.toLowerCase().includes(q)
            );

            if (results.length === 0) {
                container.innerHTML = `
                    <div class="text-center mt-10">
                        <p class="text-sm text-stone-500 font-medium">Tidak ditemukan menu untuk "${escapeHtml(query)}"</p>
                        <p class="text-xs text-stone-400 mt-1">Coba kata kunci lain, misalnya nama minuman atau kategori.</p>
                    </div>
                `;
                return;
            }

            container.innerHTML = results.map(menu => `
                <div class="flex items-center space-x-3 py-3 border-b border-stone-100">
                    <div class="w-14 h-14 shrink-0 bg-stone-100 border border-stone-200/60 rounded-lg overflow-hidden flex items-center justify-center">
                        ${menu.gambarSrc
                            ? `<img src="${menu.gambarSrc}" alt="${escapeHtml(menu.nama)}" class="w-full h-full object-cover">`
                            : `<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-stone-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>`
                        }
                    </div>
                    <div class="flex-1 min-w-0">
                        <h4 class="text-sm font-semibold text-stone-900 truncate">${escapeHtml(menu.nama)}</h4>
                        <p class="text-[11px] text-stone-400">${escapeHtml(menu.kategori)}</p>
                        <p class="text-xs font-bold text-stone-800 mt-0.5">Rp${menu.harga.toLocaleString('id-ID')}</p>
                    </div>
                    <button onclick="handleAddClick('${menu.id}'); toggleSearch(false);" class="shrink-0 border border-stone-800 text-stone-800 hover:bg-stone-900 hover:text-white text-xs font-semibold px-3 py-1.5 rounded-lg transition">Add</button>
                </div>
            `).join('');
        }

        // Escape sederhana supaya query/nama menu tidak merusak markup (XSS-safe)
        function escapeHtml(str) {
            const div = document.createElement('div');
            div.innerText = str;
            return div.innerHTML;
        }

        function toggleCategoryModal(show) {
            document.getElementById('category-modal').style.display = show ? 'flex' : 'none';
        }

        // Inisialisasi saat halaman load
        document.addEventListener('DOMContentLoaded', updateMainCartUI);

        // ============================================================
        // SCROLLSPY: ubah tab aktif + geser garis indikator saat scroll
        // ============================================================
        (function () {
            const wrapper = document.getElementById('category-tabs-wrapper');
            const tabsContainer = document.getElementById('category-tabs');
            const indicator = document.getElementById('tab-indicator');
            const tabLinks = Array.from(document.querySelectorAll('#category-tabs a[data-tab]'));

            // Ambil semua section target berdasarkan data-tab (id section harus sama persis)
            const sections = tabLinks
                .map(link => document.getElementById(link.getAttribute('data-tab')))
                .filter(Boolean);

            let activeTab = null;

            // Menggeser garis bawah ke posisi & lebar tab yang aktif.
            // Pakai offsetLeft/offsetWidth (relatif ke #category-tabs, yang sejajar
            // dengan #category-tabs-wrapper) supaya tidak salah hitung saat tab
            // bar sedang di-scroll horizontal (beda dengan getBoundingClientRect
            // yang nilainya berubah-ubah relatif ke viewport).
            function moveIndicatorTo(link) {
                if (!link || !indicator) return;
                indicator.style.width = link.offsetWidth + 'px';
                indicator.style.transform = 'translateX(' + link.offsetLeft + 'px)';
            }

            // Menandai tab sebagai aktif (warna teks) + geser indikator + auto-scroll tab ke tengah
            function setActiveTab(tabId) {
                if (activeTab === tabId) return;
                activeTab = tabId;

                tabLinks.forEach(link => {
                    if (link.getAttribute('data-tab') === tabId) {
                        link.classList.add('tab-active');
                        moveIndicatorTo(link);

                        // Auto-scroll tab bar horizontal supaya tab aktif selalu terlihat
                        const linkRect = link.getBoundingClientRect();
                        const containerRect = wrapper.getBoundingClientRect();
                        if (linkRect.left < containerRect.left || linkRect.right > containerRect.right) {
                            link.scrollIntoView({ behavior: 'smooth', inline: 'center', block: 'nearest' });
                        }
                    } else {
                        link.classList.remove('tab-active');
                    }
                });
            }

            // Klik tab langsung set aktif duluan (tanpa menunggu observer), biar terasa instan
            tabLinks.forEach(link => {
                link.addEventListener('click', () => {
                    setActiveTab(link.getAttribute('data-tab'));
                });
            });

            if (sections.length > 0 && 'IntersectionObserver' in window) {
                // rootMargin dibuat agar "aktif" dihitung saat section berada
                // sedikit di bawah tab sticky (top offset) sampai pertengahan layar
                const observer = new IntersectionObserver((entries) => {
                    // Pilih entry yang paling banyak terlihat & paling dekat ke atas viewport
                    let bestEntry = null;
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            if (!bestEntry || entry.boundingClientRect.top < bestEntry.boundingClientRect.top) {
                                bestEntry = entry;
                            }
                        }
                    });
                    if (bestEntry) {
                        setActiveTab(bestEntry.target.id);
                    }
                }, {
                    root: null,
                    // -140px dari atas (tinggi header + tab sticky), -60% dari bawah
                    rootMargin: '-140px 0px -60% 0px',
                    threshold: 0
                });

                sections.forEach(section => observer.observe(section));
            }

            // Set indikator awal setelah layout selesai render + saat resize window.
            // requestAnimationFrame dipakai supaya offsetWidth/offsetLeft sudah pasti
            // final (setelah font & tailwind CDN selesai apply style).
            function syncIndicatorNow() {
                const current = document.querySelector('#category-tabs a.tab-active') || tabLinks[0];
                moveIndicatorTo(current);
            }

            window.addEventListener('load', () => requestAnimationFrame(syncIndicatorNow));
            window.addEventListener('resize', syncIndicatorNow);

            // Jika tab bar di-scroll manual (geser jari), indikator ikut geser
            // secara instan tanpa transition (karena posisinya absolute mengikuti
            // offsetLeft yang tidak berubah, tapi wrapper yang scroll — jadi ini
            // sebenarnya otomatis benar tanpa listener tambahan).
        })();

        // Membuka/menutup modal cart
function toggleCartModal(show) {
    const modal = document.getElementById('cart-modal');
    modal.style.display = show ? 'flex' : 'none';
    if (show) renderCartItems();
}

// Menampilkan daftar item ke dalam modal
function renderCartItems() {
    const cart = getCart();
    const container = document.getElementById('cart-items-list');
    container.innerHTML = '';

    cart.forEach((item, index) => {
        container.innerHTML += `
            <div class="flex justify-between items-center border-b pb-3">
                <div>
                    <p class="font-bold text-sm">${item.nama}</p>
                    <p class="text-xs text-stone-500">Rp${item.finalPrice.toLocaleString()} x ${item.qty}</p>
                </div>
                <div class="flex items-center space-x-2">
                    <button onclick="updateQty(${index}, -1)" class="px-2 bg-stone-100 rounded">-</button>
                    <span class="text-sm font-bold">${item.qty}</span>
                    <button onclick="updateQty(${index}, 1)" class="px-2 bg-stone-100 rounded">+</button>
                    <button onclick="removeItem(${index})" class="text-red-500 text-xs ml-2">Hapus</button>
                </div>
            </div>
        `;
    });
}

// Edit jumlah
function updateQty(index, delta) {
    let cart = getCart();
    cart[index].qty = Math.max(1, cart[index].qty + delta);
    saveCart(cart);
    renderCartItems();
    updateMainCartUI();
}


// Hapus item
function removeItem(index) {
    let cart = getCart();
    cart.splice(index, 1);
    saveCart(cart);
    renderCartItems();
    updateMainCartUI();
}

// ============ USER DROPDOWN MENU ============
function toggleUserMenu() {
    const dropdown = document.getElementById('user-dropdown');
    if (dropdown) {
        dropdown.classList.toggle('hidden');
    }
}

// Tutup dropdown saat klik di luar area menu
document.addEventListener('click', function (e) {
    const wrapper = document.getElementById('user-menu-wrapper');
    const dropdown = document.getElementById('user-dropdown');
    if (wrapper && dropdown && !wrapper.contains(e.target)) {
        dropdown.classList.add('hidden');
    }
});

// ============ DESKTOP SIDEBAR CART (kanan) ============
function updateDesktopCartSidebar() {
    const cart = getCart();
    const dcItems = document.getElementById('dc-items');
    const dcEmpty = document.getElementById('dc-empty');
    const dcCount = document.getElementById('dc-count');
    const dcSubtotal = document.getElementById('dc-subtotal');
    const dcPpn = document.getElementById('dc-ppn');
    const dcTotal = document.getElementById('dc-total');
    if (!dcItems) return; // sidebar tidak ada di mobile

    let subtotal = 0;
    let totalItem = 0;
    dcItems.innerHTML = '';

    cart.forEach((item, idx) => {
        const price = parseInt(item.finalPrice) || 0;
        subtotal += price * item.qty;
        totalItem += item.qty;
        const details = [item.temp, item.sugar, item.size].filter(Boolean).join(' · ');
        dcItems.innerHTML += `
            <div class="dc-item">
                <div class="flex justify-between items-start">
                    <div class="min-w-0 flex-1">
                        <p class="dc-item-name truncate">${escapeHtml(item.nama)}</p>
                        ${details ? `<p class="dc-item-details">${details}</p>` : ''}
                    </div>
                    <div class="flex items-center gap-1.5 ml-2 shrink-0">
                        <button onclick="dcUpdateQty(${idx}, -1)" class="w-5 h-5 flex items-center justify-center bg-stone-100 rounded text-xs font-bold text-stone-600 hover:bg-stone-200">-</button>
                        <span class="text-xs font-bold text-stone-900 w-4 text-center">${item.qty}</span>
                        <button onclick="dcUpdateQty(${idx}, 1)" class="w-5 h-5 flex items-center justify-center bg-stone-100 rounded text-xs font-bold text-stone-600 hover:bg-stone-200">+</button>
                    </div>
                </div>
                <div class="flex justify-between items-center mt-1.5">
                    <p class="dc-item-price">Rp${(price * item.qty).toLocaleString('id-ID')}</p>
                    <button onclick="dcRemoveItem(${idx})" class="text-[10px] text-red-400 hover:text-red-600">Hapus</button>
                </div>
            </div>`;
    });

    const ppn = subtotal * 0.10;
    dcEmpty.style.display = cart.length === 0 ? 'flex' : 'none';
    if (dcSubtotal) dcSubtotal.textContent = 'Rp' + subtotal.toLocaleString('id-ID');
    if (dcPpn) dcPpn.textContent = 'Rp' + ppn.toLocaleString('id-ID');
    if (dcTotal) dcTotal.textContent = 'Rp' + (subtotal + ppn).toLocaleString('id-ID');
    if (dcCount) dcCount.textContent = totalItem;
}

function dcUpdateQty(index, delta) {
    let cart = getCart();
    cart[index].qty = Math.max(1, cart[index].qty + delta);
    saveCart(cart);
    updateMainCartUI();
}

function dcRemoveItem(index) {
    let cart = getCart();
    cart.splice(index, 1);
    saveCart(cart);
    updateMainCartUI();
}

// ============ DESKTOP SIDEBAR NAV ACTIVE ============
function sidebarNav(tabId) {
    document.querySelectorAll('#desktop-sidebar .ds-nav-link').forEach(el => el.classList.remove('active'));
    const target = document.getElementById('dsnav-' + tabId);
    if (target) target.classList.add('active');
}

// Hook desktop sidebar update ke updateMainCartUI
const _origUpdateMainCartUI = updateMainCartUI;
updateMainCartUI = function() {
    _origUpdateMainCartUI();
    updateDesktopCartSidebar();
};

document.addEventListener('DOMContentLoaded', updateDesktopCartSidebar);
    </script>
<div id="cart-modal" class="hidden fixed inset-0 bg-black/60 z-50 items-end justify-center">
    <div class="w-full max-w-md bg-white rounded-t-2xl max-h-[85%] flex flex-col shadow-2xl">
        <div class="p-5 border-b border-stone-100 flex justify-between items-center">
            <h3 class="font-bold text-lg">Your Order</h3>
            <button onclick="toggleCartModal(false)" class="text-stone-400 font-bold">✕</button>
        </div>
        <div id="cart-items-list" class="overflow-y-auto p-5 space-y-4 flex-1">
            </div>
        <div class="p-5 border-t border-stone-100">
            <button onclick="window.location.href='/review-order'" class="w-full bg-[#2c1d11] text-white py-3 rounded-xl font-bold uppercase text-sm">Proceed to Checkout</button>
        </div>
    </div>
</div>
</body>
</html>