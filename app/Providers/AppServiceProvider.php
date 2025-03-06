<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Providers\Filament\NavigationProvider;

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
        $this->app->singleton(
            NavigationProvider::class,
            NavigationProvider::class
        );
    }
}
