<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;
use Spatie\Health\Facades\Health;
use Spatie\Health\Checks\Checks\OptimizedAppCheck;
use Spatie\Health\Checks\Checks\DebugModeCheck;
use Spatie\Health\Checks\Checks\EnvironmentCheck;

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
        //Asset URL para Livewire 3
        Livewire::setUpdateRoute(function ($handle) {
            return Route::post('/'.env('APP_URL_LIVEWIRE', 'laravel/public').'/livewire/update', $handle);
        });

        Livewire::setScriptRoute(function ($handle) {
            return Route::get(''.env('APP_URL_LIVEWIRE', 'laravel/public').'/livewire/livewire.js', $handle);
        });

        Health::checks([
            OptimizedAppCheck::new(),
            DebugModeCheck::new(),
            EnvironmentCheck::new(),
        ]);
    }
}
