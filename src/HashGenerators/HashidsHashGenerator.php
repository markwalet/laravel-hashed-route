<?php

namespace MarkWalet\LaravelHashedRoute\HashGenerators;

use Hashids\Hashids;

class HashidsHashGenerator implements HashGenerator
{
    use GeneratesHashForModel;

    /**
     * List of allowed characters in the hash.
     *
     * @var string
     */
    protected $alphabet = 'abcdefghijklmnopqrstuvwxyz1234567890';

    /**
     * Hashids instance.
     *
     * @var \Hashids\Hashids
     */
    private $hashids;

    /**
     * HashidsHashGenerator constructor.
     *
     * @param string $salt
     * @param int $length
     */
    public function __construct(string $salt, int $length = 10)
    {
        $this->hashids = new Hashids($salt, $length, $this->alphabet);
    }

    /**
     * Generate a hash for a given id.
     *
     * @param int $id
     * @return int|string
     */
    public function generate(int $id)
    {
        return $this->hashids->encode($id);
    }
}