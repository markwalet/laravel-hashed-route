<?php

namespace MarkWalet\LaravelHashedRoute\Codecs;

use MarkWalet\LaravelHashedRoute\Exceptions\InvalidHashException;

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
     * @return int|string
     */
    public function encode($key);

    /**
     * Decode a hash back to an id.
     *
     * @param int|string $hash
     * @return int|string
     * @throws InvalidHashException
     */
    public function decode($hash);
}
