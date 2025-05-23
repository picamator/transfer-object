<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Definition\Parser\Expander;

use Picamator\TransferObject\Generated\DefinitionEmbeddedTypeTransfer;
use Picamator\TransferObject\Generated\DefinitionPropertyTransfer;

final class DateTimeTypePropertyExpander extends AbstractPropertyExpander
{
    use NamespacePropertyExpanderTrait;

    private const string DATE_TIME_TYPE_KEY = 'dateTimeType';

    protected function handleExpander(array $propertyType, DefinitionPropertyTransfer $propertyTransfer): void
    {
        $dateTimeType = $this->getDateTimeType($propertyType);
        if ($dateTimeType === null) {
            return;
        }

        $namespaceTransfer = $this->createDefinitionNamespaceTransfer($dateTimeType);

        $typeTransfer = new DefinitionEmbeddedTypeTransfer();
        $typeTransfer->name = $namespaceTransfer->alias ?: $namespaceTransfer->baseName;
        $typeTransfer->namespace = $namespaceTransfer;

        $propertyTransfer->dateTimeType = $typeTransfer;
    }

    /**
     * @param array<string,string|null> $propertyType
     */
    private function getDateTimeType(array $propertyType): ?string
    {
        $dateTimeType = $propertyType[self::DATE_TIME_TYPE_KEY] ?? null;

        return is_string($dateTimeType) ? $dateTimeType : null;
    }
}
