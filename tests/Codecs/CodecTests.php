<?php

namespace MarkWalet\LaravelHashedRoute\Tests\Codecs;

use MarkWalet\LaravelHashedRoute\Codecs\Codec;

trait CodecTests
{
    /**
     * Get a codec instance.
     *
     * @return Codec
     */
    public abstract function codec();

    /** @test */
    public function hashes_for_the_same_key_are_the_same()
    {
        $codec = $this->codec();

        $hash1 = $codec->encode(10);
        $hash2 = $codec->encode(10);

        $this->assertEquals($hash1, $hash2);
    }

    /** @test */
    public function hashes_for_different_model_ids_are_different()
    {
        $codec = $this->codec();

        $hash1 = $codec->encode(17);
        $hash2 = $codec->encode(24);

        $this->assertNotEquals($hash1, $hash2);
    }

    /** @test */
    public function can_decode_hash()
    {
        $codec = $this->codec();

        $encoded = $codec->encode(147);
        $decoded = $codec->decode($encoded);

        $this->assertEquals(147, $decoded);
    }
}
