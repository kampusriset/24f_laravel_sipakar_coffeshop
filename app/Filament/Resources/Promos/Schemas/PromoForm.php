<?php

namespace App\Filament\Resources\Promos\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Filament\Schemas\Components\Section;

class PromoForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make()->schema([
                    TextInput::make('judul')->required()->maxLength(255),
                    Textarea::make('deskripsi')->maxLength(65535),
                    TextInput::make('diskon_persen')
                        ->numeric()
                        ->minValue(0)
                        ->maxValue(100)
                        ->default(0)
                        ->suffix('%')
                        ->label('Diskon (%)')
                        ->helperText('Masukkan angka persentase diskon antara 0% hingga 100%'),
                    Toggle::make('is_active')->label('Aktif?')->default(false),
                    Select::make('menus')->multiple()->relationship('menus', 'nama_menu')->preload()->label('Menu yang Promo'),
                ])
            ]);
    }
}
