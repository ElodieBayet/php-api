<?php

declare(strict_types=1);

namespace Matrix\Validation;

class Validator
{
    private array $errors = [];

    public function getErrors(): array
    {
        return $this->errors;
    }

    public function hasErrors(): bool
    {
        return !empty($this->errors);
    }

    public function validatePost(array $data, string $entity): null|object
    {
        $reflection = new \ReflectionClass($entity);
        $properties = $reflection->getProperties();
        $entity = new $entity();

        if (null === $safeData = $this->prepareData($reflection, $data)) {
            return null;
        }

        foreach ($properties as $property) {
            $attributes = $property->getAttributes(Assertion::class, \ReflectionAttribute::IS_INSTANCEOF);
            foreach ($attributes as $attribute) {
                $assert = $attribute->newInstance();

                if (!array_key_exists($property->getName(), $safeData) && !$assert->isNullable()) {
                    $this->errors[$property->getName()] = ['missing' => "Must be provided"];
                    continue;
                }

                $value = empty($safeData[$property->getName()]) ? null : $safeData[$property->getName()];
                $checked = $assert->check($value);

                if (!empty($checked)) {
                    $this->errors[$property->getName()] = $checked;
                } else {
                    $entity->implement($property->getName(), $safeData[$property->getName()] ?? null);
                }
            }
        }

        if (true === $this->hasErrors()) {
            return null;
        }

        return $entity;
    }

    public function validateUpdate(array $data, object &$entity): void
    {
        $reflection = new \ReflectionObject($entity);

        if (null === $safeData = $this->prepareData($reflection, $data)) {
            return;
        }

        foreach ($safeData as $key => $value) {
            $attributes = $reflection->getProperty($key)->getAttributes(Assertion::class, \ReflectionAttribute::IS_INSTANCEOF);
            foreach($attributes as $attribute) {
                $assert = $attribute->newInstance();

                $value = empty($value) ? null : $value;
                $checked = $assert->check($value);

                if (!empty($checked)) {
                    $this->errors[$key] = $checked;
                } else {
                    $entity->implement($key, $value);
                }
            }
        }
    }

    private function prepareData(\ReflectionClass|\ReflectionObject $reflection, array $data): null|array
    {
        $safeData = array_map(
            function ($value) {
                return is_string($value) ? trim(htmlspecialchars($value)) : $value;
            }, 
            array_filter($data, function ($key) use ($reflection) {
                return $reflection->hasProperty($key);
            }, ARRAY_FILTER_USE_KEY)
        );
    
        if (empty($safeData)) {
            $this->errors['all'] = "No field matches as expected";
            return null;
        }

        return $safeData;
    }
}
