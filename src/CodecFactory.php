<?php

namespace MarkWalet\LaravelHashedRoute;

use MarkWalet\LaravelHashedRoute\Codecs\Base64Codec;
use MarkWalet\LaravelHashedRoute\Codecs\Codec;
use MarkWalet\LaravelHashedRoute\Codecs\HashidsCodec;
use MarkWalet\LaravelHashedRoute\Codecs\NullCodec;
use MarkWalet\LaravelHashedRoute\Codecs\OptimusCodec;
use MarkWalet\LaravelHashedRoute\Exceptions\MissingDriverException;

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
