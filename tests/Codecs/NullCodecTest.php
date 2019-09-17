<?php

namespace MarkWalet\LaravelHashedRoute\Tests\Codecs;

use MarkWalet\LaravelHashedRoute\Codecs\Codec;
use MarkWalet\LaravelHashedRoute\Codecs\NullCodec;
use PHPUnit\Framework\TestCase;

class NullCodecTest extends TestCase
{
    use CodecTests;

    /**
     * Get a hash generator instance.
     *
     * @return Codec
     */
    public function codec()
    {
        return new NullCodec;
    }
}
