<?php

namespace MarkWalet\LaravelHashedRoute\Transformers;

interface Transformer
{
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