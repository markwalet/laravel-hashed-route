<?php

namespace Tests\HashGenerator;

use MarkWalet\LaravelHashedRoute\Exceptions\InvalidModelException;
use MarkWalet\LaravelHashedRoute\HashGenerators\Transformer;
use Tests\TestModel;

trait TransformerTests
{
    /**
     * Get a hash generator instance.
     *
     * @return Transformer
     */
    public abstract function generator();

    /** @test */
    public function hashes_for_the_same_model_id_are_the_same()
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
}