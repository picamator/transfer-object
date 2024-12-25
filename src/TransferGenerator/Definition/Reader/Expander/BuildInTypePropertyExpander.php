<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Definition\Reader\Expander;

use Picamator\TransferObject\Generated\DefinitionPropertyTransfer;
use Picamator\TransferObject\TransferGenerator\Definition\Enum\BuildInTypeEnum;

readonly class BuildInTypePropertyExpander implements PropertyExpanderInterface
{
    private const string TYPE_KEY = 'type';

    public function isApplicable(array $propertyType): bool
    {
        return $this->getType($propertyType) !== null;
    }

    public function expandPropertyTransfer(array $propertyType, DefinitionPropertyTransfer $propertyTransfer): void
    {
        $propertyTransfer->buildInType = $this->getType($propertyType);
    }

    /**
     * @param array<string,string|bool> $propertyType
     */
    private function getType(array $propertyType): ?string
    {
        $type = $propertyType[self::TYPE_KEY] ?? null;
        if ($type === null) {
            return null;
        }

        return match (true) {
            is_bool($type) => BuildInTypeEnum::getTrueFalse($type)->value,
            BuildInTypeEnum::isBuildInType($type) => $type,
            default => null,
        };
    }
}
