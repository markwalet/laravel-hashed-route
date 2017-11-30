<?php

namespace MarkWalet\LaravelHashedRoute\Tests\Transformers;

use MarkWalet\LaravelHashedRoute\Transformers\Transformer;

trait TransformerTests
{
    /**
     * Get a hash generator instance.
     *
     * @return Transformer
     */
    public abstract function generator();

    /** @test */
    public function hashes_for_the_same_key_are_the_same()
    {
        $generator = $this->generator();

        $hash1 = $generator->encode(10);
        $hash2 = $generator->encode(10);

        $this->assertEquals($hash1, $hash2);
    }

    /** @test */
    public function hashes_for_different_model_ids_are_different()
    {
        $generator = $this->generator();

        $hash1 = $generator->encode(17);
        $hash2 = $generator->encode(24);

        $this->assertNotEquals($hash1, $hash2);
    }

    /** @test */
    public function can_decode_hash()
    {
        $generator = $this->generator();

        $encoded = $generator->encode(147);
        $decoded = $generator->decode($encoded);

        $this->assertEquals(147, $decoded);
    }
}