<?php

namespace MarkWalet\LaravelHashedRoute\Codecs;

use InvalidArgumentException;
use MarkWalet\LaravelHashedRoute\Exceptions\MissingDriverException;

class CodecFactory
{
    /**
     * Create a new codec based on the given configuration.
     *
     * @param array $configuration
     * @return Codec
     */
    public function make(array $configuration): Codec
    {
        $configuration = $this->parseConfiguration($configuration);

        return $this->createCodec($configuration['driver'], $configuration);
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
     * Create a new codec instance.
     *
     * @param string $driver
     * @param array $config
     * @return Codec
     * @throws MissingDriverException
     */
    protected function createCodec(string $driver, array $config): Codec
    {
        switch ($driver) {
            case 'null':
                return new NullCodec($config);
            case 'hashids':
                return new HashidsCodec($config);
            default:
                throw new MissingDriverException("Driver {$driver} is not supported for codec.");
        }
    }
}