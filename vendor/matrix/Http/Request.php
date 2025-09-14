<?php

declare(strict_types=1);

namespace Matrix\Http;

class Request
{
    public const METHOD_GET = 'GET';
    public const METHOD_PUT = 'PUT';
    public const METHOD_POST = 'POST';
    public const METHOD_DELETE = 'DELETE';

    private static string $method;

    private static string $uri;

    private static string $rawPath;

    private static string $rawQuery;

    private static string $prefix;

    private static array $path;

    private static array $query;

    private static null|string|array $content;

    private static $formats = [
        'html' => ['text/html', 'application/xhtml+xml'],
        'json' => ['application/json', 'application/x-json'],
        'form' => ['application/x-www-form-urlencoded', 'multipart/form-data'],
    ];

    /**
     * Build a Request
     * 
     * @param null|string $uri Give URI to custom (default : REQUEST_URI)
     * @param null|string $method Give METHOD to custom (default : REQUEST_METHOD)
     */
    public function __construct(null|string $uri = null, null|string $method = null)
    {
        self::$uri = $uri ?? $_SERVER['REQUEST_URI'];
        self::$method = null !== $method ? strtoupper($method) : strtoupper($_SERVER['REQUEST_METHOD']);

        if (self::METHOD_POST === self::$method || self::METHOD_PUT === self::$method) {
            $this->extractContent();
        }

        $this->initialize();
    }

    public function getMethod(): string
    {
        return self::$method;
    }

    public function getUri(): string
    {
        return self::$uri;
    }

    public function getPrefix(): string
    {
        return self::$prefix;
    }

    public function getPath(): array
    {
        return self::$path ?? [];
    }

    public function getRawPath(): string
    {
        return self::$rawPath ?? '';
    }

    public function getQuery(): array
    {
        return self::$query ?? [];
    }

    public function getRawQuery(): string
    {
        return self::$rawQuery ?? '';
    }

    public function getContent(): null|string|array
    {
        return self::$content;
    }

    private function extractContent(): void
    {
        if (!isset($_SERVER['CONTENT_TYPE'])) {
            $_SERVER['CONTENT_TYPE'] = self::$formats['json'][0];
        }

        if (str_contains($_SERVER['CONTENT_TYPE'], self::$formats['form'][0]) || str_contains($_SERVER['CONTENT_TYPE'], self::$formats['form'][1])) {
            self::$content = $_POST;
        } else {
            $fileContent = file_get_contents('php://input');
            self::$content = false === $fileContent ? null : json_decode($fileContent, true);
        }
    }

    private function initialize(): void
    {
        $parsed = parse_url(self::$uri);

        if (isset($parsed['path'])) {
            self::$rawPath = trim($parsed['path'], '/');
            self::$path = explode('/', trim($parsed['path'], '/'));

            if (false !== current(self::$path)) {
                self::$prefix = array_shift(self::$path);
            }

            self::$path[0] = self::$path[0] ?? '';
        }

        if (isset($parsed['query'])) {
            self::$rawQuery = $parsed['query'];
            self::$query = $_GET;
        }
    }
}
