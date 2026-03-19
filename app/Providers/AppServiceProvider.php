<?php

namespace App\Providers;

use App\Models\User;
use App\Policies\UserPolicy;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Policy mappings.
     */
    protected $policies = [
        User::class => UserPolicy::class,
    ];

    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Register services here
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // If you're using policies, register them here
        // $this->registerPolicies();
    }
}