<?php

namespace MarkWalet\LaravelHashedRoute\Transformers;

class NullTransformer implements Transformer
{

    /**
     * Boot the transformer up.
     *
     * @param array $config
     *
     * @param array $config
     */
    public function __construct(array $config = [])
    {
    }

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