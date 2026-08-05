<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MenuResource\Pages;
use App\Models\Menu;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class MenuResource extends Resource
{
    protected static ?string $model = Menu::class;

    protected static \BackedEnum|string|null $navigationIcon = 'heroicon-o-cake';
    protected static ?string $navigationLabel = 'Kelola Menu';
    protected static ?string $modelLabel = 'Menu';
    protected static ?string $pluralModelLabel = 'Menu';
    protected static string|\UnitEnum|null $navigationGroup = 'Master Data';
    protected static ?int $navigationSort = 1;

    /**
     * Hanya Admin yang bisa mengakses resource ini.
     * Kasir tidak perlu mengelola menu/produk.
     */
    public static function canAccess(): bool
    {
        return auth()->check() && auth()->user()->isAdmin();
    }

    // Setara dengan create.blade.php & edit.blade.php
    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Detail Menu')
                ->description('Lengkapi detail menu untuk ditambahkan ke daftar Aura Coffee.')
                ->schema([
                    TextInput::make('nama_menu')
                        ->label('Nama Menu')
                        ->placeholder('Contoh: Aura Ice Coffee Melts')
                        ->required()
                        ->maxLength(255),

                    TextInput::make('harga')
                        ->label('Harga (Rp)')
                        ->prefix('Rp')
                        ->numeric()
                        ->minValue(0)
                        ->required(),

                    Select::make('id_kategori')
                        ->label('Kategori')
                        ->relationship('kategori', 'nama_kategori')
                        ->searchable()
                        ->preload()
                        ->placeholder('-- Pilih Kategori --')
                        ->required(),

                    FileUpload::make('gambar')
                        ->label('Gambar Menu')
                        ->image()
                        ->disk('public')
                        ->directory('menu')
                        ->imagePreviewHeight('150')
                        ->helperText('Upload baru untuk mengganti gambar lama.'),
                ])
                ->columns(1),

            Section::make('Bahan-Bahan Menu')
                ->description('Pilih bahan-bahan yang dibutuhkan untuk membuat menu ini. Digunakan sebagai referensi rekomendasi stok pada fitur Prediksi.')
                ->schema([
                    CheckboxList::make('bahans')
                        ->label('Pilih Bahan')
                        ->relationship('bahans', 'nama_bahan')
                        ->searchable()
                        ->bulkToggleable()
                        ->gridDirection('row')
                        ->columns(3),
                ]),
        ]);
    }

    // Setara dengan index.blade.php (tabel + sorting + aksi)
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('gambar')
                    ->label('Gambar')
                    ->state(fn ($record) => $record->gambar 
                        ? (file_exists(public_path('menu-image/' . $record->gambar)) 
                            ? asset('menu-image/' . $record->gambar) 
                            : $record->gambar) 
                        : null)
                    ->disk('public')
                    ->square(),

                TextColumn::make('nama_menu')
                    ->label('Nama Menu')
                    ->weight('bold')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('kategori.nama_kategori')
                    ->label('Kategori')
                    ->badge()
                    ->color('warning')
                    ->sortable(),

                TextColumn::make('harga')
                    ->label('Harga')
                    ->money('IDR', locale: 'id')
                    ->sortable(),

                TextColumn::make('bahans_count')
                    ->label('Jml Bahan')
                    ->counts('bahans')
                    ->badge()
                    ->color('info'),
            ])
            ->filters([
                SelectFilter::make('id_kategori')
                    ->label('Kategori')
                    ->relationship('kategori', 'nama_kategori'),
            ])
            ->recordActions([
                EditAction::make()->label('Edit'),
                DeleteAction::make()
                    ->label('Hapus')
                    ->requiresConfirmation()
                    ->modalHeading('Yakin hapus menu ini?'),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->emptyStateHeading('Belum ada menu.')
            ->emptyStateDescription('Tambah menu baru untuk mulai mengelola daftar Aura Coffee.')
            ->emptyStateActions([
                CreateAction::make()->label('Tambah sekarang'),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListMenus::route('/'),
            'create' => Pages\CreateMenu::route('/create'),
            'edit'   => Pages\EditMenu::route('/{record}/edit'),
        ];
    }
}
