<?php

namespace MarkWalet\LaravelHashedRoute\HashGenerators;

use Illuminate\Database\Eloquent\Model;

interface HashGenerator
{
    /**
     * Generate a hash for a given id.
     *
     * @param int $id
     * @return int|string
     */
    public function generate(int $id);

    /**
     * Generate a hash for a given model.
     *
     * @param \Illuminate\Database\Eloquent\Model $model
     * @return int|string
     */
    public function generateFor(Model $model);
}