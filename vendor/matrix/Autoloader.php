<?php

declare(strict_types=1);

class Autoloader
{
    private static $namespaces = [];

    private static $root = '';

    /**
     * Register classes and optionally define special libraries if so.
     *
     * @param array $namespaces Associations of namespace and directory.
     *
     * @uses spl_autoload_register() and callback self::loader
     */
    public static function register(array $namespaces, string $root): void
    {
        self::$namespaces = $namespaces;
        self::$root = $root;

        spl_autoload_register('Autoloader::loader');
    }

    /**
     * @param string $address Autoimplemented address of classes
     */
    private static function loader(string $address): bool
    {
        $ns = substr($address, 0, (int)strpos($address, '\\'));
        $filepath = str_replace('\\', DIRECTORY_SEPARATOR, $address);

        if (array_key_exists($ns, self::$namespaces)) {
            $filepath = str_replace($ns, self::$namespaces[$ns] . DIRECTORY_SEPARATOR . strtolower($ns), $filepath);
        } elseif (str_contains($filepath, $ns)) {
            $filepath = str_replace($ns, 'src', $filepath);
        }

        $file = self::$root . DIRECTORY_SEPARATOR . $filepath . '.php';

        if (is_file($file)) {
            require $file;
            return true;
        }

        return false;
    }
}
