<?php

namespace App\Filament\Resources\MenuResource\Pages;

use App\Filament\Resources\MenuResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMenu extends EditRecord
{
    protected static string $resource = MenuResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        $menu = $this->record;
        $data['bahan_items'] = $menu->bahans->map(function ($bahan) {
            return [
                'id_bahan' => $bahan->id_bahan,
                'jumlah_dibutuhkan' => $bahan->pivot->jumlah_dibutuhkan ?? 1,
            ];
        })->toArray();

        return $data;
    }

    protected function afterSave(): void
    {
        $menu = $this->record;
        $items = $this->data['bahan_items'] ?? [];

        $syncData = [];
        foreach ($items as $item) {
            if (!empty($item['id_bahan'])) {
                $syncData[$item['id_bahan']] = [
                    'jumlah_dibutuhkan' => (int)($item['jumlah_dibutuhkan'] ?? 1)
                ];
            }
        }

        $menu->bahans()->sync($syncData);
    }
}
