<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Models\User;
use App\Models\Family;
use Illuminate\Support\Facades\Gate;

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
        Gate::define('update', function (User $user, Family $family) {
            // Implement your logic to determine if the user can update the family
            // For example, you might check if the user is an admin or if they own the family
            return $user->isAdmin(); // This is a simple example, you can replace it with your actual logic
        });
    }
}
