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
            Section::make('Data Bahan')
                ->description('Tambahkan jenis bahan yang digunakan dalam pembuatan menu.')
                ->schema([
                    TextInput::make('nama_bahan')
                        ->label('Nama Bahan')
                        ->placeholder('Contoh: Biji Kopi Arabika, Susu Segar, Gula Aren')
                        ->required()
                        ->maxLength(100),
                ])
                ->columns(1),
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

                TextColumn::make('menus_count')
                    ->label('Dipakai di Menu')
                    ->counts('menus')
                    ->badge()
                    ->color('warning'),

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
