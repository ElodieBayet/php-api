<?php

declare(strict_types=1);

namespace Matrix\Model;

#[\Attribute]
class Group
{
    private array $list;

    public function __construct(array $list)
    {
        $this->list = $list;
    }

    public function getList(): array
    {
        return $this->list;
    }
}