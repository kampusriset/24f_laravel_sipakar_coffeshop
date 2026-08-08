<?php

namespace App\Filament\Resources\BahanResource\Pages;

use App\Filament\Resources\BahanResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditBahan extends EditRecord
{
    protected static string $resource = BahanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
