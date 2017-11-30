<?php

namespace MarkWalet\LaravelHashedRoute\Transformers;

interface Transformer
{
    /**
     * Boot the transformer up.
     *
     * @param array $config
     *
     * @param array $config
     */
    public function __construct(array $config = []);

    /**
     * Generate a hash for a given id.
     *
     * @param int $id
     * @return int|string
     */
    public function encode(int $id);

    /**
     * Decode a has back to an id.
     *
     * @param string|int $hash
     * @return int
     */
    public function decode($hash): int;
}