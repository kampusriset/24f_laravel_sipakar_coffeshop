<?php

namespace App\Filament\Resources\Users;

use App\Filament\Resources\Users\UserResource\Pages;
use App\Filament\Resources\Users\Pages\CreateUser;
use App\Filament\Resources\Users\Pages\EditUser;
use App\Filament\Resources\Users\Pages\ListUsers;
use App\Models\User;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static \BackedEnum|string|null $navigationIcon = 'heroicon-o-users';
    protected static ?string $navigationLabel = 'Kelola Pengguna';
    protected static ?string $modelLabel = 'Pengguna';
    protected static ?string $pluralModelLabel = 'Pengguna';
    protected static string|\UnitEnum|null $navigationGroup = 'Manajemen';
    protected static ?int $navigationSort = 1;

    /**
     * Hanya Admin yang bisa mengelola user.
     * Kasir tidak perlu melihat daftar user/kasir lain.
     */
    public static function canAccess(): bool
    {
        return auth()->check() && auth()->user()->isAdmin();
    }

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            TextInput::make('name')
                ->label('Nama')
                ->required()
                ->maxLength(255),

            TextInput::make('email')
                ->label('Email')
                ->email()
                ->required()
                ->unique(ignoreRecord: true)
                ->maxLength(255),

            Select::make('role')
                ->label('Role')
                ->options([
                    'admin' => '🔴 Admin',
                    'kasir' => '🔵 Kasir',
                    'user'  => '🟢 User (Pelanggan)',
                ])
                ->required()
                ->default('user')
                ->helperText('Admin: akses penuh | Kasir: kelola pesanan | User: pelanggan'),

            TextInput::make('password')
                ->label('Password Baru')
                ->password()
                ->revealable()
                ->minLength(8)
                ->dehydrateStateUsing(fn ($state) => filled($state) ? bcrypt($state) : null)
                ->dehydrated(fn ($state) => filled($state))
                ->helperText('Kosongkan jika tidak ingin mengubah password.')
                ->nullable(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Nama')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),

                TextColumn::make('email')
                    ->label('Email')
                    ->searchable()
                    ->copyable(),

                TextColumn::make('role')
                    ->label('Role')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'admin' => 'danger',
                        'kasir' => 'info',
                        'user'  => 'success',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn (string $state) => match ($state) {
                        'admin' => 'Admin',
                        'kasir' => 'Kasir',
                        'user'  => 'Pelanggan',
                        default => $state,
                    }),

                TextColumn::make('google_id')
                    ->label('Google')
                    ->badge()
                    ->color('warning')
                    ->formatStateUsing(fn ($state) => $state ? '✓ Terhubung' : '—')
                    ->default('—'),

                TextColumn::make('created_at')
                    ->label('Bergabung')
                    ->date('d M Y')
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('role')
                    ->label('Filter Role')
                    ->options([
                        'admin' => 'Admin',
                        'kasir' => 'Kasir',
                        'user'  => 'Pelanggan',
                    ]),
            ])
            ->recordActions([
                EditAction::make()->label('Edit'),
                DeleteAction::make()
                    ->label('Hapus')
                    ->requiresConfirmation()
                    ->modalHeading('Yakin hapus pengguna ini?'),
            ])
            ->defaultSort('created_at', 'desc');
    }

    public static function getPages(): array
    {
        return [
            'index'  => ListUsers::route('/'),
            'create' => CreateUser::route('/create'),
            'edit'   => EditUser::route('/{record}/edit'),
        ];
    }
}
