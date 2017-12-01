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
     * The codec name.
     *
     * @var string
     */
    protected $codec;

    /**
     * Boot the trait up.
     */
    public static function bootHasHashedRouteKey()
    {
        self::$routeManager = app(HashedRouteManager::class);
    }

    /**
     * Retrieve the model for a bound value.
     *
     * @param  mixed $value
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function resolveRouteBinding($value)
    {
        return $this->where($this->getRouteKeyName(), $this->getCodec()->decode($value))->first();
    }

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'hashed_key';
    }

    /**
     * Resolve a connection instance.
     *
     * @param string|null $codec
     * @return \MarkWalet\LaravelHashedRoute\Codecs\Codec
     */
    public static function resolveCodec(string $codec = null)
    {
        return static::$routeManager->codec($codec);
    }

    /**
     * Get the hashed key attribute.
     *
     * @return int|string
     * @throws \MarkWalet\LaravelHashedRoute\Exceptions\UnsupportedKeyTypeException
     */
    public function getHashedKeyAttribute()
    {
        if ($this->getKeyType() !== 'int') {
            throw new UnsupportedKeyTypeException("Only integers are supported as key type.");
        }

        return $this->getCodec()->encode($this->getKey());
    }

    /**
     * Get the hashed route codec for the model
     *
     * @return \MarkWalet\LaravelHashedRoute\Codecs\Codec
     */
    protected function getCodec()
    {
        return static::resolveCodec($this->getCodecName());
    }

    /**
     * Get the codec name.
     *
     * @return string
     */
    public function getCodecName(): string
    {
        return $this->codec ?? config('hashed-route.default');
    }

    /**
     * Set the codec name.
     *
     * @param string $codec
     * @return $this
     */
    public function setCodec(string $codec = null)
    {
        $this->codec = $codec;

        return $this;
    }
}