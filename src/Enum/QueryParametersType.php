<?php

declare(strict_types=1);

namespace App\Enum;

enum QueryParametersType: string
{
    case Sort = 'sort';
    case Desc = 'desc';
    case Origin = 'origin';
    case Lastname = 'lastname';
    case BornBefore = 'born_before';
    case BornAfter = 'born_after';
    case DeadBefore = 'dead_before';
    case DeadAfter = 'dead_after';

    private const SEARCHING_CASES = [
        self::Origin,
        self::Lastname,
    ];

    private const FILTERING_CASES = [
        self::BornBefore,
        self::BornAfter,
        self::DeadBefore,
        self::DeadAfter,
    ];

    /**
     * Remove unauthorized query parameters
     * 
     * @param array $queries Mapped query strings in an associative array as parameter => value
     * @return array Associative array or empty if no match
     */
    public static function filter(array $queries): array
    {
        $filtered = array_filter($queries, function($key) {
            return null !== self::tryFrom($key);
        }, ARRAY_FILTER_USE_KEY);

        return $filtered;
    }

    /**
     * Get enum cases for filtering
     * 
     * @param array $parameters Mapped keys of query strings in a scalar array
     * @return array Scalar with cases or empty if no match
     */
    public static function getFilteringCases(array $parameters): array
    {
        $cases = array_filter(self::FILTERING_CASES, function($case) use ($parameters) {
            return in_array($case->value, $parameters);
        });

        return $cases;
    }

    /**
     * Get enum cases for searching
     * 
     * @param array $parameters Mapped keys of query strings in a scalar array
     * @return array Scalar with cases or empty if no match
     */
    public static function getSearchingCases(array $parameters): array
    {
        $cases = array_filter(self::SEARCHING_CASES, function($case) use ($parameters) {
            return in_array($case->value, $parameters);
        });

        return $cases;
    }

    /**
     * Get SQL statement for filtering or seraching
     * 
     * @param $case Enum case pre-matched with query parameter
     */
    public static function getWhereStatement(self $case): string
    {
        return match($case) {
            self::BornBefore => 'compositor.birth < ":born_before"',
            self::BornAfter => 'compositor.birth > ":born_after"',
            self::DeadBefore => 'compositor.death > ":dead_before"',
            self::DeadAfter => 'compositor.death < ":dead_after"',
            self::Origin => 'compositor.origin LIKE :origin',
            self::Lastname => 'compositor.lastname LIKE :lastname'
        };
    }
}