<?php

namespace App\Providers;

use App\MultiAttributes\SocialConnectAttributes;
use Illuminate\Support\ServiceProvider;

class SocialUrlProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
      $this->app->singleton('SocialUrl',function(){
        return new SocialConnectAttributes('./SocialUrl.json');
      });
    }
}
