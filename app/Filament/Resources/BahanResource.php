<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BahanResource\Pages;
use App\Models\Bahan;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class BahanResource extends Resource
{
    protected static ?string $model = Bahan::class;

    protected static \BackedEnum|string|null $navigationIcon = 'heroicon-o-beaker';
    protected static ?string $navigationLabel = 'Kelola Bahan';
    protected static ?string $modelLabel = 'Bahan';
    protected static ?string $pluralModelLabel = 'Bahan';
    protected static string|\UnitEnum|null $navigationGroup = 'Master Data';
    protected static ?int $navigationSort = 3;

    /** Hanya Admin */
    public static function canAccess(): bool
    {
        return auth()->check() && auth()->user()->isAdmin();
    }

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Data & Stok Bahan')
                ->description('Tambahkan jenis bahan baku dan kelola ketersediaan stok fisik di gudang/kasir.')
                ->schema([
                    TextInput::make('nama_bahan')
                        ->label('Nama Bahan')
                        ->placeholder('Contoh: Biji Kopi Arabika, Susu Segar, Gula Aren')
                        ->required()
                        ->maxLength(100),

                    TextInput::make('stok')
                        ->label('Jumlah Stok Tersedia')
                        ->numeric()
                        ->minValue(0)
                        ->default(100)
                        ->required()
                        ->helperText('Stok akan berkurang otomatis saat pelanggan melakukan pemesanan.'),

                    TextInput::make('satuan')
                        ->label('Satuan')
                        ->default('porsi')
                        ->placeholder('Contoh: porsi, shot, ml, gram')
                        ->required()
                        ->maxLength(50),
                ])
                ->columns(3),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nama_bahan')
                    ->label('Nama Bahan')
                    ->weight('bold')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('stok')
                    ->label('Stok Tersedia')
                    ->numeric()
                    ->badge()
                    ->color(fn (int $state): string => match (true) {
                        $state <= 0 => 'danger',
                        $state <= 20 => 'warning',
                        default => 'success',
                    })
                    ->formatStateUsing(fn ($record) => number_format($record->stok, 0, ',', '.') . ' ' . $record->satuan)
                    ->sortable(),

                TextColumn::make('menus_count')
                    ->label('Dipakai di Menu')
                    ->counts('menus')
                    ->badge()
                    ->color('info'),

                TextColumn::make('created_at')
                    ->label('Ditambahkan')
                    ->date('d M Y')
                    ->sortable(),
            ])
            ->recordActions([
                EditAction::make()->label('Edit'),
                DeleteAction::make()
                    ->label('Hapus')
                    ->requiresConfirmation()
                    ->modalHeading('Yakin hapus bahan ini?'),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->emptyStateHeading('Belum ada bahan.')
            ->emptyStateDescription('Tambah bahan baru untuk mulai mengelola bahan-bahan menu Aura Coffee.')
            ->emptyStateActions([
                CreateAction::make()->label('Tambah sekarang'),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListBahans::route('/'),
            'create' => Pages\CreateBahan::route('/create'),
            'edit'   => Pages\EditBahan::route('/{record}/edit'),
        ];
    }
}
