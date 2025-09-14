<?php

declare(strict_types=1);

namespace Matrix\Database;

use Matrix\Database\AbstractDatabase;
use Matrix\Foundation\EnvironmentTrait;

class EntityRepository extends AbstractDatabase
{
    use EnvironmentTrait;

    /**
     * Handle a query to get one tuple
     *
     * @uses PDOStatement::setFetchMode at PDO::FETCH_CLASS
     * @uses PDOStatement::fetch
     *
     * @param string $sql Request in SQL
     * @param string $entity Class name
     * @param array $params List of key => value to bind
     *
     * @return mixed Instance or null
     */
    public function queryFetch(string $sql, string $entity, array $params): mixed
    {
        $tuple = null;

        try {
            $statement = self::$pdo->prepare($sql);
            $statement->execute($params);
            if (false === $statement->setFetchMode(\PDO::FETCH_CLASS, $entity)) {
                throw new \PDOException("Implementation of entity '$entity' default : " . $statement);
            }
            $tuple = $statement->fetch();
            $statement->closeCursor();
        } catch (\PDOException $queryError) {
            if ($this->isDebugging()) {
                echo "Database ::\r\n" . $queryError->getMessage();
                exit;
            }
        }

        return false === $tuple ? null : $tuple;
    }

    /**
     * Handle a query to get a collection of tuples
     *
     * @uses PDOStatement::setFetchMode at PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE
     * @uses PDOStatement::fetchAll
     *
     * @param string $sql Request in SQL
     * @param string $entity Class name
     * @param array $params List of key => value to bind
     *
     * @return array Collection of instance or empty
     */
    public function queryFetchAll(string $sql, string $entity, array $params = []): array
    {
        $collection = [];

        try {
            if (empty($params)) {
                $statement = self::$pdo->query($sql);
            } else {
                $statement = self::$pdo->prepare($sql);
                $statement->execute($params);
            }
            $statement->setFetchMode(\PDO::FETCH_CLASS|\PDO::FETCH_PROPS_LATE, $entity);
            $collection = $statement->fetchAll();
            $statement->closeCursor();
        } catch (\PDOException $queryError) {
            if ($this->isDebugging()) {
                echo "Database ::\r\n" . $queryError->getMessage();
                exit;
            }
        }

        return $collection;
    }

    /**
     * Handle a query to insert
     *
     * @param string $sql Request in SQL
     * @param array $params List of key => value to bind
     *
     * @return int Inserted tuple id
     */
    public function queryInsert(string $sql, array $params): int
    {
        $id = 0;

        try {
            $statement = self::$pdo->prepare($sql);
            $statement->execute($params);
            $id = self::$pdo->lastInsertId();
            $statement->closeCursor();
        } catch (\PDOException $queryError) {
            if ($this->isDebugging()) {
                echo "Database ::\r\n" . $queryError->getMessage();
                exit;
            }
        }

        return (int) $id;
    }

    /**
     * Handle a query to update or delete
     *
     * @param string $sql Request in SQL
     * @param array $params List of key => value to bind
     *
     * @return int Quantity of rows affected
     */
    public function queryEdit(string $sql, array $params): int
    {
        $qty = 0;

        try {
            $statement = self::$pdo->prepare($sql);
            $statement->execute($params);
            $qty = $statement->rowCount();
            $statement->closeCursor();
        } catch (\PDOException $queryError) {
            if ($this->isDebugging()) {
                echo "Database ::\r\n" . $queryError->getMessage();
                exit;
            }
        }

        return $qty;
    }

    public function queryFetchEnumerate(string $sql, array $params = []): array
    {
        $serial = [];
        
        try {
            if (empty($params)) {
                $statement = self::$pdo->query($sql);
            } else {
                $statement = self::$pdo->prepare($sql);
                $statement->execute($params);
            }
            $serial = $statement->fetchAll(\PDO::FETCH_COLUMN);
            $statement->closeCursor();
        } catch (\PDOException $queryError) {
            if ($this->isDebugging()) {
                echo "Database ::\r\n" . $queryError->getMessage();
                exit;
            }
        }

        return $serial;
    }
}
