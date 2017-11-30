<?php

namespace MarkWalet\LaravelHashedRoute;

use Illuminate\Contracts\Foundation\Application;
use MarkWalet\LaravelHashedRoute\Exceptions\MissingConfigurationException;
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
     * @return \MarkWalet\LaravelHashedRoute\Transformers\Transformer
     */
    public function transformer(string $name = null)
    {
        // Set the name to default when null.
        $name = $name ?: $this->getDefaultTransformer();

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
     * @throws \MarkWalet\LaravelHashedRoute\Exceptions\MissingConfigurationException
     */
    protected function configuration(string $name)
    {
        // Get list of transformers.
        $transformers = $this->app['config']['hashed-route.transformers'];

        // Throw exception when configuration is not found.
        if (array_key_exists($name, $transformers) === false) {
            throw new MissingConfigurationException("Transformer [$name] not configured.");
        }

        // Return transformer configuration.
        return array_add($transformers[$name], 'name', $name);
    }

    /**
     * Get the default transformer name.
     *
     * @return string
     */
    public function getDefaultTransformer(): string
    {
        return $this->app['config']['hashed-route.default'];
    }

    /**
     * Set the default transformer name.
     *
     * @param string $name
     */
    public function setDefaultTransformer(string $name)
    {
        $this->app['config']['hashed-route.default'] = $name;
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
     * @param  string $method
     * @param  array $parameters
     * @return mixed
     */
    public function __call($method, $parameters)
    {
        return $this->transformer()->$method(...$parameters);
    }
}