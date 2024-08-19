<?php

namespace App\Providers;

use App\Models\Cost;
use App\Models\User;
use App\Observers\CostObserver;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

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
        Paginator::useBootstrap();

        Gate::define('IsAdmin', function (User $user) {
            return $user->driver === 'aflah';
        });

        Gate::define('IsOwner', function (User $user) {
            return $user->driver === 'sulistiawan';
        });

        Gate::define('IsMitra', function (User $user) {
            return $user->driver === 'mitra';
        });

        Cost::observe(CostObserver::class);
    }
}
