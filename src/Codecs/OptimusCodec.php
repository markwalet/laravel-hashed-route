<?php

namespace MarkWalet\LaravelHashedRoute\Codecs;

use Hashids\Hashids;
use Jenssegers\Optimus\Optimus;
use MarkWalet\LaravelHashedRoute\Exceptions\UnsupportedKeyTypeException;

class OptimusCodec implements Codec
{
    use RequiresConfigurationKeys;

    /**
     * Optimus instance.
     *
     * @var Optimus
     */
    private $optimus;

    /**
     * Boot the codec up.
     *
     * @param array $config
     */
    public function __construct(array $config = [])
    {
        $this->require(['prime', 'inverse', 'random'], $config);

        $this->optimus = new Optimus($config['prime'], $config['inverse'], $config['random']);
    }

    /**
     * Generate a hash for a given id.
     *
     * @param int $key
     * @return int
     * @throws \MarkWalet\LaravelHashedRoute\Exceptions\UnsupportedKeyTypeException
     */
    public function encode($key)
    {
        // Only supports integer keys.
        if (is_numeric($key) === false) {
            throw new UnsupportedKeyTypeException("Optimus codec only supports integer key types.");
        }

        return $this->optimus->encode($key);
    }

    /**
     * Decode a has back to an id.
     *
     * @param int|string $hash
     * @return int
     */
    public function decode($hash)
    {
        if (is_int($hash) === false) {
            return null;
        }

        return $this->optimus->decode($hash);
    }
}