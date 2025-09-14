<?php

declare(strict_types=1);

namespace App\Entity;

use Matrix\Database\AbstractEntity;
use Matrix\Model\Group;
use Matrix\Validation\Assertion;

/**
 * All properties are public due to fetch mode PDO::FETCH_CLASS
 */
class Period extends AbstractEntity
{
    #[Group(list: [self::READ, self::READ_ONE])]
    #[Assertion(type: Assertion::STRING, min: 2, max: 32)]
    public string $name;

    #[Group(list: [self::READ, self::READ_ONE])]
    #[Assertion(type: Assertion::INT, min: 100, max: 2100)]
    public int $begin;

    #[Group(list: [self::READ, self::READ_ONE])]
    #[Assertion(type: Assertion::INT, min: 100, max: 2100)]
    public null|int $end;

    #[Group(list: [self::READ, self::READ_ONE])]
    #[Assertion(type: Assertion::STRING, min: 2, max: 128)]
    public string $tag;

    #[Group(list: [self::READ_ONE])]
    #[Assertion(type: Assertion::STRING, min: 2, max: 1024)]
    public string $description;

    public function getName(): string
    {
        return $this->name;
    }

    public function getBegin(): int
    {
        return $this->begin;
    }

    public function getEnd(): null|int
    {
        return $this->end;
    }

    public function getTag(): string
    {
        return $this->tag;
    }

    public function getDescription(): string
    {
        return $this->description;
    }
}
