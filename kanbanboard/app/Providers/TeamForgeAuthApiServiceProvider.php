<?php

namespace App\Providers;

use App\Auth\TeamForgeAuthApiUserProvider;
use Illuminate\Support\ServiceProvider;

class TeamForgeAuthApiServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app['auth']->provider('teamforgeauthapi',function()
        {
            return new TeamForgeAuthApiUserProvider();
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}