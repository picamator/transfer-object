<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Definition\Parser\Expander;

use Picamator\TransferObject\Generated\DefinitionPropertyTransfer;
use Picamator\TransferObject\TransferGenerator\Definition\Enum\BuildInTypeEnum;

final class BuildInTypePropertyExpander extends AbstractPropertyExpander
{
    private const string TYPE_KEY = 'type';

    protected function isApplicable(array $propertyType): bool
    {
        return $this->getType($propertyType) !== null;
    }

    protected function handleExpander(array $propertyType, DefinitionPropertyTransfer $propertyTransfer): void
    {
        $propertyTransfer->buildInType = $this->getType($propertyType);
    }

    /**
     * @param array<string,string|null> $propertyType
     */
    private function getType(array $propertyType): ?BuildInTypeEnum
    {
        $type = $propertyType[self::TYPE_KEY] ?? null;
        if ($type === null) {
            return null;
        }

        return BuildInTypeEnum::tryFrom($type);
    }
}
