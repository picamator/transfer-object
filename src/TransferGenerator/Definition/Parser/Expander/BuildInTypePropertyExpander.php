<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Definition\Parser\Expander;

use Picamator\TransferObject\Generated\DefinitionPropertyTransfer;
use Picamator\TransferObject\TransferGenerator\Definition\Enum\BuildInTypeEnum;

final class BuildInTypePropertyExpander extends AbstractPropertyExpander
{
    private const string TYPE_KEY = 'type';

    protected function handleExpander(array $propertyType, DefinitionPropertyTransfer $propertyTransfer): void
    {
        $buildInType = $this->getBuildInType($propertyType);
        if ($buildInType === null) {
            return;
        }

        $propertyTransfer->buildInType = $buildInType;
    }

    /**
     * @param array<string,string|null> $propertyType
     */
    private function getBuildInType(array $propertyType): ?BuildInTypeEnum
    {
        $type = $propertyType[self::TYPE_KEY] ?? null;
        if ($type === null) {
            return null;
        }

        return BuildInTypeEnum::tryFrom($type);
    }
}
