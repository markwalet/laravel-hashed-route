<?php

namespace Tests\HashGenerator;

use MarkWalet\LaravelHashedRoute\HashGenerators\GeneratesHashForModel;
use MarkWalet\LaravelHashedRoute\HashGenerators\HashGenerator;
use MarkWalet\LaravelHashedRoute\HashGenerators\HashidsHashGenerator;
use PHPUnit\Framework\TestCase;
use Tests\TestModel;

class GeneratesHashForModelTest extends TestCase
{
    /** @test */
    public function has_from_model_is_the_same_as_hash_from_the_same_id()
    {
        $mock = $this->getMockForTrait(GeneratesHashForModel::class);
        $mock->expects($this->any())
            ->method('generate')
            ->willReturn('GeneratedHash123');
        $model = TestModel::make(31);

        $idHash = $mock->generate(31);
        $modelHash = $mock->generateFor($model);

        $this->assertEquals($idHash, $modelHash);
    }
}