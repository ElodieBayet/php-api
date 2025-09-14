<?php

declare(strict_types=1);

namespace Matrix\Database;

use Matrix\Model\Group;

abstract class AbstractEntity
{
    public const READ = 'read';
    public const READ_ONE = 'readOne';

    public int $id;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function implement(string $property, mixed $value): void
    {
        if (property_exists($this, $property)) {
            $this->{$property} = $value;
        }
    }

    public function serialize(string $group = 'default'): array
    {
        $properties = new \ReflectionObject($this)->getProperties();
        $serialized = [];

        foreach ($properties as $property) {
            $groupAttributes = $property->getAttributes(Group::class, \ReflectionAttribute::IS_INSTANCEOF);

            if (empty($groupAttributes) || 'default' === $group) {
                $serialized[$property->getName()] = $this->{$property->getName()};
            } else {
                $attribute = array_find($groupAttributes, function($attr) {
                    return $attr->getName() === Group::class;
                });
                if (in_array($group, $attribute->getArguments()['list'])) {
                    $serialized[$property->getName()] = $this->{$property->getName()};
                }
            }
            
        }

        return $serialized;
    }
}
