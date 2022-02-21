<?php

namespace MarkWalet\LaravelHashedRoute;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\ServiceProvider;
use MarkWalet\LaravelHashedRoute\Codecs\Codec;

class HashedRouteServiceProvider extends ServiceProvider
{
    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/hashed-route.php', 'hashed-route');

        $this->registerHashedRouteServices();
    }

    /**
     * Register hash route services.
     */
    private function registerHashedRouteServices()
    {
        // Bind factory to application.
        $this->app->bind(CodecFactory::class, CodecFactory::class);

        // Bind hashed route manager to application.
        $this->app->bind(HashedRouteManager::class, function () {
            return new HashedRouteManager($this->app->make(CodecFactory::class));
        });

        // Bind default codec to application.
        $this->app->bind(Codec::class, function ($app) {
            /* @var Application $app */
            return $app->make(HashedRouteManager::class)->codec();
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/hashed-route.php' => config_path('hashed-route.php'),
        ]);
    }
}
