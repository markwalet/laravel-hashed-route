<?php

namespace MarkWalet\LaravelHashedRoute\HashGenerators;

class NullHashGenerator implements HashGenerator
{
    use GeneratesHashForModel;

    /**
     * Generate a hash for a given id.
     *
     * @param int $id
     * @return int
     */
    public function generate(int $id)
    {
        return $id;
    }
}