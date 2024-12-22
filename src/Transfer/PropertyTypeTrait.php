<?php

declare(strict_types=1);

namespace Picamator\TransferObject\Transfer;

use Picamator\TransferObject\Transfer\Attribute\PropertyTypeAttributeInterface;
use ReflectionAttribute;
use ReflectionClassConstant;

trait PropertyTypeTrait
{
    private function getPropertyTypeAttribute(string $className, string $constantName): ?PropertyTypeAttributeInterface
    {
        $reflection = new ReflectionClassConstant($className, $constantName);
        $typeAttributeReflection = $reflection->getAttributes(
            name: PropertyTypeAttributeInterface::class,
            flags: ReflectionAttribute::IS_INSTANCEOF
        )[0] ?? null;

        return $typeAttributeReflection?->newInstance();
    }
}
