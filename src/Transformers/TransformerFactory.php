<?php

namespace MarkWalet\LaravelHashedRoute\Transformers;

use InvalidArgumentException;
use MarkWalet\LaravelHashedRoute\Exceptions\MissingDriverException;

class TransformerFactory
{
    /**
     * Create a new transformer based on the given configuration.
     *
     * @param array $configuration
     * @return Transformer
     */
    public function make(array $configuration): Transformer
    {
        $configuration = $this->parseConfiguration($configuration);

        return $this->createTransformer($configuration['driver'], $configuration);
    }

    /**
     * Append name to configuration.
     *
     * @param array $config
     * @return array
     */
    protected function parseConfiguration(array $config): array
    {
        // Throw exception when no driver is given.
        if (isset($config['driver']) === false) {
            throw new InvalidArgumentException("A driver must be specified.");
        }

        return $config;
    }

    /**
     * Create a new transformer instance.
     *
     * @param string $driver
     * @param array $config
     * @return Transformer
     * @throws MissingDriverException
     */
    protected function createTransformer(string $driver, array $config): Transformer
    {
        switch($driver) {
            case 'null':
                return new NullTransformer($config);
            case 'hashids':
                return new HashidsTransformer($config);
            default:
                throw new MissingDriverException("Driver is not supported for transformer.");
        }
    }
}