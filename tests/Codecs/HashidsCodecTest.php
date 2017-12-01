<?php

namespace MarkWalet\LaravelHashedRoute\Tests\Codecs;

use MarkWalet\LaravelHashedRoute\Exceptions\InvalidArgumentException;
use MarkWalet\LaravelHashedRoute\Codecs\Codec;
use MarkWalet\LaravelHashedRoute\Codecs\HashidsCodec;
use MarkWalet\LaravelHashedRoute\Exceptions\UnsupportedKeyTypeException;
use PHPUnit\Framework\TestCase;

class HashidsCodecTest extends TestCase
{
    use CodecTests;

    /**
     * Get a hash generator instance.
     *
     * @return Codec
     */
    public function generator()
    {
        return new HashidsCodec(['salt' => 'randomSalt', 'minimum_length' => 10]);
    }

    /** @test */
    public function salt_is_required_in_configuration()
    {
        $this->expectException(InvalidArgumentException::class);

        new HashidsCodec(['minimum_length' => 100]);
    }

    /** @test */
    public function minimum_length_is_required_in_configuration()
    {
        $this->expectException(InvalidArgumentException::class);

        new HashidsCodec(['salt' => 'randomSalt']);
    }

    /** @test */
    public function hash_is_at_least_as_long_as_the_given_minimum_length()
    {
        $generator = new HashidsCodec(['salt' => 'randomSalt', 'minimum_length' => 100]);

        $hash = $generator->encode(1);

        $this->assertTrue(strlen($hash) >= 100);
    }

    /** @test */
    public function can_configure_alphabet()
    {
        /** @noinspection SpellCheckingInspection */
        $generator = new HashidsCodec([
            'salt' => 'randomSalt',
            'minimum_length' => 100,
            'alphabet' => 'ABCDEFGHIJKLMNOPQRSTUVWXYZ',
        ]);

        $hash = $generator->encode(14);

        $this->assertRegExp('/^[A-Z]*$/', $hash);
    }

    /** @test */
    public function throws_exception_when_key_type_is_not_an_integer()
    {
        $codec = new HashidsCodec(['salt' => 'randomSalt', 'minimum_length' => 10]);

        $this->expectException(UnsupportedKeyTypeException::class);
        $codec->encode('non-integer');
    }

    /** @test */
    public function invalid_hash_decodes_to_null()
    {
        $codec = new HashidsCodec(['salt' => 'randomSalt', 'minimum_length' => 10]);

        $result = $codec->decode('rubbish');

        $this->assertNull($result);
    }
}