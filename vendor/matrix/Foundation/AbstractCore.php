<?php

declare(strict_types=1);

namespace Matrix\Foundation;

use Matrix\Foundation\EnvironmentTrait;

/**
 * Neutral Kernel of application
 *
 * @uses ./config/routes.php
 * @uses ./env.local.php
 * @uses ./env.php If missing ./env.local.php
 */
abstract class AbstractCore
{
    use EnvironmentTrait;

    /** @var string $prefix */
    protected static $prefix;

    /** @var array $apiRoutes */
    protected static $apiRoutes;

    public function __construct()
    {
        $this->implementEnvironment();
        $this->implementApiRoutes();
    }

    private function implementEnvironment(): void
    {
        $environment = '';

        if (is_file('./env.local.php')) {
            $environment = 'env.local.php';
        } elseif (is_file('./env.php')) {
            $environment = 'env.php';
        } else {
            throw new \Exception("Can't find files 'env.local.php' nor 'env.php'");
        }

        require './' . $environment;

        if (!defined('APP_DEBUG') && !defined('DATABASE')) {
            throw new \Exception("Can't find variables 'APP_DEBUG' and 'DATABASE'");
        }

        $this->setIsDebugging(APP_DEBUG);
    }

    private function implementApiRoutes(): void
    {
        if (is_file('./config/routes.php')) {
            $routes = require './config/routes.php';

            if (!is_array($routes)) {
                throw new \Exception("The file 'config/routes.php' is not an array");
            }

            if (!array_key_exists('prefix', $routes)) {
                throw new \Exception("Can't find 'prefix' in 'config/routes.php'");
            }

            if (!array_key_exists('routes', $routes)) {
                throw new \Exception("Can't find array key 'routes' in 'config/routes.php'");
            }

            self::$prefix = $routes['prefix'];
            self::$apiRoutes = $routes['routes'];
        } else {
            throw new \Exception("Can't find file 'config/routes.php'");
        }
    }
}