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
     * @param int|string $key
     * @return int|string
     */
    public function encode($key)
    {
        return $key;
    }

    /**
     * Decode a hash back to an id.
     *
     * @param int|string $hash
     * @return int|string
     */
    public function decode($hash)
    {
        return $hash;
    }
}
