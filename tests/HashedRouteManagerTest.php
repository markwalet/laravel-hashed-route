<?php

namespace MarkWalet\LaravelHashedRoute\Tests;

use MarkWalet\LaravelHashedRoute\Exceptions\MissingConfigurationException;
use MarkWalet\LaravelHashedRoute\HashedRouteManager;
use MarkWalet\LaravelHashedRoute\Transformers\HashidsTransformer;
use MarkWalet\LaravelHashedRoute\Transformers\NullTransformer;
use MarkWalet\LaravelHashedRoute\Transformers\Transformer;
use MarkWalet\LaravelHashedRoute\Transformers\TransformerFactory;

class HashedRouteManagerTest extends LaravelTestCase
{
    /** @test */
    public function can_get_a_transformer()
    {
        /** @var HashedRouteManager $manager */
        $manager = $this->app->make(HashedRouteManager::class);

        $transformer = $manager->transformer('none');

        $this->assertInstanceOf(NullTransformer::class, $transformer);
    }

    /** @test */
    public function can_set_default_transformer()
    {
        /** @var HashedRouteManager $manager */
        $manager = $this->app->make(HashedRouteManager::class);

        $manager->setDefaultTransformer('none');
        $transformer = $manager->transformer();

        $this->assertInstanceOf(NullTransformer::class, $transformer);
        $this->assertEquals('none', $manager->getDefaultTransformer());
    }

    /** @test */
    public function returns_default_transformer_from_config_file_when_no_default_is_set()
    {
        /** @var HashedRouteManager $manager */
        $manager = $this->app->make(HashedRouteManager::class);

        $transformer = $manager->transformer();

        $this->assertInstanceOf(HashidsTransformer::class, $transformer);
    }

    /** @test */
    public function throws_exception_when_non_configured_driver_is_chosen()
    {
        /** @var HashedRouteManager $manager */
        $manager = $this->app->make(HashedRouteManager::class);

        $this->expectException(MissingConfigurationException::class);
        $manager->transformer('non-existing');
    }

    /** @test */
    public function adds_initialized_transformers_to_transformers_list()
    {
        /** @var HashedRouteManager $manager */
        $manager = $this->app->make(HashedRouteManager::class);

        $nullTransformer = $manager->transformer('none');
        $hashidsTransformer = $manager->transformer('hashids');
        $transformers = $manager->getTransformers();

        $this->assertCount(2, $transformers);
        $this->assertContains($nullTransformer, $transformers);
        $this->assertContains($hashidsTransformer, $transformers);
    }

    /** @test */
    public function passes_methods_through_to_default_transformer()
    {
        $transformer = $this->createMock(Transformer::class);
        $transformer->expects($this->exactly(2))->method('encode');
        $factory = $this->createMock(TransformerFactory::class);
        $factory->method('make')->withAnyParameters()->willReturn($transformer);
        $this->app->bind(TransformerFactory::class, function() use($factory) {
            return $factory;
        });

        $this->app->make(HashedRouteManager::class)->encode(12);
        $this->app->make(Transformer::class)->encode(12);

    }

    /** @test */
    public function initializes_the_same_transformer_only_once()
    {
        $mock = $this->createMock(TransformerFactory::class);
        $this->app->bind(TransformerFactory::class, function() use($mock) {
            return $mock;
        });
        $mock->expects($this->once())->method('make');
        /** @var HashedRouteManager $manager */
        $manager = $this->app->make(HashedRouteManager::class);

        $manager->transformer('none');
        $manager->transformer('none');
        $manager->transformer('none');

        $this->assertCount(1, $manager->getTransformers());
    }
}