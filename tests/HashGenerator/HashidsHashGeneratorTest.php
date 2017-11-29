<?php

namespace Tests\HashGenerator;

use MarkWalet\LaravelHashedRoute\HashGenerators\HashGenerator;
use MarkWalet\LaravelHashedRoute\HashGenerators\HashidsHashGenerator;
use PHPUnit\Framework\TestCase;

class HashidsHashGeneratorTest extends TestCase
{
    use HashGeneratorTests;

    /**
     * Get a hash generator instance.
     *
     * @return HashGenerator
     */
    public function generator()
    {
        return new HashidsHashGenerator('salt');
    }

    /** @test */
    public function hash_is_at_least_as_long_as_the_given_minimum_length()
    {
        $generator = new HashidsHashGenerator('salt', 100);

        $hash = $generator->generate(1);

        $this->assertTrue(strlen($hash) >= 100);
    }
}