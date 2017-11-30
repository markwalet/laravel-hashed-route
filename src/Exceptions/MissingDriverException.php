<?php

namespace MarkWalet\LaravelHashedRoute\Exceptions;

use Exception;
use Throwable;

class MissingDriverException extends Exception
{
    /**
     * InvalidModelException constructor.
     *
     * @param string $message
     * @param int $code
     * @param \Throwable|null $previous
     */
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}