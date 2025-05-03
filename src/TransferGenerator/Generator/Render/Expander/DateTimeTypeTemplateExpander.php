<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Generator\Render\Expander;

use Picamator\TransferObject\TransferGenerator\Generator\Enum\AttributeEnum;
use Picamator\TransferObject\TransferGenerator\Generator\Enum\AttributeTemplateEnum;
use Picamator\TransferObject\Generated\DefinitionPropertyTransfer;
use Picamator\TransferObject\Generated\TemplateTransfer;

final class DateTimeTypeTemplateExpander extends AbstractTemplateExpander
{
    protected function isApplicable(DefinitionPropertyTransfer $propertyTransfer): bool
    {
        return $propertyTransfer->dateTimeType !== null;
    }

    protected function handleExpander(
        DefinitionPropertyTransfer $propertyTransfer,
        TemplateTransfer $templateTransfer,
    ): void {
        $templateTransfer->imports[AttributeEnum::DATE_TIME_TYPE_ATTRIBUTE->value]
            ??= AttributeEnum::DATE_TIME_TYPE_ATTRIBUTE->value;

        $importDateTime = $propertyTransfer->dateTimeType?->namespace?->fullName ?: '';

        $templateTransfer->imports[$importDateTime] ??= $importDateTime;

        $propertyName = $propertyTransfer->propertyName;
        $dateTimeClassName = $propertyTransfer->dateTimeType?->name ?: '';

        $templateTransfer->properties[$propertyName] = $dateTimeClassName;
        $templateTransfer->attributes[$propertyName] = $this->getPropertyAttribute($dateTimeClassName);
        $templateTransfer->nullables[$propertyName] = $propertyTransfer->isNullable;
    }

    private function getPropertyAttribute(string $dateTimeClassName): string
    {
        return sprintf(AttributeTemplateEnum::DATE_TIME_TYPE_ATTRIBUTE->value, $dateTimeClassName);
    }
}
