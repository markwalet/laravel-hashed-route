<?php

namespace MarkWalet\LaravelHashedRoute;

use Illuminate\Support\Arr;
use MarkWalet\LaravelHashedRoute\Exceptions\InvalidArgumentException;

trait RequiresConfigurationKeys
{
    /**
     * Make sure certain items are present in the configuration array.
     *
     * @param array $config
     * @param array|string $required
     * @throws InvalidArgumentException
     */
    protected function require($required, array $config)
    {
        $required = Arr::wrap($required);

        foreach ($required as $r) {
            if (isset($config[$r]) === false) {
                throw new InvalidArgumentException("Missing `{$r}`-key in configuration");
            }
        }
    }
}
