<?php

namespace MarkWalet\LaravelHashedRoute\Codecs;

use InvalidArgumentException;
use MarkWalet\LaravelHashedRoute\Exceptions\MissingDriverException;
use MarkWalet\LaravelHashedRoute\RequiresConfigurationKeys;

class CodecFactory
{
    use RequiresConfigurationKeys;

    /**
     * Create a new codec based on the given configuration.
     *
     * @param array $configuration
     * @return Codec
     * @throws MissingDriverException
     */
    public function make(array $configuration): Codec
    {
        $this->require('driver', $configuration);

        return $this->createCodec($configuration['driver'], $configuration);
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
            case 'optimus':
                return new OptimusCodec($config);
            case 'base64':
                return new Base64Codec($config);
            default:
                throw new MissingDriverException("Driver {$driver} is not supported for codec.");
        }
    }
}
