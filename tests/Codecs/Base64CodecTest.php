<?php

namespace MarkWalet\LaravelHashedRoute\Tests\Codecs;

use MarkWalet\LaravelHashedRoute\Codecs\Base64Codec;
use MarkWalet\LaravelHashedRoute\Exceptions\InvalidArgumentException;
use MarkWalet\LaravelHashedRoute\Codecs\Codec;
use MarkWalet\LaravelHashedRoute\Codecs\HashidsCodec;
use MarkWalet\LaravelHashedRoute\Exceptions\UnsupportedKeyTypeException;
use MarkWalet\LaravelHashedRoute\Tests\TestModel;
use PHPUnit\Framework\TestCase;

class Base64CodecTest extends TestCase
{
    use CodecTests;

    /**
     * Get a hash generator instance.
     *
     * @return Codec
     */
    public function generator()
    {
        return new Base64Codec(['salt' => 'randomSalt', 'minimum_length' => 10]);
    }

    /** @test */
    public function salt_is_required_in_configuration()
    {
        $this->expectException(InvalidArgumentException::class);

        new Base64Codec(['minimum_length' => 100]);
    }

    /** @test */
    public function invalid_hash_decodes_to_null()
    {
        $codec = new Base64Codec(['salt' => 'randomSalt', 'minimum_length' => 10]);

        $invalidTokenResult = $codec->decode('$');

        $withoutSaltResult = $codec->decode(base64_encode('test'));

        $this->assertNull($invalidTokenResult);
        $this->assertNull($withoutSaltResult);
    }
}