<?php

declare(strict_types=1);

namespace Matrix\Database;

use Matrix\Foundation\EnvironmentTrait;

/**
 * @uses \PDO
 * @uses EnvironmentTrait
 */
abstract class AbstractDatabase
{
    use EnvironmentTrait;

    /** @var \PDO $pdo */
    protected static $pdo = null;

    private static $options = [
        // Enable PDOException : alert codes
        \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
        // Retrieve mode as an associated array : the key is the name of the column
        \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
        // Use native interface for prepared sql-requests
        \PDO::ATTR_EMULATE_PREPARES => false,
    ];

    /**
     * Build a single connection to database
     */
    public function __construct()
    {
        if (null === self::$pdo) {
            self::$pdo = $this->connection($this->getDatabase());
        }
    }

    /**
     * Open a connection with Database
     *
     * @param array $database Connection logins with values for keys 'dsn', 'user', 'word' 
     * @return PDO or throw Exception
     */
    private function connection(array $db): \PDO
    {
        try {
            return new \PDO($db['dsn'], $db['user'], $db['word'], self::$options);
        } catch (\PDOException $pdoError) {
            if ($this->isDebugging()) {
                echo "Database ::\r\n" . $pdoError->getMessage();
                exit;
            }
            throw new \Exception("Can't connect to database for reason\r\n" . $pdoError->getMessage());
        }
    }
}
