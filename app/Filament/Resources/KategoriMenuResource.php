<?php

namespace App\Filament\Resources;

use App\Filament\Resources\KategoriMenuResource\Pages;
use App\Models\KategoriMenu;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class KategoriMenuResource extends Resource
{
    protected static ?string $model = KategoriMenu::class;

    protected static \BackedEnum|string|null $navigationIcon = 'heroicon-o-tag';
    protected static ?string $navigationLabel = 'Kategori';
    protected static ?string $modelLabel = 'Kategori';
    protected static string|\UnitEnum|null $navigationGroup = 'Master Data';
    protected static ?int $navigationSort = 2;

    /** Hanya Admin */
    public static function canAccess(): bool
    {
        return auth()->check() && auth()->user()->isAdmin();
    }

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            TextInput::make('nama_kategori')
                ->label('Nama Kategori')
                ->required()
                ->maxLength(255),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nama_kategori')
                    ->label('Nama Kategori')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('menus_count')
                    ->label('Jumlah Menu')
                    ->counts('menus')
                    ->badge(),
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListKategoriMenus::route('/'),
            'create' => Pages\CreateKategoriMenu::route('/create'),
            'edit' => Pages\EditKategoriMenu::route('/{record}/edit'),
        ];
    }
}
