<?php

namespace MarkWalet\LaravelHashedRoute\Codecs;

use Jenssegers\Optimus\Optimus;
use MarkWalet\LaravelHashedRoute\Exceptions\InvalidHashException;
use MarkWalet\LaravelHashedRoute\Exceptions\UnsupportedKeyTypeException;
use MarkWalet\LaravelHashedRoute\RequiresConfigurationKeys;

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
     * @throws UnsupportedKeyTypeException
     */
    public function encode($key)
    {
        // Only supports integer keys.
        if (is_int($key) === false) {
            throw new UnsupportedKeyTypeException('Optimus codec only supports integer key types.');
        }

        return $this->optimus->encode($key);
    }

    /**
     * Decode a has back to an id.
     *
     * @param int|string $hash
     * @return int
     * @throws InvalidHashException
     */
    public function decode($hash)
    {
        // Return null if key is not numeric.
        if (is_int($hash) === false) {
            throw new InvalidHashException;
        }

        return $this->optimus->decode((int) $hash);
    }
}
