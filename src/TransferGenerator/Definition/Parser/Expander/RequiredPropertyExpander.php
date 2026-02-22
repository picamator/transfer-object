<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Definition\Parser\Expander;

use Picamator\TransferObject\Generated\DefinitionPropertyTransfer;

final class RequiredPropertyExpander extends AbstractPropertyExpander
{
    private const string REQUIRED_KEY = 'required';

    protected function matchType(array $propertyType): string
    {
        return array_key_exists(self::REQUIRED_KEY, $propertyType) ? '1' : '0';
    }

    /**
     * @param string $matchedType
     */
    protected function handleExpander(mixed $matchedType, DefinitionPropertyTransfer $propertyTransfer): void
    {
        if (!$this->isNullableAllowed($propertyTransfer)) {
            $propertyTransfer->isRequired = true;

            return;
        }

        $propertyTransfer->isRequired = $matchedType === '1';
    }

    private function isNullableAllowed(DefinitionPropertyTransfer $propertyTransfer): bool
    {
        $builtInType = $propertyTransfer->builtInType?->name;
        if ($builtInType !== null && ($builtInType->isArray() || $builtInType->isArrayObject())) {
            return false;
        }

        return $propertyTransfer->collectionType === null;
    }
}
