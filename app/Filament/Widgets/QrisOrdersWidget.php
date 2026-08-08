<?php

namespace App\Filament\Widgets;

use App\Models\Pesanan;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Actions\Action;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Database\Eloquent\Builder;

class QrisOrdersWidget extends BaseWidget
{
    protected static ?int $sort = 3;
    protected static ?string $heading = '📱 Pesanan QRIS, Menunggu Konfirmasi';
    protected string $pollingInterval = '5s';

    // Lebar penuh
    protected int|string|array $columnSpan = 'full';

    // Hanya tampil jika ada pesanan QRIS yang menunggu/diproses
    public static function canView(): bool
    {
        return Pesanan::where('metode_bayar', 'qris')
            ->whereDate('created_at', today())
            ->whereIn('status', ['menunggu', 'diproses'])
            ->exists();
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Pesanan::query()
                    ->with('details')
                    ->where('metode_bayar', 'qris')
                    ->whereDate('created_at', today())
                    ->whereIn('status', ['menunggu', 'diproses'])
                    ->orderBy('created_at', 'asc')
            )
            ->columns([
                TextColumn::make('kode_pesanan')
                    ->label('Kode')
                    ->fontFamily('mono')
                    ->weight('bold')
                    ->copyable(),

                TextColumn::make('nama_pelanggan')
                    ->label('Pelanggan')
                    ->description(fn (Pesanan $r) => $r->nomor_meja ? '🪑 Meja ' . $r->nomor_meja : '🥡 Takeaway'),

                TextColumn::make('items_count')
                    ->label('Menu')
                    ->getStateUsing(fn (Pesanan $r) => $r->details->count() . ' item')
                    ->badge()
                    ->color('gray'),

                TextColumn::make('total_akhir')
                    ->label('Total')
                    ->money('IDR', locale: 'id')
                    ->weight('bold'),

                TextColumn::make('created_at')
                    ->label('Waktu')
                    ->dateTime('H:i')
                    ->sortable(),

                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'menunggu' => 'warning',
                        'diproses' => 'info',
                        default    => 'gray',
                    })
                    ->formatStateUsing(fn (string $state) => match ($state) {
                        'menunggu' => '⏳ Menunggu',
                        'diproses' => '🔄 Diproses',
                        default    => $state,
                    }),
            ])
            ->actions([
                // Tombol lihat detail menu
                Action::make('lihat_menu')
                    ->label('Lihat Menu')
                    ->icon('heroicon-o-queue-list')
                    ->color('gray')
                    ->modalHeading(fn (Pesanan $r) => 'Detail Menu · ' . $r->kode_pesanan)
                    ->modalWidth('md')
                    ->modalContent(fn (Pesanan $r) => new \Illuminate\Support\HtmlString(
                        '<div class="divide-y divide-gray-200">' .
                        $r->details->map(fn ($d) =>
                            '<div class="flex justify-between items-start py-3 px-1">' .
                            '<div class="flex-1">' .
                            '<p class="font-semibold text-sm text-gray-900">' . e($d->nama_menu) . ' <span class="text-gray-400">×' . $d->qty . '</span></p>' .
                            (collect([$d->suhu, $d->sugar_level, $d->ukuran, $d->jenis_susu, $d->topping])->filter()->isNotEmpty()
                                ? '<p class="text-xs text-gray-400 mt-0.5">' . collect([$d->suhu, $d->sugar_level, $d->ukuran, $d->jenis_susu, $d->topping])->filter()->join(' · ') . '</p>'
                                : '') .
                            ($d->catatan ? '<p class="text-xs text-amber-600 italic mt-0.5">📝 ' . e($d->catatan) . '</p>' : '') .
                            '</div>' .
                            '<p class="font-bold text-sm text-gray-900 ml-4 shrink-0">Rp' . number_format($d->subtotal, 0, ',', '.') . '</p>' .
                            '</div>'
                        )->join('') .
                        '</div>'
                    ))
                    ->modalSubmitAction(false)
                    ->modalCancelActionLabel('Tutup'),

                // Konfirmasi pembayaran QRIS diterima
                Action::make('konfirmasi_qris')
                    ->label('📱 Konfirmasi Bayar')
                    ->color('info')
                    ->icon('heroicon-o-check-circle')
                    ->visible(fn (Pesanan $r) => $r->status === 'menunggu')
                    ->requiresConfirmation()
                    ->modalHeading('Konfirmasi pembayaran QRIS diterima?')
                    ->modalDescription(fn (Pesanan $r) => "Pelanggan: {$r->nama_pelanggan} | Total: Rp " . number_format($r->total_akhir, 0, ',', '.') . "\n\nPastikan pembayaran QRIS sudah berhasil masuk sebelum mengkonfirmasi.")
                    ->action(fn (Pesanan $r) => $r->update(['status' => 'diproses'])),

                // Tandai selesai setelah pesanan siap diambil → status: selesai
                Action::make('selesai_qris')
                    ->label('✅ Selesai')
                    ->color('success')
                    ->icon('heroicon-o-flag')
                    ->visible(fn (Pesanan $r) => $r->status === 'diproses')
                    ->requiresConfirmation()
                    ->modalHeading('Tandai pesanan QRIS ini selesai?')
                    ->modalDescription('Pastikan pesanan sudah siap dan dapat diambil oleh pelanggan.')
                    ->action(fn (Pesanan $r) => $r->update(['status' => 'selesai'])),

                // Batalkan pesanan
                Action::make('batal_qris')
                    ->label('Batalkan')
                    ->color('danger')
                    ->icon('heroicon-o-x-circle')
                    ->visible(fn (Pesanan $r) => in_array($r->status, ['menunggu', 'diproses']))
                    ->requiresConfirmation()
                    ->modalHeading('Batalkan pesanan QRIS ini?')
                    ->action(fn (Pesanan $r) => $r->update(['status' => 'dibatalkan'])),
            ])
            ->emptyStateHeading('Tidak ada pesanan QRIS yang menunggu.')
            ->emptyStateDescription('Semua pesanan QRIS sudah diproses atau belum ada pesanan baru.')
            ->emptyStateIcon('heroicon-o-check-badge')
            ->paginated(false);
    }
}
