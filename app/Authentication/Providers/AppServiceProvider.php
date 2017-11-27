<?php

namespace App\Authentication\Providers;
use Auth;
use App\Authentication\Providers\UserAuthenticationProvider;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        \Illuminate\Support\Facades\Schema::defaultStringLength(191);
        Auth::provider('api-provider', function($app, array $config) {
            return new UserAuthenticationProvider();
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
    
    }
}
