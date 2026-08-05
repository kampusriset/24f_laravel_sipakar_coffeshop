<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PesananResource\Pages;
use App\Models\Pesanan;
use Filament\Actions\Action;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Filament\Actions\ViewAction;
use Filament\Infolists\Components\Section as InfoSection;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\RepeatableEntry;
use Filament\Infolists\Infolist;

class PesananResource extends Resource
{
    protected static ?string $model = Pesanan::class;

    protected static \BackedEnum|string|null $navigationIcon = 'heroicon-o-shopping-bag';
    protected static ?string $navigationLabel = 'Pesanan Masuk';
    protected static ?string $modelLabel = 'Pesanan';
    protected static ?string $pluralModelLabel = 'Pesanan';
    protected static string|\UnitEnum|null $navigationGroup = 'Kasir';
    protected static ?int $navigationSort = 1;

    /**
     * Admin & Kasir bisa akses pesanan.
     */
    public static function canAccess(): bool
    {
        return auth()->check() && in_array(auth()->user()->role, ['admin', 'kasir']);
    }

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            \Filament\Schemas\Components\Section::make('Informasi Pelanggan')
                ->schema([
                    \Filament\Forms\Components\TextInput::make('kode_pesanan')
                        ->label('Kode Pesanan')
                        ->disabled()
                        ->extraInputAttributes(['class' => 'font-mono font-bold']),
                    
                    \Filament\Forms\Components\TextInput::make('nama_pelanggan')
                        ->label('Nama Pelanggan')
                        ->disabled(),

                    \Filament\Forms\Components\TextInput::make('nomor_meja')
                        ->label('Nomor Meja')
                        ->disabled()
                        ->placeholder('Takeaway (Tanpa Meja)'),

                    \Filament\Forms\Components\TextInput::make('nomor_hp')
                        ->label('No. HP Pelanggan')
                        ->disabled()
                        ->placeholder('-'),
                ])->columns(2),

            \Filament\Schemas\Components\Section::make('Rincian Menu & Add-On')
                ->schema([
                    \Filament\Forms\Components\Repeater::make('details')
                        ->label('Daftar Minuman / Makanan')
                        ->relationship('details')
                        ->disabled()
                        ->schema([
                            \Filament\Forms\Components\TextInput::make('nama_menu')
                                ->label('Nama Menu')
                                ->disabled(),
                            \Filament\Forms\Components\TextInput::make('qty')
                                ->label('Qty')
                                ->disabled(),
                            \Filament\Forms\Components\TextInput::make('harga_satuan')
                                ->label('Harga Satuan')
                                ->disabled(),
                            \Filament\Forms\Components\TextInput::make('subtotal')
                                ->label('Total')
                                ->disabled(),
                            \Filament\Forms\Components\TextInput::make('suhu')
                                ->label('Suhu')
                                ->disabled()
                                ->placeholder('-'),
                            \Filament\Forms\Components\TextInput::make('sugar_level')
                                ->label('Gula')
                                ->disabled()
                                ->placeholder('-'),
                            \Filament\Forms\Components\TextInput::make('ukuran')
                                ->label('Ukuran')
                                ->disabled()
                                ->placeholder('-'),
                            \Filament\Forms\Components\TextInput::make('jenis_susu')
                                ->label('Susu')
                                ->disabled()
                                ->placeholder('-'),
                            \Filament\Forms\Components\TextInput::make('topping')
                                ->label('Topping')
                                ->disabled()
                                ->placeholder('-'),
                            \Filament\Forms\Components\TextInput::make('catatan')
                                ->label('Catatan Koki')
                                ->disabled()
                                ->placeholder('-')
                                ->columnSpan('full'),
                        ])->columns(2)
                ]),

            \Filament\Schemas\Components\Section::make('Total Transaksi')
                ->schema([
                    \Filament\Forms\Components\TextInput::make('subtotal')
                        ->label('Subtotal')
                        ->disabled(),
                    \Filament\Forms\Components\TextInput::make('ppn')
                        ->label('PPN (10%)')
                        ->disabled(),
                    \Filament\Forms\Components\TextInput::make('diskon')
                        ->label('Diskon')
                        ->disabled(),
                    \Filament\Forms\Components\TextInput::make('total_akhir')
                        ->label('Total Akhir')
                        ->disabled()
                        ->extraInputAttributes(['class' => 'text-amber-700 font-bold']),
                ])->columns(4)
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('kode_pesanan')
                    ->label('Kode Pesanan')
                    ->searchable()
                    ->copyable()
                    ->fontFamily('mono')
                    ->weight('bold'),

                TextColumn::make('nama_pelanggan')
                    ->label('Pelanggan')
                    ->searchable()
                    ->description(fn (Pesanan $r) => $r->nomor_meja ? 'Meja ' . $r->nomor_meja : 'Tanpa meja'),

                TextColumn::make('details_count')
                    ->label('Items')
                    ->counts('details')
                    ->badge()
                    ->color('info'),

                TextColumn::make('total_akhir')
                    ->label('Total')
                    ->money('IDR', locale: 'id')
                    ->weight('bold'),

                TextColumn::make('persen_diskon')
                    ->label('Diskon')
                    ->badge()
                    ->color('success')
                    ->formatStateUsing(fn ($state) => $state > 0 ? "{$state}%" : '-')
                    ->default(0),

                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'menunggu'   => 'warning',
                        'diproses'   => 'info',
                        'selesai'    => 'success',
                        'dibatalkan' => 'danger',
                        default      => 'gray',
                    })
                    ->formatStateUsing(fn (string $state) => match ($state) {
                        'menunggu'   => '⏳ Menunggu',
                        'diproses'   => '🔄 Diproses',
                        'selesai'    => '✅ Selesai',
                        'dibatalkan' => '❌ Dibatalkan',
                        default      => $state,
                    }),

                TextColumn::make('metode_bayar')
                    ->label('Bayar')
                    ->badge()
                    ->color(fn ($state) => match ($state) {
                        'cash' => 'warning',
                        'qris' => 'info',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn ($state) => match ($state) {
                        'cash' => '💵 Cash di Kasir',
                        'qris' => '📱 QRIS',
                        default => strtoupper($state),
                    }),

                TextColumn::make('created_at')
                    ->label('Waktu')
                    ->dateTime('H:i · d M')
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->label('Status')
                    ->options([
                        'menunggu'   => '⏳ Menunggu',
                        'diproses'   => '🔄 Diproses',
                        'selesai'    => '✅ Selesai',
                        'dibatalkan' => '❌ Dibatalkan',
                    ]),

                SelectFilter::make('metode_bayar')
                    ->label('Metode Bayar')
                    ->options([
                        'cash' => '💵 Cash di Kasir',
                        'qris' => '📱 QRIS',
                    ]),
            ])
            ->recordActions([
                ViewAction::make()
                    ->label('Rincian')
                    ->modalHeading('Rincian Struk Pesanan')
                    ->icon('heroicon-o-eye')
                    ->color('gray')
                    ->extraModalFooterActions([
                        \Filament\Actions\Action::make('terima_cash_modal')
                            ->label('✅ Terima & Proses (Cash)')
                            ->color('success')
                            ->visible(fn (Pesanan $r) => $r->metode_bayar === 'cash' && $r->status === 'menunggu')
                            ->requiresConfirmation()
                            ->modalHeading('Terima pesanan cash ini?')
                            ->action(fn (Pesanan $r) => $r->update(['status' => 'diproses'])),
                    ]),

                \Filament\Actions\Action::make('proses')
                    ->label('Proses')
                    ->icon('heroicon-o-arrow-right-circle')
                    ->color('info')
                    ->visible(fn (Pesanan $r) => $r->status === 'menunggu')
                    ->requiresConfirmation()
                    ->modalHeading('Proses pesanan ini?')
                    ->action(fn (Pesanan $r) => $r->update(['status' => 'diproses'])),

                \Filament\Actions\Action::make('selesai')
                    ->label('Selesai')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->visible(fn (Pesanan $r) => $r->status === 'diproses')
                    ->requiresConfirmation()
                    ->modalHeading('Tandai pesanan selesai?')
                    ->action(fn (Pesanan $r) => $r->update(['status' => 'selesai'])),

                \Filament\Actions\Action::make('batal')
                    ->label('Batalkan')
                    ->icon('heroicon-o-x-circle')
                    ->color('danger')
                    ->visible(fn (Pesanan $r) => in_array($r->status, ['menunggu', 'diproses']))
                    ->requiresConfirmation()
                    ->modalHeading('Yakin batalkan pesanan ini?')
                    ->action(fn (Pesanan $r) => $r->update(['status' => 'dibatalkan'])),
            ])
            ->actions([
                ViewAction::make(),
            ])
            ->defaultSort('created_at', 'desc')
            ->poll('15s') // auto-refresh setiap 15 detik
            ->emptyStateHeading('Belum ada pesanan masuk.')
            ->emptyStateDescription('Pesanan dari pelanggan akan muncul di sini secara otomatis.');
    }



    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPesanans::route('/'),
        ];
    }
}

