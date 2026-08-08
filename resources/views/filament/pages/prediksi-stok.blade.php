<x-filament-panels::page>
    <div class="space-y-6">

        {{-- Form Input --}}
        <form wire:submit.prevent="submit" class="space-y-6">
            {{ $this->form }}

            <div style="margin-top: 1.75rem; padding-top: 1.25rem; border-top: 1px solid rgba(107, 114, 128, 0.3);">
                <x-filament::button type="submit" icon="heroicon-o-sparkles" size="md">
                    Proses Prediksi
                </x-filament::button>
            </div>
        </form>

        {{-- Output Hasil --}}
        @if ($hasilPrediksi)
            @php
                $isLaris = $hasilPrediksi === 'Laris';
                $bulanMap = [
                    1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
                    5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
                    9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember',
                ];
                $hariMap = [
                    'Monday'    => 'Senin',
                    'Tuesday'   => 'Selasa',
                    'Wednesday' => 'Rabu',
                    'Thursday'  => 'Kamis',
                    'Friday'    => 'Jumat',
                    'Saturday'  => 'Sabtu',
                    'Sunday'    => 'Minggu',
                ];
                $bulanLabel = $bulanMap[$inputSummary['bulan'] ?? 0] ?? '-';
                $hariLabel  = $hariMap[$inputSummary['hari'] ?? ''] ?? ($inputSummary['hari'] ?? '-');

                $accentColor = $isLaris ? '#10b981' : '#f43f5e';
                $accentBg    = $isLaris ? 'rgba(16,185,129,0.07)' : 'rgba(244,63,94,0.07)';
                $badgeBg     = $isLaris ? 'rgba(16,185,129,0.15)' : 'rgba(244,63,94,0.15)';
                $badgeText   = $isLaris ? '#059669' : '#e11d48';
                $badgeBorder = $isLaris ? 'rgba(16,185,129,0.4)' : 'rgba(244,63,94,0.4)';
                $keterangan  = $isLaris ? 'Laris' : 'Kurang Laris';
            @endphp

            {{-- Card Utama --}}
            <div style="
                margin-top: 2rem;
                border-radius: 0.875rem;
                border: 1px solid {{ $accentColor }};
                background: {{ $accentBg }};
                overflow: hidden;
            ">

                {{-- Header Card --}}
                <div style="
                    padding: 0.875rem 1.5rem;
                    background: {{ $accentColor }};
                    display: flex;
                    align-items: center;
                    justify-content: space-between;
                    gap: 1rem;
                ">
                    <div style="display:flex; align-items:center; gap:0.6rem;">
                        <x-heroicon-o-chart-bar style="width:1.1rem; height:1.1rem; color:#fff;" />
                        <span style="font-size:0.82rem; font-weight:700; color:#fff; text-transform:uppercase; letter-spacing:0.06em;">
                            Hasil Prediksi Model
                        </span>
                    </div>
                    <span style="font-size:0.8rem; font-weight:600; color:#fff; opacity:0.85;">
                        {{ $inputSummary['menu'] ?? '-' }}
                    </span>
                </div>

                {{-- Info Rows --}}
                <div style="padding: 0.25rem 1.5rem 0.5rem;">

                    {{-- Promo --}}
                    <div style="display:flex; align-items:center; justify-content:space-between; padding:0.7rem 0; border-bottom:1px solid rgba(107,114,128,0.15);">
                        <span style="display:flex; align-items:center; gap:0.5rem; font-size:0.875rem; color:#9ca3af;">
                            <x-heroicon-o-tag style="width:1rem; height:1rem;" />
                            Promo
                        </span>
                        <span style="font-size:0.875rem; font-weight:600;">
                            {{ $inputSummary['promo'] ?? '-' }}
                        </span>
                    </div>

                    {{-- Hari --}}
                    <div style="display:flex; align-items:center; justify-content:space-between; padding:0.7rem 0; border-bottom:1px solid rgba(107,114,128,0.15);">
                        <span style="display:flex; align-items:center; gap:0.5rem; font-size:0.875rem; color:#9ca3af;">
                            <x-heroicon-o-calendar-days style="width:1rem; height:1rem;" />
                            Hari
                        </span>
                        <span style="font-size:0.875rem; font-weight:600;">
                            {{ $hariLabel }}
                        </span>
                    </div>

                    {{-- Bulan --}}
                    <div style="display:flex; align-items:center; justify-content:space-between; padding:0.7rem 0; border-bottom:1px solid rgba(107,114,128,0.15);">
                        <span style="display:flex; align-items:center; gap:0.5rem; font-size:0.875rem; color:#9ca3af;">
                            <x-heroicon-o-calendar style="width:1rem; height:1rem;" />
                            Bulan
                        </span>
                        <span style="font-size:0.875rem; font-weight:600;">
                            {{ $bulanLabel }}
                        </span>
                    </div>

                    {{-- Keterangan --}}
                    <div style="display:flex; align-items:center; justify-content:space-between; padding:0.7rem 0; border-bottom:1px solid rgba(107,114,128,0.15);">
                        <span style="display:flex; align-items:center; gap:0.5rem; font-size:0.875rem; color:#9ca3af;">
                            <x-heroicon-o-information-circle style="width:1rem; height:1rem;" />
                            Keterangan
                        </span>
                        <span style="
                            display: inline-flex;
                            align-items: center;
                            gap: 0.4rem;
                            font-size: 0.78rem;
                            font-weight: 700;
                            padding: 0.25rem 0.85rem;
                            border-radius: 9999px;
                            background: {{ $badgeBg }};
                            color: {{ $badgeText }};
                            border: 1px solid {{ $badgeBorder }};
                            letter-spacing: 0.02em;
                        ">
                            @if ($isLaris)
                                <x-heroicon-o-arrow-trending-up style="width:0.85rem; height:0.85rem;" />
                            @else
                                <x-heroicon-o-arrow-trending-down style="width:0.85rem; height:0.85rem;" />
                            @endif
                            {{ $keterangan }}
                        </span>
                    </div>

                    {{-- Prediksi Stok --}}
                    <div style="padding: 0.75rem 0 0.5rem;">
                        <div style="display:flex; align-items:center; gap:0.5rem; margin-bottom:0.75rem;">
                            <x-heroicon-o-archive-box style="width:1rem; height:1rem; color:#9ca3af;" />
                            <span style="font-size:0.875rem; color:#9ca3af;">Prediksi Stok</span>
                        </div>

                        @if (!empty($bahanMenu))
                            <div style="display:flex; flex-direction:column; gap:0.5rem;">
                                @foreach ($bahanMenu as $bahan)
                                    <div style="
                                        display: flex;
                                        align-items: flex-start;
                                        gap: 0.75rem;
                                        padding: 0.7rem 1rem;
                                        border-radius: 0.5rem;
                                        background: {{ $isLaris ? 'rgba(16,185,129,0.1)' : 'rgba(244,63,94,0.1)' }};
                                        border: 1px solid {{ $isLaris ? 'rgba(16,185,129,0.25)' : 'rgba(244,63,94,0.25)' }};
                                    ">
                                        <span style="margin-top:0.1rem; color:{{ $accentColor }}; flex-shrink:0;">
                                            @if ($isLaris)
                                                <x-heroicon-o-check-circle style="width:1rem; height:1rem;" />
                                            @else
                                                <x-heroicon-o-minus-circle style="width:1rem; height:1rem;" />
                                            @endif
                                        </span>
                                        <div>
                                            <p style="font-size:0.875rem; font-weight:600; margin:0;">
                                                {{ $bahan }}
                                            </p>
                                            <p style="font-size:0.75rem; margin:0.2rem 0 0; color:{{ $accentColor }};">
                                                @if ($isLaris)
                                                    Pasok lebih banyak bahan ini - menu diprediksi meningkat pada kondisi yang dipilih.
                                                @else
                                                    Tahan pembelian bahan ini - menu diprediksi kurang diminati pada kondisi yang dipilih.
                                                @endif
                                            </p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div style="
                                display: flex;
                                align-items: flex-start;
                                gap: 0.6rem;
                                padding: 0.7rem 1rem;
                                border-radius: 0.5rem;
                                background: rgba(107,114,128,0.08);
                                border: 1px solid rgba(107,114,128,0.2);
                            ">
                                <x-heroicon-o-light-bulb style="width:1rem; height:1rem; color:#f59e0b; margin-top:0.1rem; flex-shrink:0;" />
                                <p style="font-size:0.8rem; color:#9ca3af; font-style:italic; margin:0;">
                                    Belum ada bahan terdaftar untuk menu ini. Tambahkan melalui
                                    <strong style="color:#d1d5db;">Kelola Menu → Edit → Bahan-Bahan Menu</strong>.
                                </p>
                            </div>
                        @endif
                    </div>

                </div>

                {{-- Footer Note --}}
                <div style="padding: 0.6rem 1.5rem; border-top: 1px solid rgba(107,114,128,0.15);">
                    <div style="display:flex; align-items:center; gap:0.4rem;">
                        <x-heroicon-o-cpu-chip style="width:0.85rem; height:0.85rem; color:#6b7280;" />
                        <p style="font-size:0.7rem; color:#6b7280; font-style:italic; margin:0;">
                            Prediksi dihasilkan oleh model Decision Tree (scikit-learn). Gunakan sebagai referensi, bukan keputusan tunggal.
                        </p>
                    </div>
                </div>

            </div>
        @endif

    </div>
</x-filament-panels::page>
