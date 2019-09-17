<?php

namespace MarkWalet\LaravelHashedRoute;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\Arr;
use MarkWalet\LaravelHashedRoute\Codecs\Codec;
use MarkWalet\LaravelHashedRoute\Exceptions\MissingConfigurationException;

/**
 * Class HashedRouteManager.
 *
 * @method string encode($key)
 * @method int|string|null decode(string $hash)
 */
class HashedRouteManager
{
    /**
     * The application instance.
     *
     * @var Application
     */
    protected $app;

    /**
     * The codec factory instance.
     *
     * @var CodecFactory
     */
    private $factory;

    /**
     * The active codec instances.
     *
     * @var array
     */
    protected $codecs = [];

    /**
     * HashedRouteManager constructor.
     *
     * @param Application $app
     * @param CodecFactory $factory
     */
    public function __construct(Application $app, CodecFactory $factory)
    {
        $this->app = $app;
        $this->factory = $factory;
    }

    /**
     * Create a codec for the given name.
     *
     * @param string|null $name
     * @return Codec
     * @throws Exceptions\MissingDriverException
     */
    public function codec(string $name = null)
    {
        // Set the name to default when null.
        $name = $name ?: $this->getDefaultCodec();

        // Get configuration.
        $configuration = $this->configuration($name);

        // Return the codec when it is already initialized.
        if (array_key_exists($name, $this->codecs)) {
            return $this->codecs[$name];
        }

        // Make and return new instance of codec.
        return $this->codecs[$name] = $this->factory->make($configuration);
    }

    /**
     * Get the configuration for a codec.
     *
     * @param  string $name
     * @return array
     * @throws MissingConfigurationException
     */
    protected function configuration(string $name)
    {
        // Get a list of codecs.
        $codecs = $this->app['config']['hashed-route.codecs'];

        // Throw exception when configuration is not found.
        if (array_key_exists($name, $codecs) === false) {
            throw new MissingConfigurationException("Codec [$name] not configured.");
        }

        // Return codec configuration.
        return Arr::add($codecs[$name], 'name', $name);
    }

    /**
     * Get the default codec name.
     *
     * @return string
     */
    public function getDefaultCodec(): string
    {
        return $this->app['config']['hashed-route.default'];
    }

    /**
     * Set the default codec name.
     *
     * @param string $name
     */
    public function setDefaultCodec(string $name)
    {
        $this->app['config']['hashed-route.default'] = $name;
    }

    /**
     * Return all of the created codecs.
     *
     * @return array
     */
    public function getCodecs()
    {
        return $this->codecs;
    }

    /**
     * Dynamically pass methods to the default codec.
     *
     * @param string $method
     * @param array $parameters
     * @return mixed
     * @throws Exceptions\MissingDriverException
     */
    public function __call($method, $parameters)
    {
        return $this->codec()->$method(...$parameters);
    }
}
