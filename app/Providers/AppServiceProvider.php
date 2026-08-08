<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\User;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        try {
            if (Schema::hasTable('users')) {
                $adminUsername = config('admin.username', 'admin');
                $adminPassword = config('admin.password');

                if ($adminUsername && $adminPassword) {
                    User::updateOrCreate(
                        ['email' => $adminUsername],
                        [
                            'name' => 'Admin',
                            'password' => $adminPassword,
                        ]
                    );
                }
            }
        } catch (\Throwable $e) {
            // Silence initial connection error before DB setup
        }
    }
}