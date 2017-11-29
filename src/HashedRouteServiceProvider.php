<?php

namespace MarkWalet\LaravelHashedRoute;

use Illuminate\Support\ServiceProvider;

class HashedRouteServiceProvider extends ServiceProvider
{

    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/config/hashed-route.php', 'hashed-url'
        );
        // Register HashIds service
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/config/hashed-route.php' => config_path('hashed-route.php'),
        ]);
        // Publish files.
    }
}