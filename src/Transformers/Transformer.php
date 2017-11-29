<?php

namespace MarkWalet\LaravelHashedRoute\HashGenerators;

interface Transformer
{
    /**
     * Generate a hash for a given id.
     *
     * @param int $id
     * @return int|string
     */
    public function encode(int $id);
}