<?php

namespace MarkWalet\LaravelHashedRoute\HashGenerators;

class NullTransformer implements Transformer
{
    /**
     * Generate a hash for a given id.
     *
     * @param int $id
     * @return int
     */
    public function encode(int $id)
    {
        return $id;
    }
}