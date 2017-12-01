<?php

namespace MarkWalet\LaravelHashedRoute\Codecs;

class NullCodec implements Codec
{
    /**
     * Boot the codec up.
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

    /**
     * Decode a has back to an id.
     *
     * @param string|int $hash
     * @return int|null
     */
    public function decode($hash)
    {
        return (int) $hash;
    }
}