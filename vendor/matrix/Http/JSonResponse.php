<?php 

declare(strict_types=1);

namespace Matrix\Http;

class JSonResponse extends Response
{
    protected static array $defaultHeaders = [
        'Content-Type' => "application/json; charset=UTF-8",
    ];

    function __construct(string $body, int $statusCode = self::HTTP_OK, array $headers = [])
    {
        parent::__construct($body, $statusCode, $headers);
    }
}
