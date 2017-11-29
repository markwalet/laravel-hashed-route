<?php

namespace Tests\HashGenerator;

use MarkWalet\LaravelHashedRoute\Exceptions\InvalidModelException;
use MarkWalet\LaravelHashedRoute\HashGenerators\HashGenerator;
use Tests\TestModel;

trait HashGeneratorTests
{
    /**
     * Get a hash generator instance.
     *
     * @return HashGenerator
     */
    public abstract function generator();

    /** @test */
    public function hashes_for_the_same_model_id_are_the_same()
    {
        $generator = $this->generator();

        $hash1 = $generator->generate(10);
        $hash2 = $generator->generate(10);

        $this->assertEquals($hash1, $hash2);
    }

    /** @test */
    public function hashes_for_different_model_ids_are_different()
    {
        $generator = $this->generator();

        $hash1 = $generator->generate(17);
        $hash2 = $generator->generate(24);

        $this->assertNotEquals($hash1, $hash2);
    }

    /** @test */
    public function can_generate_hash_from_model()
    {
        $generator = $this->generator();
        $id = 31;
        $model = TestModel::make($id);

        $idHash = $generator->generate($id);
        $modelHash = $generator->generateFor($model);

        $this->assertEquals($idHash, $modelHash);
    }

    /** @test */
    public function throws_exception_when_model_has_no_key()
    {
        $generator = $this->generator();
        $model = TestModel::make(null);

        $this->expectException(InvalidModelException::class);
        $generator->generateFor($model);
    }
}