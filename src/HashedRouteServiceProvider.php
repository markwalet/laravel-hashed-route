<?php

namespace MarkWalet\LaravelHashedRoute;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\ServiceProvider;
use MarkWalet\LaravelHashedRoute\Transformers\Transformer;
use MarkWalet\LaravelHashedRoute\Transformers\TransformerFactory;

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
        $this->app->bind(TransformerFactory::class, TransformerFactory::class);

        // Bind hashed route manager to application.
        $this->app->bind(HashedRouteManager::class, function ($app) {
            /** @var Application $app */
            return new HashedRouteManager($app, $this->app->make(TransformerFactory::class));
        });

        // Bind default transformer to application.
        $this->app->bind(Transformer::class, function ($app) {
            /** @var Application $app */
            return $app->make(HashedRouteManager::class)->transformer();
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
            __DIR__.'/config/hashed-route.php' => config_path('hashed-route.php'),
        ]);
    }
}