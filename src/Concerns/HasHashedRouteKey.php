<?php

namespace MarkWalet\LaravelHashedRoute\Concerns;

use Illuminate\Database\Eloquent\Model;
use MarkWalet\LaravelHashedRoute\Codecs\Codec;
use MarkWalet\LaravelHashedRoute\Exceptions\InvalidHashException;
use MarkWalet\LaravelHashedRoute\Exceptions\MissingDriverException;
use MarkWalet\LaravelHashedRoute\HashedRouteManager;

/**
 * Trait HasHashedRouteKey.
 *
 * @property string|int hashed_key
 * @method string getRouteKeyName()
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
     * Get the value of the model's route key.
     *
     * @return mixed
     * @throws MissingDriverException
     */
    public function getRouteKey()
    {
        return $this->getCodec()->encode(parent::getRouteKey());
    }

    /**
     * Retrieve the model for a bound value.
     *
     * @param mixed $value
     * @return Model|null
     * @throws MissingDriverException
     */
    public function resolveRouteBinding($value)
    {
        try {
            $value = $this->getCodec()->decode($value);
        } catch (InvalidHashException $e) {
            return null;
        }

        return self::query()->where($this->getRouteKeyName(), $value)->first();
    }

    /**
     * Resolve a connection instance.
     *
     * @param string|null $codec
     * @return Codec
     * @throws MissingDriverException
     */
    public static function resolveCodec(string $codec = null)
    {
        return static::$routeManager->codec($codec);
    }

    /**
     * Get the hashed route codec for the model.
     *
     * @return Codec
     * @throws MissingDriverException
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
