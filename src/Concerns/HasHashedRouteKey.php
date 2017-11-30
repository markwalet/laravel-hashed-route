<?php

namespace MarkWalet\LaravelHashedRoute\Concerns;

use MarkWalet\LaravelHashedRoute\Exceptions\UnsupportedKeyTypeException;
use MarkWalet\LaravelHashedRoute\HashedRouteManager;

/**
 * Trait HasHashedRouteKey
 *
 * @package MarkWalet\LaravelHashedRoute\Concerns
 * @property string|int hashed_key
 */
trait HasHashedRouteKey
{
    /**
     * The hashed route manager instance.
     *
     * @var HashedRouteManager
     */
    protected static $routeManager;

    /**
     * The transformer name.
     *
     * @var string
     */
    protected $transformer;

    /**
     * Boot the trait up.
     */
    public static function bootHasHashedRouteKey()
    {
        self::$routeManager = app(HashedRouteManager::class);
    }

    /**
     * Resolve a connection instance.
     *
     * @param string|null $transformer
     * @return \MarkWalet\LaravelHashedRoute\Transformers\Transformer
     */
    public static function resolveTransformer(string $transformer = null)
    {
        return static::$routeManager->transformer($transformer);
    }

    /**
     * Retrieve the model for a bound value.
     *
     * @param  mixed $value
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function resolveRouteBinding($value)
    {
        return $this->where($this->getRouteKeyName(), $value)->first();
    }

    public function getHashedKeyAttribute()
    {
        if ($this->getKeyType() !== 'int') {
            throw new UnsupportedKeyTypeException("Only integers are supported as key type.");
        }

        return $this->getTransformer()->encode($this->getKey());
    }

    /**
     * Get the hashed route transformer for the model
     *
     * @return \MarkWalet\LaravelHashedRoute\Transformers\Transformer
     */
    protected function getTransformer()
    {
        return static::resolveTransformer($this->getTransformerName());
    }

    /**
     * Get the transformer name.
     *
     * @return string
     */
    protected function getTransformerName(): string
    {
        return $this->transformer ?? config('hashed-route.default');
    }

    /**
     * Set the transformer name.
     *
     * @param string $transformer
     * @return $this
     */
    public function setTransformer(string $transformer)
    {
        $this->transformer = $transformer;

        return $this;
    }
}