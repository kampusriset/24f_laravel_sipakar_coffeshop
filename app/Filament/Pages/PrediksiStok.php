<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Models\Menu;

class PrediksiStok extends Page implements HasForms
{
    use InteractsWithForms;

    protected static \BackedEnum|string|null $navigationIcon = 'heroicon-o-chart-bar';
    protected static ?string $navigationLabel = 'Prediksi Stok AI';
    protected static ?string $title = 'Prediksi Stok Menu (Decision Tree ML)';
    protected static string|\UnitEnum|null $navigationGroup = 'Analitik & AI';
    protected static ?int $navigationSort = 1;

    /**
     * Hanya Admin yang bisa mengakses fitur AI.
     * Kasir cukup mengelola pesanan, tidak perlu analitik.
     */
    public static function canAccess(): bool
    {
        return auth()->check() && auth()->user()->isAdmin();
    }

    protected string $view = 'filament.pages.prediksi-stok';

    public ?array $data = [];
    public ?string $hasilPrediksi = null;
    public ?string $selectedMenu = null;
    public ?array $inputSummary = null;
    public array $bahanMenu = [];

    public function mount(): void
    {
        $this->form->fill([
            'promo' => 'Tidak',
            'hari'  => date('l'),
            'bulan' => (int)date('n'),
        ]);
    }

    public function form(Schema $schema): Schema
    {
        $validOptions = $this->getValidOptions();

        $validMenuList = $validOptions['menu'] ?? [];
        $dbMenus = Menu::pluck('nama_menu')->toArray();

        $menuOptions = [];
        foreach ($validMenuList as $validItem) {
            $inDb = in_array($validItem, $dbMenus);
            $menuOptions[$validItem] = $validItem . ($inDb ? '' : ' (Belum ada di DB)');
        }

        $promoOptions = array_combine($validOptions['promo'] ?? ['Tidak', 'Ya'], $validOptions['promo'] ?? ['Tidak', 'Ya']);

        $hariTranslation = [
            'Monday'    => 'Senin',
            'Tuesday'   => 'Selasa',
            'Wednesday' => 'Rabu',
            'Thursday'  => 'Kamis',
            'Friday'    => 'Jumat',
            'Saturday'  => 'Sabtu',
            'Sunday'    => 'Minggu',
        ];
        $hariList    = $validOptions['hari'] ?? ['Friday', 'Monday', 'Saturday', 'Sunday', 'Thursday', 'Tuesday', 'Wednesday'];
        $hariOptions = [];
        foreach ($hariList as $en) {
            $hariOptions[$en] = $hariTranslation[$en] ?? $en;
        }

        $bulanOptions = [
            1  => '1 - Januari',
            2  => '2 - Februari',
            3  => '3 - Maret',
            4  => '4 - April',
            5  => '5 - Mei',
            6  => '6 - Juni',
            7  => '7 - Juli',
            8  => '8 - Agustus',
            9  => '9 - September',
            10 => '10 - Oktober',
            11 => '11 - November',
            12 => '12 - Desember',
        ];

        return $schema
            ->components([
                Section::make('Input Parameter Prediksi Stok')
                    ->description('Pilih menu, status promo, hari, dan bulan untuk memprediksi potensi penjualan menu.')
                    ->schema([
                        Select::make('menu')
                            ->label('Nama Menu')
                            ->options($menuOptions)
                            ->searchable()
                            ->required(),

                        Select::make('promo')
                            ->label('Status Promo')
                            ->options($promoOptions)
                            ->required(),

                        Select::make('hari')
                            ->label('Hari')
                            ->options($hariOptions)
                            ->required(),

                        Select::make('bulan')
                            ->label('Bulan')
                            ->options($bulanOptions)
                            ->required(),
                    ])
                    ->columns(2),
            ])
            ->statePath('data');
    }

    protected function getValidOptions(): array
    {
        $baseUrl = config('services.ml_api.base_url', 'http://127.0.0.1:8001');

        try {
            $response = Http::timeout(3)->get("{$baseUrl}/valid-options");

            if ($response->successful()) {
                return $response->json();
            }
        } catch (\Throwable $e) {
            Log::warning('FastAPI valid-options check failed: ' . $e->getMessage());
        }

        return [
            'menu'  => ['Affogato', 'Americano', 'Brownies', 'Burger', 'Cappuccino', 'Cheesecake', 'Chicken Wings', 'Chocolate', 'Cinnamon Roll', 'Cold Brew', 'Cookies', 'Croissant', 'Donut', 'Es Kopi Susu Gula Aren', 'Espresso', 'Flat White', 'French Fries', 'Green Tea', 'Iced Americano', 'Iced Latte', 'Latte', 'Lemon Tea', 'Lychee Tea', 'Macchiato', 'Matcha Latte', 'Mineral Water', 'Mocha', 'Muffin', 'Pain au Chocolat', 'Peach Tea', 'Red Velvet Cake', 'Red Velvet Latte', 'Sandwich', 'Spaghetti', 'Taro Latte', 'Tea Latte', 'Tiramisu', 'Toast', 'Vietnamese Coffee'],
            'promo' => ['Tidak', 'Ya'],
            'hari'  => ['Friday', 'Monday', 'Saturday', 'Sunday', 'Thursday', 'Tuesday', 'Wednesday'],
        ];
    }

    public function submit(): void
    {
        $formData = $this->form->getState();
        $baseUrl  = config('services.ml_api.base_url', 'http://127.0.0.1:8001');

        try {
            $response = Http::timeout(5)->post("{$baseUrl}/predict", [
                'menu'  => $formData['menu'],
                'promo' => $formData['promo'],
                'hari'  => $formData['hari'],
                'bulan' => (int)$formData['bulan'],
            ]);

            if ($response->successful()) {
                $result = $response->json();
                $this->hasilPrediksi = $result['prediksi'] ?? 'Unknown';
                $this->selectedMenu  = $formData['menu'];
                $this->inputSummary  = $formData;

                // Ambil bahan-bahan menu dari database
                $menu = Menu::with('bahans')
                    ->where('nama_menu', $formData['menu'])
                    ->first();

                $this->bahanMenu = $menu
                    ? $menu->bahans->pluck('nama_bahan')->toArray()
                    : [];

                Notification::make()
                    ->title('Prediksi Berhasil')
                    ->body("Hasil prediksi untuk {$formData['menu']}: {$this->hasilPrediksi}")
                    ->success()
                    ->send();
            } else {
                $errorDetail = $response->json('detail') ?? 'Terjadi kesalahan saat memproses prediksi.';
                Notification::make()
                    ->title('Gagal Melakukan Prediksi')
                    ->body($errorDetail)
                    ->danger()
                    ->send();
            }
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Notification::make()
                ->title('Gagal Terhubung ke API ML')
                ->body('Layanan Python FastAPI (http://127.0.0.1:8001) tidak dapat diakses. Pastikan uvicorn sudah berjalan.')
                ->danger()
                ->send();
        } catch (\Throwable $e) {
            Notification::make()
                ->title('Error Prediksi')
                ->body('Terjadi kesalahan: ' . $e->getMessage())
                ->danger()
                ->send();
        }
    }
}
