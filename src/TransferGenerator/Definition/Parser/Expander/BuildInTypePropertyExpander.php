<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Definition\Parser\Expander;

use Picamator\TransferObject\Generated\DefinitionPropertyTransfer;
use Picamator\TransferObject\TransferGenerator\Definition\Enum\BuildInTypeEnum;

readonly class BuildInTypePropertyExpander implements PropertyExpanderInterface
{
    private const string TYPE_KEY = 'type';

    public function isApplicable(array $propertyType): bool
    {
        return $this->getBuildInType($propertyType) !== null;
    }

    public function isNextAllowed(): false
    {
        return false;
    }

    public function expandPropertyTransfer(array $propertyType, DefinitionPropertyTransfer $propertyTransfer): void
    {
        $propertyTransfer->buildInType = $this->getBuildInType($propertyType);
    }

    /**
     * @param array<string,string|bool> $propertyType
     */
    private function getBuildInType(array $propertyType): ?BuildInTypeEnum
    {
        $type = $propertyType[self::TYPE_KEY] ?? null;
        if ($type === null) {
            return null;
        }

        return is_bool($type)
            ? BuildInTypeEnum::getTrueFalse($type)
            : BuildInTypeEnum::tryFrom($type);
    }
}
