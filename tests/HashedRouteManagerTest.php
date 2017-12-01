<?php

namespace MarkWalet\LaravelHashedRoute\Tests;

use MarkWalet\LaravelHashedRoute\Exceptions\MissingConfigurationException;
use MarkWalet\LaravelHashedRoute\HashedRouteManager;
use MarkWalet\LaravelHashedRoute\Codecs\HashidsCodec;
use MarkWalet\LaravelHashedRoute\Codecs\NullCodec;
use MarkWalet\LaravelHashedRoute\Codecs\Codec;
use MarkWalet\LaravelHashedRoute\Codecs\CodecFactory;

class HashedRouteManagerTest extends LaravelTestCase
{
    /** @test */
    public function can_get_a_codec()
    {
        /** @var HashedRouteManager $manager */
        $manager = $this->app->make(HashedRouteManager::class);

        $codec = $manager->codec('none');

        $this->assertInstanceOf(NullCodec::class, $codec);
    }

    /** @test */
    public function can_set_default_codec()
    {
        /** @var HashedRouteManager $manager */
        $manager = $this->app->make(HashedRouteManager::class);

        $manager->setDefaultCodec('none');
        $codec = $manager->codec();

        $this->assertInstanceOf(NullCodec::class, $codec);
        $this->assertEquals('none', $manager->getDefaulCodec());
    }

    /** @test */
    public function returns_default_codec_from_config_file_when_no_default_is_set()
    {
        /** @var HashedRouteManager $manager */
        $manager = $this->app->make(HashedRouteManager::class);

        $codec = $manager->codec();

        $this->assertInstanceOf(HashidsCodec::class, $codec);
    }

    /** @test */
    public function throws_exception_when_non_configured_driver_is_chosen()
    {
        /** @var HashedRouteManager $manager */
        $manager = $this->app->make(HashedRouteManager::class);

        $this->expectException(MissingConfigurationException::class);
        $manager->codec('non-existing');
    }

    /** @test */
    public function adds_initialized_codecs_to_codecs_list()
    {
        /** @var HashedRouteManager $manager */
        $manager = $this->app->make(HashedRouteManager::class);

        $nullCodec = $manager->codec('none');
        $hashidsCodec = $manager->codec('hashids');
        $codecs = $manager->getCodecs();

        $this->assertCount(2, $codecs);
        $this->assertContains($nullCodec, $codecs);
        $this->assertContains($hashidsCodec, $codecs);
    }

    /** @test */
    public function passes_methods_through_to_default_codec()
    {
        $codec = $this->createMock(Codec::class);
        $codec->expects($this->exactly(2))->method('encode');
        $factory = $this->createMock(CodecFactory::class);
        $factory->method('make')->withAnyParameters()->willReturn($codec);
        $this->app->bind(CodecFactory::class, function() use($factory) {
            return $factory;
        });

        $this->app->make(HashedRouteManager::class)->encode(12);
        $this->app->make(Codec::class)->encode(12);

    }

    /** @test */
    public function initializes_the_same_codec_only_once()
    {
        $factory = $this->createMock(CodecFactory::class);
        $this->app->bind(CodecFactory::class, function() use($factory) {
            return $factory;
        });
        $factory->expects($this->once())->method('make');
        /** @var HashedRouteManager $manager */
        $manager = $this->app->make(HashedRouteManager::class);

        $manager->codec('none');
        $manager->codec('none');
        $manager->codec('none');

        $this->assertCount(1, $manager->getCodecs());
    }
}