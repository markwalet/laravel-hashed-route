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


        $this->hashids = new Hashids(...array_values(array_only($config, ['salt', 'minimum_length', 'alphabet'])));
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