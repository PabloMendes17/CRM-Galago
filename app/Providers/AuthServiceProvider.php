<?php

namespace App\Providers;

use App\Providers\VendedorAuthProvider;
use Illuminate\Support\Facades\Auth;
// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        Auth::provider('vendedor', function ($app, array $config) {
            return new VendedorAuthProvider($this->app['hash'], $config['model']);
        });
    }

    /**
     * Get the authentication providers.
     *
     * @return array
     */
    protected function providers(): array
    {
        return [
            'vendedor' => [
                'driver' => 'eloquent',
                'model' => \App\Models\Vendedor::class,
            ],
        ];
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function register(): void
    {
        foreach ($this->providers() as $key => $value) {
            Auth::provider($key, function ($app) use ($value) {
                return new VendedorAuthProvider($app['hash'], $value['model']);
            });
        }
    }
}
