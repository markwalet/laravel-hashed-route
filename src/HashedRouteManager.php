<?php

namespace MarkWalet\LaravelHashedRoute;

use Illuminate\Contracts\Foundation\Application;
use InvalidArgumentException;
use MarkWalet\LaravelHashedRoute\Transformers\TransformerFactory;

class HashedRouteManager
{
    /**
     * The application instance.
     *
     * @var Application
     */
    protected $app;

    /**
     * The transformer factory instance.
     *
     * @var TransformerFactory
     */
    private $factory;

    /**
     * The active transformer instances.
     *
     * @var array
     */
    protected $transformers = [];

    /**
     * HashedRouteManager constructor.
     *
     * @param Application $app
     * @param TransformerFactory $factory
     */
    public function __construct(Application $app, TransformerFactory $factory)
    {
        $this->app = $app;
        $this->factory = $factory;
    }

    /**
     * @param string|null $name
     * @return \MarkWalet\LaravelHashedRoute\Transformers\Transformer|mixed
     */
    public function transformer(string $name = null)
    {
        // Set the name to default when null.
        $name = $name ?: $this->default();

        // Get configuration.
        $configuration = $this->configuration($name);

        // Return the transformer when it is already initialized.
        if (array_key_exists($name, $this->transformers)) {
            return $this->transformers[$name];
        }

        // Make and return new instance of transformer.
        return $this->transformers[$name] = $this->factory->make($configuration);
    }

    /**
     * Get the configuration for a transformer.
     *
     * @param  string $name
     * @return array
     * @throws \InvalidArgumentException
     */
    protected function configuration(string $name)
    {
        // Get list of transformers.
        $transformers = $this->app['config']['hashed-route.transformers'];

        // Throw exception when configuration is not found.
        if (array_key_exists($name, $transformers)) {
            throw new InvalidArgumentException("Transformer [$name] not configured.");
        }

        // Return transformer configuration.
        return $transformers[$name];
    }

    /**
     * Get the default transformer name.
     *
     * @return string
     */
    protected function default(): string
    {
        return $this->app['config']['hashed-route.default'];
    }

    /**
     * Return all of the created transformers.
     *
     * @return array
     */
    public function getTransformers()
    {
        return $this->transformers;
    }

    /**
     * Dynamically pass methods to the default transformer.
     *
     * @param  string  $method
     * @param  array   $parameters
     * @return mixed
     */
    public function __call($method, $parameters)
    {
        return $this->transformer()->$method(...$parameters);
    }
}