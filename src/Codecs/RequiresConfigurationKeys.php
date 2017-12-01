<?php

namespace MarkWalet\LaravelHashedRoute\Codecs;


use MarkWalet\LaravelHashedRoute\Exceptions\InvalidArgumentException;

trait RequiresConfigurationKeys
{
    /**
     * Make sure certain items are present in the configuration array.
     *
     * @param array $required
     * @param array $config
     * @throws InvalidArgumentException
     */
    protected function require(array $required, array $config)
    {
        $name = $config['name'] ?? 'undefined';
        foreach($required as $r) {
            if (isset($config[$r]) === false) {
                throw new InvalidArgumentException("Missing '{$r}' for {$name} codec configuration");
            }
        }
    }
}