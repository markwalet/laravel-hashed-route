<?php

namespace MarkWalet\LaravelHashedRoute\Tests\Codecs;

use MarkWalet\LaravelHashedRoute\Codecs\Base64Codec;
use MarkWalet\LaravelHashedRoute\Codecs\Codec;
use MarkWalet\LaravelHashedRoute\Exceptions\InvalidArgumentException;
use MarkWalet\LaravelHashedRoute\Exceptions\InvalidHashException;
use PHPUnit\Framework\TestCase;

class Base64CodecTest extends TestCase
{
    use CodecTests;

    /**
     * Get a hash generator instance.
     *
     * @return Codec
     */
    public function codec()
    {
        return new Base64Codec(['salt' => 'randomSalt', 'minimum_length' => 10]);
    }

    /** @test */
    public function it_requires_a_salt_in_configuration()
    {
        $this->expectException(InvalidArgumentException::class);

        new Base64Codec(['minimum_length' => 100]);
    }

    /** @test */
    public function it_throws_an_exception_when_it_tries_to_decode_something_invalid()
    {
        $this->expectException(InvalidHashException::class);
        $codec = new Base64Codec(['salt' => 'randomSalt', 'minimum_length' => 10]);

        $invalidTokenResult = $codec->decode('$');

        $withoutSaltResult = $codec->decode(base64_encode('test'));

        $this->assertNull($invalidTokenResult);
        $this->assertNull($withoutSaltResult);
    }
}
