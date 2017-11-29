<?php

namespace MarkWalet\LaravelHashedRoute\Tests\Transformers;

use MarkWalet\LaravelHashedRoute\Transformers\Transformer;
use MarkWalet\LaravelHashedRoute\Transformers\NullTransformer;
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