<?php

namespace Tests\HashGenerator;

use MarkWalet\LaravelHashedRoute\HashGenerators\Transformer;
use MarkWalet\LaravelHashedRoute\HashGenerators\NullTransformer;
use PHPUnit\Framework\TestCase;

class NullTransformerTest extends TestCase
{
    use TransformerTests;

    /**
     * Get a hash generator instance.
     *
     * @return Transformer
     */
    public function generator()
    {
        return new NullTransformer;
    }
}