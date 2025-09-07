<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Generator\Render\Expander;

use Picamator\TransferObject\Generated\DefinitionEmbeddedTypeTransfer;
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

        /** @var \Picamator\TransferObject\Generated\DefinitionEmbeddedTypeTransfer $embeddedTypeTransfer */
        $embeddedTypeTransfer = $propertyTransfer->dateTimeType;

        $className = $embeddedTypeTransfer->namespace?->fullName ?: '';
        $templateTransfer->imports[$className] ??= $className;

        $propertyName = $propertyTransfer->propertyName;
        $templateTransfer->properties[$propertyName] = $embeddedTypeTransfer->name;
        $templateTransfer->attributes[$propertyName] = $this->getPropertyAttribute($embeddedTypeTransfer);
        $templateTransfer->nullables[$propertyName] = $propertyTransfer->isNullable;
    }

    private function getPropertyAttribute(DefinitionEmbeddedTypeTransfer $embeddedTypeTransfer): string
    {
        return sprintf(AttributeTemplateEnum::DATE_TIME_TYPE_ATTRIBUTE->value, $embeddedTypeTransfer->name);
    }
}
