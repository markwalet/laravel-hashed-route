<?php

namespace MarkWalet\LaravelHashedRoute\Codecs;

use MarkWalet\LaravelHashedRoute\RequiresConfigurationKeys;

class Base64Codec implements Codec
{
    use RequiresConfigurationKeys;

    /**
     * The salt that is used for encoding and decoding the key.
     *
     * @var string
     */
    private $salt;

    /**
     * Boot the codec up.
     *
     * @param array $config
     */
    public function __construct(array $config = [])
    {
        $this->require(['salt'], $config);

        $this->salt = $config['salt'];
    }

    /**
     * Generate a hash for a given id.
     *
     * @param int|string $key
     * @return string
     */
    public function encode($key)
    {
        return base64_encode($this->salt . $key);
    }

    /**
     * Decode a hash back to an id.
     *
     * @param string $hash
     * @return int|string|null
     */
    public function decode($hash)
    {
        $result = base64_decode($hash, true);

        // Return null if the hash is not valid or when the result doesn't start with the salt.
        if ($result === false || substr($result, 0, strlen($this->salt)) !== $this->salt) {
            return null;
        }

        return substr($result, strlen($this->salt));
    }
}
