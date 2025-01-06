<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Definition\Parser\Expander;

use Picamator\TransferObject\Generated\DefinitionPropertyTransfer;
use Picamator\TransferObject\TransferGenerator\Definition\Enum\BuildInTypeEnum;
use Picamator\TransferObject\TransferGenerator\Definition\Enum\TypePrefixEnum;

readonly class TypePropertyExpander implements PropertyExpanderInterface
{
    private const string TYPE_KEY = 'type';

    public function isApplicable(array $propertyType): bool
    {
        return $this->getType($propertyType) !== null;
    }

    public function expandPropertyTransfer(array $propertyType, DefinitionPropertyTransfer $propertyTransfer): void
    {
        $type = $this->getType($propertyType) ?? '';

        $this->expandBuildInType($type, $propertyTransfer);
        if ($propertyTransfer->buildInType === null) {
            $this->expandTransferType($type, $propertyTransfer);
        }
    }

    private function expandTransferType(string|bool $type, DefinitionPropertyTransfer $propertyTransfer): void
    {
        if ($propertyTransfer->namespace === null) {
            $propertyTransfer->transferType = $type . TypePrefixEnum::TRANSFER->value;

            return;
        }

        $propertyTransfer->transferType
            = $propertyTransfer->namespace->alias ?: $propertyTransfer->namespace->baseName;
    }

    private function expandBuildInType(string|bool $type, DefinitionPropertyTransfer $propertyTransfer): void
    {
        $buildInType = is_bool($type)
            ? BuildInTypeEnum::getTrueFalse($type)
            : BuildInTypeEnum::tryFrom($type);

        $propertyTransfer->buildInType = $buildInType;
    }

    /**
     * @param array<string,string|bool> $propertyType
     */
    private function getType(array $propertyType): string|bool|null
    {
        $type = $propertyType[self::TYPE_KEY] ?? null;

        return is_string($type) || is_bool($type) ? $type : null;
    }
}
