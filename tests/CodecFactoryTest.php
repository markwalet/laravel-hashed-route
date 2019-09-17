<?php

namespace MarkWalet\LaravelHashedRoute\Tests\Codecs;

use MarkWalet\LaravelHashedRoute\CodecFactory;
use MarkWalet\LaravelHashedRoute\Codecs\Base64Codec;
use MarkWalet\LaravelHashedRoute\Codecs\HashidsCodec;
use MarkWalet\LaravelHashedRoute\Codecs\NullCodec;
use MarkWalet\LaravelHashedRoute\Codecs\OptimusCodec;
use MarkWalet\LaravelHashedRoute\Exceptions\InvalidArgumentException;
use MarkWalet\LaravelHashedRoute\Exceptions\MissingDriverException;
use PHPUnit\Framework\TestCase;

class CodecFactoryTest extends TestCase
{
    /** @test */
    public function it_can_create_a_null_driver()
    {
        $factory = new CodecFactory;

        $codec = $factory->make([
            'driver' => 'null',
        ]);

        $this->assertInstanceOf(NullCodec::class, $codec);
    }

    /** @test */
    public function it_can_create_a_hashids_driver()
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
    public function it_can_create_an_optimus_driver()
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
    public function it_can_create_a_base64_driver()
    {
        $factory = new CodecFactory;

        $codec = $factory->make([
            'driver' => 'base64',
            'salt' => 'randomSalt',
        ]);

        $this->assertInstanceOf(Base64Codec::class, $codec);
    }

    /** @test */
    public function it_requires_a_driver_in_the_configuration()
    {
        $factory = new CodecFactory;

        $this->expectException(InvalidArgumentException::class);
        $factory->make(['salt' => 'randomSalt']);
    }

    /** @test */
    public function it_throws_an_exception_when_the_driver_does_not_exist()
    {
        $factory = new CodecFactory;

        $this->expectException(MissingDriverException::class);
        $factory->make(['driver' => 'not-existing']);
    }
}
