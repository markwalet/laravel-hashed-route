<?php

namespace MarkWalet\LaravelHashedRoute\Tests\Transformers;

use MarkWalet\LaravelHashedRoute\Transformers\Transformer;
use MarkWalet\LaravelHashedRoute\Transformers\HashidsTransformer;
use PHPUnit\Framework\TestCase;

class HashidsTransformerTest extends TestCase
{
    use TransformerTests;

    /**
     * Get a hash generator instance.
     *
     * @return Transformer
     */
    public function generator()
    {
        return new HashidsTransformer('salt');
    }

    /** @test */
    public function hash_is_at_least_as_long_as_the_given_minimum_length()
    {
        $generator = new HashidsTransformer('salt', 100);

        $hash = $generator->encode(1);

        $this->assertTrue(strlen($hash) >= 100);
    }
}