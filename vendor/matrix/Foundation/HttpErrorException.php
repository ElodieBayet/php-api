<?php

declare(strict_types=1);

namespace Matrix\Foundation;

class HttpErrorException extends \Exception
{
    private int $httpCode;

    public function __construct(string $message, int $httpCode, int $code = 0)
    {
        $this->message = $message;
        $this->httpCode = $httpCode;

        parent::__construct($message, $code);
    }

    public function getHttpCode(): int
    {
        return $this->httpCode;
    }
}