<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Services\TrailerListService;

class AppServiceProvider extends ServiceProvider
{
    
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(TrailerListService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::define('isAdmin', fn ($user) => $user->role === 'admin');
    }
}
