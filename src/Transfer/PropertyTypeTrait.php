<?php

declare(strict_types=1);

namespace Picamator\TransferObject\Transfer;

use Picamator\TransferObject\Transfer\Attribute\PropertyTypeAttributeInterface;
use ReflectionAttribute;
use ReflectionClassConstant;
use ReflectionProperty;

trait PropertyTypeTrait
{
    private function getConstantAttribute(string $constantName): ?PropertyTypeAttributeInterface
    {
        $attributeReflection = $this->getConstantAttributeReflection($constantName);

        return $attributeReflection?->newInstance();
    }

    private function hasConstantAttribute(string $constantName): bool
    {
        $attributeReflection = $this->getConstantAttributeReflection($constantName);

        return $attributeReflection !== null;
    }

    /**
     * @param string $constantName
     * @return ReflectionAttribute<\Picamator\TransferObject\Transfer\Attribute\PropertyTypeAttributeInterface>|null
     */
    private function getConstantAttributeReflection(string $constantName): ?ReflectionAttribute
    {
        $reflection = new ReflectionClassConstant(static::class, $constantName);
        $attributeReflections = $reflection->getAttributes(
            name: PropertyTypeAttributeInterface::class,
            flags: ReflectionAttribute::IS_INSTANCEOF
        );

        return $attributeReflections[0] ?? null;
    }

    private function isArrayObjectPropertyType(string $propertyName): bool
    {
        $reflection = new ReflectionProperty(static::class, $propertyName);
        /** @var \ReflectionNamedType|null $typeName */
        $typeName = $reflection->getType();

        return $typeName?->getName() === 'ArrayObject';
    }
}
