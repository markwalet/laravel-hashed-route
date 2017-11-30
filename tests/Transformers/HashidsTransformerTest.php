<?php

namespace MarkWalet\LaravelHashedRoute\Tests\Transformers;

use MarkWalet\LaravelHashedRoute\Exceptions\InvalidArgumentException;
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
        return new HashidsTransformer(['salt' => 'randomSalt', 'minimum_length' => 10]);
    }

    /** @test */
    public function salt_is_required_in_configuration()
    {
        $this->expectException(InvalidArgumentException::class);

        new HashidsTransformer(['minimum_length' => 100]);
    }

    /** @test */
    public function minimum_length_is_required_in_configuration()
    {
        $this->expectException(InvalidArgumentException::class);

        new HashidsTransformer(['salt' => 'randomSalt']);
    }

    /** @test */
    public function hash_is_at_least_as_long_as_the_given_minimum_length()
    {
        $generator = new HashidsTransformer(['salt' => 'randomSalt', 'minimum_length' => 100]);

        $hash = $generator->encode(1);

        $this->assertTrue(strlen($hash) >= 100);
    }
}