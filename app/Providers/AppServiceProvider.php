<?php

namespace App\Providers;

use Auth;
use Illuminate\Support\ServiceProvider;
use App\Authentication\UserAuthenticationProvider;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
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
        //
    }
}
