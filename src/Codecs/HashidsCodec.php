<?php

namespace MarkWalet\LaravelHashedRoute\Codecs;

use Hashids\Hashids;
use MarkWalet\LaravelHashedRoute\Exceptions\UnsupportedKeyTypeException;

class HashidsCodec implements Codec
{
    use RequiresConfigurationKeys;

    /**
     * Hashids instance.
     *
     * @var Hashids
     */
    private $hashids;

    /**
     * Boot the codec up.
     *
     * @param array $config
     */
    public function __construct(array $config = [])
    {
        $this->require(['salt', 'minimum_length'], $config);

        $this->hashids = (isset($config['alphabet']))
            ? new Hashids($config['salt'], $config['minimum_length'], $config['alphabet'])
            : new Hashids($config['salt'], $config['minimum_length']);
    }

    /**
     * Generate a hash for a given id.
     *
     * @param int $key
     * @return string
     * @throws \MarkWalet\LaravelHashedRoute\Exceptions\UnsupportedKeyTypeException
     */
    public function encode($key): string
    {
        // Only supports integer keys.
        if (is_int($key) === false) {
            throw new UnsupportedKeyTypeException("Hashids codec only supports integer key types.");
        }

        return $this->hashids->encode($key);
    }

    /**
     * Decode a has back to an id.
     *
     * @param string $hash
     * @return int|string|null
     */
    public function decode(string $hash)
    {
        $results = $this->hashids->decode($hash);

        return (count($results) > 0) ? (int) $results[0] : null;
    }
}