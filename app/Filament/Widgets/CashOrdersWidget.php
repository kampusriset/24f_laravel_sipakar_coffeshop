<?php

namespace App\Filament\Widgets;

use App\Models\Pesanan;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Actions\Action;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Database\Eloquent\Builder;

class CashOrdersWidget extends BaseWidget
{
    protected static ?int $sort = 2;
    protected static ?string $heading = '🧾 Pesanan Cash, Menunggu Konfirmasi';
    protected string $pollingInterval = '5s'; // Refresh lebih cepat

    // Lebar penuh
    protected int|string|array $columnSpan = 'full';

    // Hanya tampil jika ada pesanan cash yang menunggu/diproses
    public static function canView(): bool
    {
        return Pesanan::where('metode_bayar', 'cash')
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
                    ->where('metode_bayar', 'cash')
                    ->whereDate('created_at', today())
                    ->whereIn('status', ['menunggu', 'diproses'])
                    ->orderBy('created_at', 'asc') // Yang paling lama menunggu di atas
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

                TextColumn::make('menu_list')
                    ->label('Menu Dipesan')
                    ->getStateUsing(function (Pesanan $record): string {
                        return $record->details
                            ->map(fn ($d) => "• {$d->nama_menu} ×{$d->qty}" . ($d->suhu ? " ({$d->suhu})" : ''))
                            ->join("\n");
                    })
                    ->wrap()
                    ->html(false),

                TextColumn::make('total_akhir')
                    ->label('Total')
                    ->money('IDR', locale: 'id')
                    ->weight('bold'),

                TextColumn::make('created_at')
                    ->label('Waktu Pesan')
                    ->dateTime('H:i')
                    ->description(fn (Pesanan $r) => $r->created_at->diffForHumans()),

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
                Action::make('terima')
                    ->label('✅ Terima & Proses')
                    ->color('success')
                    ->icon('heroicon-o-check-circle')
                    ->visible(fn (Pesanan $r) => $r->status === 'menunggu')
                    ->requiresConfirmation()
                    ->modalHeading('Terima pesanan cash ini?')
                    ->modalDescription(fn (Pesanan $r) => "Pelanggan: {$r->nama_pelanggan} | Total: Rp " . number_format($r->total_akhir, 0, ',', '.'))
                    ->action(fn (Pesanan $r) => $r->update(['status' => 'diproses'])),

                Action::make('selesai')
                    ->label('Selesai')
                    ->color('primary')
                    ->icon('heroicon-o-flag')
                    ->visible(fn (Pesanan $r) => $r->status === 'diproses')
                    ->requiresConfirmation()
                    ->modalHeading('Tandai pesanan selesai?')
                    ->modalDescription('Pastikan pembayaran tunai sudah diterima sebelum klik Selesai.')
                    ->action(fn (Pesanan $r) => $r->update(['status' => 'selesai'])),

                Action::make('batal')
                    ->label('Batalkan')
                    ->color('danger')
                    ->icon('heroicon-o-x-circle')
                    ->visible(fn (Pesanan $r) => $r->status === 'menunggu')
                    ->requiresConfirmation()
                    ->modalHeading('Batalkan pesanan ini?')
                    ->action(fn (Pesanan $r) => $r->update(['status' => 'dibatalkan'])),
            ])
            ->emptyStateHeading('Tidak ada pesanan cash yang menunggu.')
            ->emptyStateDescription('Semua pesanan cash sudah diproses atau belum ada pesanan baru.')
            ->emptyStateIcon('heroicon-o-check-badge')
            ->paginated(false);
    }
}
