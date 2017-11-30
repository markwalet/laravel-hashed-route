<?php

namespace MarkWalet\LaravelHashedRoute;

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
        $this->mergeConfigFrom(
            __DIR__.'/config/hashed-route.php', 'hashed-url'
        );

        $this->app->bind(HashedRouteManager::class, function($app) {
            $factory = new TransformerFactory;

            return new HashedRouteManager($app, $factory);
        });

        $this->app->bind(Transformer::class, function($app) {
            return $app[HashedRouteManager::class]->transformer();
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
        // Publish files.
    }
}