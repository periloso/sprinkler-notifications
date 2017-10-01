<?php

namespace Periloso\SprinklerNotifications;

use GuzzleHttp\Client as HttpClient;
use Illuminate\Support\ServiceProvider;

class SprinklerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        $this->app->when(SprinklerChannel::class)
            ->needs(Sprinkler::class)
            ->give(function() {
                $config = [
                    'url' => env('SPRINKLER_URL', null),
                    'token' => env('SPRINKLER_TOKEN', null),
                ];

                return new Sprinkler($config, new HttpClient);
            });
    }
    /**
     * Register the application services.
     */
    public function register()
    {
        //
    }
}
