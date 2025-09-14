<?php

declare(strict_types=1);

namespace Matrix\Foundation;

trait EnvironmentTrait
{
    private static bool $isDebugging = true;

    protected function isDebugging(): bool
    {
        return self::$isDebugging;
    }

    protected function setIsDebugging(bool $isDebugging): void
    {
        self::$isDebugging = $isDebugging;
    }

    protected function getContext(): string
    {
        return defined('APP_ENV')? APP_ENV : 'production';
    }

    protected function getDatabase(): array
    {
        return defined('DATABASE')? DATABASE : [];
    }
}
