<?php

namespace MarkWalet\LaravelHashedRoute\HashGenerators;

use Illuminate\Database\Eloquent\Model;
use MarkWalet\LaravelHashedRoute\Exceptions\InvalidModelException;

trait GeneratesHashForModel
{
    /**
     * Generate a hash for a given id.
     *
     * @param int $id
     * @return int|string
     */
    public abstract function generate(int $id);

    /**
     * Generate a hash for a given model.
     *
     * @param \Illuminate\Database\Eloquent\Model $model
     * @return int|string
     * @throws \MarkWalet\LaravelHashedRoute\Exceptions\InvalidModelException
     */
    public function generateFor(Model $model)
    {
        // TODO: Test is key type is integer.

        if (is_null($key = $model->getKey())) {
            throw new InvalidModelException("The key for the given model is not set.");
        }

        return $this->generate($key);
    }
}