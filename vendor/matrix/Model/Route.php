<?php

declare(strict_types=1);

namespace Matrix\Model;

#[\Attribute]
class Route
{
    private array $methods;
   
    private string $path;

    private null|string $validation;

    private string $name;

    private null|string $pathRegEx = null;

    public function __construct(string $path, array $methods, string $name, null|string $validation = null)
    {
        $this->path = $path;
        $this->methods = $methods;
        $this->validation = $validation;
        $this->name = $name;

        if (null !== $validation) {
            $this->pathRegEx = $this->pathRegExpBuilder($path, $this->validation);
        }
    }

    public function getPath(): string
    {
        return $this->path;
    }

    public function getMethods(): array
    {
        return $this->methods;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function isMethodMatch(string $httpVerb): bool
    {
        return in_array($httpVerb, $this->methods, true);
    }

    public function isUrlMatch(string $slug): bool
    {
        return null !== $this->pathRegEx ? 1 === preg_match($this->pathRegEx, $slug) : $this->path === $slug;
    }

    /**
     * Build Regular Expression for route validation
     */
    private function pathRegExpBuilder(string $path, string $validation): string
    {
        $pathRegEx = '#^';
        $pathParts = explode('/', trim($path, '/'));

        foreach ($pathParts as $part) {
            $pathRegEx .= '\/';
            $pathRegEx .= preg_match('#\{\w+\}#', $part) ? $validation : '\b' . $part . '\b' ;
        }

        $pathRegEx .= '$#';

        return $pathRegEx;
    }
}