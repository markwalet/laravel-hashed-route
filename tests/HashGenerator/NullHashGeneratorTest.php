<?php

namespace Tests\HashGenerator;

use MarkWalet\LaravelHashedRoute\HashGenerators\HashGenerator;
use MarkWalet\LaravelHashedRoute\HashGenerators\NullHashGenerator;
use PHPUnit\Framework\TestCase;

class NullHashGeneratorTest extends TestCase
{
    use HashGeneratorTests;

    /**
     * Get a hash generator instance.
     *
     * @return HashGenerator
     */
    public function generator()
    {
        return new NullHashGenerator;
    }
}