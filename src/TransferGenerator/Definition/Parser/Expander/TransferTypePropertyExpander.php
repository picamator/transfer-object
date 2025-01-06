<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Definition\Parser\Expander;

use Picamator\TransferObject\Generated\DefinitionPropertyTransfer;
use Picamator\TransferObject\TransferGenerator\Definition\Enum\TypePrefixEnum;

readonly class TransferTypePropertyExpander implements PropertyExpanderInterface
{
    private const string TYPE_KEY = 'type';

    public function isApplicable(array $propertyType): bool
    {
        return $this->getTransferType($propertyType) !== null;
    }

    public function expandPropertyTransfer(array $propertyType, DefinitionPropertyTransfer $propertyTransfer): void
    {
        if ($propertyTransfer->buildInType !== null) {
            return;
        }

        $transferType = $this->getTransferType($propertyType) ?: '';
        if ($propertyTransfer->namespace === null) {
            $propertyTransfer->transferType = $transferType . TypePrefixEnum::TRANSFER->value;

            return;
        }

        $propertyTransfer->transferType = $propertyTransfer->namespace->alias
            ?: $propertyTransfer->namespace->baseName;
    }

    /**
     * @param array<string,string|bool> $propertyType
     */
    private function getTransferType(array $propertyType): ?string
    {
        $type = $propertyType[self::TYPE_KEY] ?? null;

        return is_string($type) ? $type : null;
    }
}
