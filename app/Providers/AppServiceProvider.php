<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Gates for AuthMaster
        Gate::define('AuthMaster', function () {
            return auth()->user()->utype === 'AuthMaster';
        });

        // Gates for AuthCRO
        Gate::define('AuthCRO', function () {
            return auth()->user()->utype === 'AuthCRO';
        });

        // Gates for AuthSalesManager
        Gate::define('AuthSalesManager', function () {
            return auth()->user()->utype === 'AuthSalesManager';
        });

        // Gates for AuthSales
        Gate::define('AuthSales', function () {
            return auth()->user()->utype === 'AuthSales';
        });
    }
}
