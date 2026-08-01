<?php

namespace App\Filament\Widgets;

use App\Models\KategoriMenu;
use App\Models\Menu;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class DashboardStats extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Menu', Menu::count())
                ->description('Jumlah menu tersedia')
                ->descriptionIcon('heroicon-m-cake')
                ->color('warning'),

            Stat::make('Total Kategori', KategoriMenu::count())
                ->description('Jumlah kategori menu')
                ->descriptionIcon('heroicon-m-tag')
                ->color('success'),
        ];
    }
}
