<?php

namespace App\Filament\Pages\Auth;

use Filament\Auth\Pages\Login as BaseLogin;
use Filament\Schemas\Components\Component;
use Filament\Forms\Components\TextInput;
use Illuminate\Validation\ValidationException;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class Login extends BaseLogin
{
    protected function getEmailFormComponent(): Component
    {
        return TextInput::make('email')
            ->label('Username / Email')
            ->required()
            ->autocomplete()
            ->autofocus();
    }

    public function authenticate(): ?\Filament\Auth\Http\Responses\Contracts\LoginResponse
    {
        try {
            $data = $this->form->getState();

            $adminUsername = config('admin.username', 'admin');
            $adminPasswordHash = config('admin.password');

            $loginInput = trim($data['email']);
            $passwordInput = $data['password'];

            // 1. Cek login menggunakan kredensial .env (ADMIN_USERNAME & ADMIN_PASSWORD)
            if ($loginInput === $adminUsername && $adminPasswordHash && Hash::check($passwordInput, $adminPasswordHash)) {
                $user = User::updateOrCreate(
                    ['email' => $adminUsername],
                    [
                        'name' => 'Admin',
                        'password' => $adminPasswordHash,
                    ]
                );

                Auth::login($user, $data['remember'] ?? false);
                session()->regenerate();

                return app(\Filament\Auth\Http\Responses\Contracts\LoginResponse::class);
            }

            // 2. Fallback pencarian user biasa di database
            $user = User::where('email', $loginInput)->orWhere('name', $loginInput)->first();
            if ($user && Hash::check($passwordInput, $user->password)) {
                Auth::login($user, $data['remember'] ?? false);
                session()->regenerate();

                return app(\Filament\Auth\Http\Responses\Contracts\LoginResponse::class);
            }

            throw ValidationException::withMessages([
                'data.email' => __('filament-panels::pages/auth/login.messages.failed'),
            ]);
        } catch (ValidationException $exception) {
            throw $exception;
        }
    }
}
