<?php

declare(strict_types=1);

namespace Picamator\TransferObject\Transfer;

use Picamator\TransferObject\Transfer\Attribute\InitialPropertyTypeAttributeInterface;
use Picamator\TransferObject\Transfer\Attribute\PropertyTypeAttributeInterface;
use ReflectionAttribute;
use ReflectionClassConstant;

trait ConstantAttributeTrait
{
    final protected function getConstantAttribute(string $constantName): ?PropertyTypeAttributeInterface
    {
        $reflection = new ReflectionClassConstant($this, $constantName);
        $attributeReflections = $reflection->getAttributes(
            name: PropertyTypeAttributeInterface::class,
            flags: ReflectionAttribute::IS_INSTANCEOF
        );

        $attributeReflection = $attributeReflections[0] ?? null;

        return $attributeReflection?->newInstance();
    }

    final protected function getConstantInitialAttribute(string $constantName): ?InitialPropertyTypeAttributeInterface
    {
        $reflection = new ReflectionClassConstant($this, $constantName);
        $attributeReflections = $reflection->getAttributes(
            name: InitialPropertyTypeAttributeInterface::class,
            flags: ReflectionAttribute::IS_INSTANCEOF
        );

        $attributeReflection = $attributeReflections[0] ?? null;

        return $attributeReflection?->newInstance();
    }
}
