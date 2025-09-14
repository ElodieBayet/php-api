<?php 

declare(strict_types=1);

namespace Matrix\Http;

class Response
{
    public const HTTP_OK = 200;
    public const HTTP_CREATED = 201;
    public const HTTP_NO_CONTENT = 204;
    public const HTTP_BAD_REQUEST = 400;
    public const HTTP_UNAUTHORIZED = 401;
    public const HTTP_FORBIDDEN = 403;
    public const HTTP_NOT_FOUND = 404;
    public const HTTP_UNPROCESSABLE = 422;
    public const HTTP_INTERNAL = 500;

    protected static array $statusTexts = [
        200 => "OK",
        201 => "Ressource Created",
        400 => "Bad Request",
        401 => "Unauthorized",
        403 => "Forbidden",
        404 => "Not Found",
        422 => "Unprocessable Content",
        500 => "Internal Error",
    ];

    protected static array $defaultHeaders = [
        'Content-Type' => "text/html; charset=UTF-8",
    ];

    protected int $statusCode;

    protected array $headers;

    protected string $body;

    /**
     * Build parts for Response
     *
     * @param array $headers List of headers
     * @param string $body HTML body
     */
    function __construct(string $body, int $statusCode = self::HTTP_OK, array $headers = [])
    {
        $this->body = $body;
        $this->statusCode = $statusCode;
        $this->headers = empty($headers) ? static::$defaultHeaders : $headers;
    }

    public function addHeaders(array $headers): void
    {
        $this->headers = array_merge($this->headers, $headers);
    }

    /** 
     * Send headers and write body
     */
    public function send(): void
    {
        foreach ($this->headers as $name => $value) {
            $replace = 0 === strcasecmp($name, 'Content-Type');
            header($name.': '.$value, $replace, $this->statusCode);
        }

        header(sprintf('HTTP/1.1 %s %s', $this->statusCode, self::$statusTexts[$this->statusCode]), true, $this->statusCode);

        echo $this->body;
    }
}
