<?php

namespace MarkWalet\LaravelHashedRoute\Tests;

use MarkWalet\LaravelHashedRoute\HashedRouteManager;
use MarkWalet\LaravelHashedRoute\Transformers\HashidsTransformer;
use MarkWalet\LaravelHashedRoute\Transformers\NullTransformer;
use MarkWalet\LaravelHashedRoute\Transformers\Transformer;
use MarkWalet\LaravelHashedRoute\Transformers\TransformerFactory;

class HashedRouteServiceProviderTest extends LaravelTestCase
{
    /** @test */
    public function binds_manager_to_the_application()
    {
        $bindings = $this->app->getBindings();

        $this->assertArrayHasKey(HashedRouteManager::class, $bindings);
    }

    /** @test */
    public function binds_transformer_to_the_application()
    {
        $bindings = $this->app->getBindings();

        $this->assertArrayHasKey(Transformer::class, $bindings);
    }

    /** @test */
    public function transformer_resolves_to_default_transformer()
    {
        $this->app['config']['hashed-route.default'] = 'none';
        $this->app['config']['hashed-route.transformers.none'] = ['driver' => 'null'];

        $transformer = $this->app->make(Transformer::class);

        $this->assertInstanceOf(NullTransformer::class, $transformer);
    }
}