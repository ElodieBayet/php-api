<?php

declare(strict_types=1);

namespace Matrix\Validation;

#[\Attribute]
class Assertion
{
    public const STRING = 'string';
    public const URL = 'url';
    public const INT = 'int';
    public const DATE = 'date';
    public const RELATION = 'relation';

    private string $type;

    private int $min;

    private int $max;

    private bool $null;

    public function __construct(string $type, int $min = 0, int $max = 0, bool $null = false)
    {
        $this->type = $type;
        $this->min = $min;
        $this->max = $max;
        $this->null = $null;
    }

    public function isNullable(): bool
    {
        return $this->null;
    }

    public function check(mixed $value): array
    {
        if (null === $value && true === $this->null) {
            return [];
        }

        $result = [];

        if (self::STRING === $this->type) {
            if (0 !== $this->min && iconv_strlen($value) < $this->min) {
                $result['too_short'] = "Must contain " . $this->min . " characters minimum";
            }
            if (0 !== $this->max && iconv_strlen($value) > $this->max) {
                $result['too_long'] = "Must contain " . $this->max . " characters maximum";
            }
        }

        if (self::DATE === $this->type) {
            $date = \DateTime::createFromFormat('Y-m-d', $value);
            if (false === $date) {
                $result['format'] = "Must respect format 'YYYY-MM-DD'";
            }
        }

        if (self::URL === $this->type) {
            $url = filter_var($value, FILTER_VALIDATE_URL);
            if (false === $url) {
                $result['format'] = "Must respect format as 'RFC 2396'";
            }
        }

        if (self::INT === $this->type) {
            if (false === is_int($value)) {
                $result['type'] = "Must be an interger";
                return $result;
            }

            $int = filter_var($value, FILTER_VALIDATE_INT, ['options' => ['min_range' => $this->min, 'max_range' => $this->max]]);
            if (false === $int) {
                $result['range'] = "Must fit between " . $this->min . ' and ' . $this->max;
            }
        }

        if (self::RELATION === $this->type) {
            $areIntegers = false;
            if (is_array($value)) {
                $areIntegers = array_all($value, function($int) {
                    return is_int($int) && $int > 0;
                });
            }

            if (false === $areIntegers) {
                $result['type'] = "Must be a list of integer(s) upper than 0 and betwen '[]'";
            }
        }

        return $result;
    }
}