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

    ///**
    // * Generate a hash for a given id.
    // *
    // * @param int $id
    // * @return int|string
    // */
    //public function decode(int $id);
}