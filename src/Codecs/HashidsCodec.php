<?php

namespace MarkWalet\LaravelHashedRoute\Codecs;

use Hashids\Hashids;

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
     * @param int $id
     * @return int|string
     */
    public function encode(int $id)
    {
        return $this->hashids->encode($id);
    }

    /**
     * Decode a has back to an id.
     *
     * @param string|int $hash
     * @return int
     * @return int|null
     */
    public function decode($hash)
    {
        $results = $this->hashids->decode($hash);

        return (count($results) > 0) ? (int) $results[0] : null;
    }
}