<?php

namespace MarkWalet\LaravelHashedRoute\Tests\Codecs;

use MarkWalet\LaravelHashedRoute\Codecs\OptimusCodec;
use MarkWalet\LaravelHashedRoute\Exceptions\InvalidArgumentException;
use MarkWalet\LaravelHashedRoute\Codecs\Codec;
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
    public function generator()
    {
        return new OptimusCodec(['prime' => 2123809381, 'inverse' => 1885413229, 'random' => 146808189]);
    }

    /** @test */
    public function prime_is_required_in_configuration()
    {
        $this->expectException(InvalidArgumentException::class);

        return new OptimusCodec(['inverse' => 1885413229, 'random' => 146808189]);
    }

    /** @test */
    public function inverse_is_required_in_configuration()
    {
        $this->expectException(InvalidArgumentException::class);

        return new OptimusCodec(['prime' => 2123809381, 'random' => 146808189]);
    }

    /** @test */
    public function random_is_required_in_configuration()
    {
        $this->expectException(InvalidArgumentException::class);

        return new OptimusCodec(['prime' => 2123809381, 'inverse' => 1885413229]);
    }

    /** @test */
    public function throws_exception_when_key_type_is_not_an_integer()
    {
        $codec = new OptimusCodec(['prime' => 2123809381, 'inverse' => 1885413229, 'random' => 146808189]);

        $this->expectException(UnsupportedKeyTypeException::class);
        $codec->encode('non-integer');
    }

    /** @test */
    public function non_integer_hash_decodes_to_null()
    {
        $codec = new OptimusCodec(['prime' => 2123809381, 'inverse' => 1885413229, 'random' => 146808189]);

        $result = $codec->decode('non-integer');

        $this->assertNull($result);
    }
}