<?php

declare(strict_types=1);

namespace App\Entity;

use Matrix\Database\AbstractEntity;
use Matrix\Model\Group;
use Matrix\Validation\Assertion;

/**
 * All properties are public due to fetch mode PDO::FETCH_CLASS
 */
class Compositor extends AbstractEntity
{
    public const READ_PERIOD = 'readPeriod';

    #[Group(list: [self::READ, self::READ_ONE, self::READ_PERIOD])]
    #[Assertion(type: Assertion::STRING, min: 2, max: 32)]
    public string $lastname;

    #[Group(list: [self::READ, self::READ_ONE, self::READ_PERIOD])]
    #[Assertion(type: Assertion::STRING, min: 2, max: 32)]
    public string $firstname;

    #[Group(list: [self::READ, self::READ_ONE, self::READ_PERIOD])]
    #[Assertion(type: Assertion::DATE)]
    public string $birth;

    #[Group(list: [self::READ, self::READ_ONE, self::READ_PERIOD])]
    #[Assertion(type: Assertion::DATE)]
    public string $death;

    #[Group(list: [self::READ, self::READ_ONE])]
    #[Assertion(type: Assertion::STRING, min: 3, max: 64, null: true)]
    public null|string $origin = null;

    #[Group(list: [self::READ, self::READ_ONE])]
    #[Assertion(type: Assertion::URL, null: true)]
    public null|string $figure = null;

    #[Group(list: [self::READ_ONE])]
    #[Assertion(type: Assertion::RELATION)]
    public null|string|array $periods = [];

    public function __construct()
    {
        if (is_null($this->periods)) {
            $this->periods = [];
        }

        if (is_string($this->periods)) {
            $this->periods = array_map(function($period) {
                return (int) $period;
            }, explode(', ', $this->periods));
        }
    }

    public function getLastname(): string
    {
        return $this->lastname;
    }

    public function getFirstname(): string
    {
        return $this->firstname;
    }

    public function getBirth(): string
    {
        return $this->birth;
    }

    public function getDeath(): string
    {
        return $this->death;
    }

    public function getOrigin(): null|string
    {
        return $this->origin;
    }

    public function getFigure(): null|string
    {
        return $this->figure;
    }

    public function getPeriods(): string|array
    {
        return $this->periods;
    }

    public function setPeriods(array $periods): self
    {
        $this->periods = array_unique($periods);

        return $this;
    }

    public static function getSortableFields(): array
    {
        // 'birth' is by default
        return ['lastname', 'firstname', 'death', 'origin'];
    }
}
