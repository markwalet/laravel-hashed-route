<?php

namespace MarkWalet\LaravelHashedRoute\Transformers;

use Hashids\Hashids;

class HashidsTransformer implements Transformer
{
    use RequiresConfigurationKeys;

    /**
     * Hashids instance.
     *
     * @var Hashids
     */
    private $hashids;

    /**
     * Boot the transformer up.
     *
     * @param array $config
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
}