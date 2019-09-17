<?php

namespace MarkWalet\LaravelHashedRoute\Tests;

use MarkWalet\LaravelHashedRoute\Codecs\Codec;
use MarkWalet\LaravelHashedRoute\Codecs\NullCodec;
use MarkWalet\LaravelHashedRoute\HashedRouteManager;

class HashedRouteServiceProviderTest extends LaravelTestCase
{
    /** @test */
    public function it_binds_manager_to_the_application()
    {
        $bindings = $this->app->getBindings();

        $this->assertArrayHasKey(HashedRouteManager::class, $bindings);
    }

    /** @test */
    public function it_binds_codec_to_the_application()
    {
        $bindings = $this->app->getBindings();

        $this->assertArrayHasKey(Codec::class, $bindings);
    }

    /** @test */
    public function it_codec_resolves_to_default_codec()
    {
        $this->app['config']['hashed-route.default'] = 'none';
        $this->app['config']['hashed-route.codecs.none'] = ['driver' => 'null'];

        $codec = $this->app->make(Codec::class);

        $this->assertInstanceOf(NullCodec::class, $codec);
    }
}
