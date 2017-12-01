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
     * @return string
     */
    public function encode($key): string
    {
        return $key;
    }

    /**
     * Decode a hash back to an id.
     *
     * @param string $hash
     * @return int|string|null
     */
    public function decode(string $hash)
    {
        return $hash;
    }
}