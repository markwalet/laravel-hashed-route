<?php

namespace MarkWalet\LaravelHashedRoute\Tests\Codecs;

use InvalidArgumentException;
use MarkWalet\LaravelHashedRoute\Codecs\Base64Codec;
use MarkWalet\LaravelHashedRoute\Codecs\OptimusCodec;
use MarkWalet\LaravelHashedRoute\Exceptions\MissingDriverException;
use MarkWalet\LaravelHashedRoute\Codecs\NullCodec;
use MarkWalet\LaravelHashedRoute\Codecs\HashidsCodec;
use MarkWalet\LaravelHashedRoute\Codecs\CodecFactory;
use PHPUnit\Framework\TestCase;

class CodecFactoryTest extends TestCase
{
    /** @test */
    public function can_create_a_null_driver()
    {
        $factory = new CodecFactory;

        $codec = $factory->make([
            'driver' => 'null',
        ]);

        $this->assertInstanceOf(NullCodec::class, $codec);
    }

    /** @test */
    public function can_create_a_hashids_driver()
    {
        $factory = new CodecFactory;

        $codec = $factory->make([
            'driver' => 'hashids',
            'minimum_length' => 10,
            'salt' => 'randomSalt',
        ]);

        $this->assertInstanceOf(HashidsCodec::class, $codec);
    }

    /** @test */
    public function can_create_a_optimus_driver()
    {
        $factory = new CodecFactory;

        $codec = $factory->make([
            'driver' => 'optimus',
            'prime' => 765863971,
            'inverse' => 854050699,
            'random' => 1818055571,
        ]);

        $this->assertInstanceOf(OptimusCodec::class, $codec);
    }

    /** @test */
    public function can_create_a_base64_driver()
    {
        $factory = new CodecFactory;

        $codec = $factory->make([
            'driver' => 'base64',
            'salt' => 'randomSalt',
        ]);

        $this->assertInstanceOf(Base64Codec::class, $codec);
    }

    /** @test */
    public function driver_key_is_required_as_configuration_key()
    {
        $factory = new CodecFactory;

        $this->expectException(InvalidArgumentException::class);
        $factory->make(['salt' => 'randomSalt']);
    }

    /** @test */
    public function driver_key_must_be_an_existing_driver()
    {
        $factory = new CodecFactory;

        $this->expectException(MissingDriverException::class);
        $factory->make(['driver' => 'not-existing']);
    }
}