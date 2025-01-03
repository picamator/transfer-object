<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Definition\Parser\Expander;

use Picamator\TransferObject\Generated\DefinitionPropertyTransfer;

readonly class TransferTypePropertyExpander implements PropertyExpanderInterface
{
    private const string TYPE_KEY = 'type';

    public function isApplicable(array $propertyType): bool
    {
        return $this->getTransferType($propertyType) !== null;
    }

    public function isNextAllowed(): false
    {
        return false;
    }

    public function expandPropertyTransfer(array $propertyType, DefinitionPropertyTransfer $propertyTransfer): void
    {
        $propertyTransfer->transferType = $this->getTransferType($propertyType);
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
