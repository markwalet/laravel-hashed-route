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
     * @param int $id
     * @return int|string
     */
    public function encode(int $id);

    /**
     * Decode a has back to an id.
     *
     * @param string|int $hash
     * @return int|null
     */
    public function decode($hash);
}