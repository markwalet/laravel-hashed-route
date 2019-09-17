<?php

namespace MarkWalet\LaravelHashedRoute\Tests\Codecs;

use MarkWalet\LaravelHashedRoute\Codecs\OptimusCodec;
use MarkWalet\LaravelHashedRoute\Exceptions\InvalidArgumentException;
use MarkWalet\LaravelHashedRoute\Codecs\Codec;
use MarkWalet\LaravelHashedRoute\Exceptions\InvalidHashException;
use MarkWalet\LaravelHashedRoute\Exceptions\UnsupportedKeyTypeException;
use PHPUnit\Framework\TestCase;

class OptimusCodecTest extends TestCase
{
    use CodecTests;

    /**
     * Get a hash generator instance.
     *
     * @return Codec
     */
    public function codec()
    {
        return new OptimusCodec(['prime' => 2123809381, 'inverse' => 1885413229, 'random' => 146808189]);
    }

    /** @test */
    public function it_requires_a_prime_in_the_configuration()
    {
        $this->expectException(InvalidArgumentException::class);

        return new OptimusCodec(['inverse' => 1885413229, 'random' => 146808189]);
    }

    /** @test */
    public function it_requires_an_inverse_in_the_configuration()
    {
        $this->expectException(InvalidArgumentException::class);

        return new OptimusCodec(['prime' => 2123809381, 'random' => 146808189]);
    }

    /** @test */
    public function it_requires_a_random_in_the_configuration()
    {
        $this->expectException(InvalidArgumentException::class);

        return new OptimusCodec(['prime' => 2123809381, 'inverse' => 1885413229]);
    }

    /** @test */
    public function it_throws_an_exception_when_key_type_is_not_an_integer()
    {
        $codec = new OptimusCodec(['prime' => 2123809381, 'inverse' => 1885413229, 'random' => 146808189]);

        $this->expectException(UnsupportedKeyTypeException::class);
        $codec->encode('non-integer');
    }

    /** @test */
    public function it_throws_an_exception_when_it_tries_to_decode_something_invalid()
    {
        $this->expectException(InvalidHashException::class);
        $codec = new OptimusCodec(['prime' => 2123809381, 'inverse' => 1885413229, 'random' => 146808189]);

        $result = $codec->decode('non-integer');

        $this->assertNull($result);
    }
}
