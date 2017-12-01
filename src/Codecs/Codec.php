<?php

namespace MarkWalet\LaravelHashedRoute\Codecs;

interface Codec
{
    /**
     * Boot the codec up.
     *
     * @param array $config
     */
    public function __construct(array $config = []);

    /**
     * Generate a hash for a given id.
     *
     * @param int|string $key
     * @return string
     */
    public function encode($key): string;

    /**
     * Decode a hash back to an id.
     *
     * @param string $hash
     * @return int|string|null
     */
    public function decode(string $hash);
}