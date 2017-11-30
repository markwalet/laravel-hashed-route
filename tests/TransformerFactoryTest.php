<?php

namespace MarkWalet\LaravelHashedRoute\Tests\Transformers;

use InvalidArgumentException;
use MarkWalet\LaravelHashedRoute\Exceptions\MissingDriverException;
use MarkWalet\LaravelHashedRoute\Transformers\NullTransformer;
use MarkWalet\LaravelHashedRoute\Transformers\HashidsTransformer;
use MarkWalet\LaravelHashedRoute\Transformers\TransformerFactory;
use PHPUnit\Framework\TestCase;

class TransformerFactoryTest extends TestCase
{
    /** @test */
    public function can_create_a_null_driver()
    {
        $factory = new TransformerFactory;

        $transformer = $factory->make(['driver' => 'null']);

        $this->assertInstanceOf(NullTransformer::class, $transformer);
    }
    /** @test */
    public function can_create_a_hashids_driver()
    {
        $factory = new TransformerFactory;

        $transformer = $factory->make(['driver' => 'hashids', 'minimum_length' => 10, 'salt' => 'randomSalt']);

        $this->assertInstanceOf(HashidsTransformer::class, $transformer);
    }

    /** @test */
    public function driver_key_is_required_as_configuration_key()
    {
        $factory = new TransformerFactory;

        $this->expectException(InvalidArgumentException::class);
        $factory->make(['salt' => 'randomSalt']);
    }

    /** @test */
    public function driver_key_must_be_an_existing_driver()
    {
        $factory = new TransformerFactory;

        $this->expectException(MissingDriverException::class);
        $factory->make(['driver' => 'not-existing']);
    }
}