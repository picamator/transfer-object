<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Generator\Render\Expander;

use Picamator\TransferObject\TransferGenerator\Generator\Enum\AttributeEnum;
use Picamator\TransferObject\TransferGenerator\Generator\Enum\AttributeTemplateEnum;
use Picamator\TransferObject\Generated\DefinitionPropertyTransfer;
use Picamator\TransferObject\Generated\TemplateTransfer;

final class EnumTypeTemplateExpander extends AbstractTemplateExpander
{
    protected function isApplicable(DefinitionPropertyTransfer $propertyTransfer): bool
    {
        return $propertyTransfer->enumType !== null;
    }

    protected function handleExpander(
        DefinitionPropertyTransfer $propertyTransfer,
        TemplateTransfer $templateTransfer,
    ): void {
        $templateTransfer->imports[AttributeEnum::ENUM_TYPE_ATTRIBUTE->value]
            ??= AttributeEnum::ENUM_TYPE_ATTRIBUTE->value;

        $importEnum = $propertyTransfer->enumType?->namespace?->fullName ?: '';
        $templateTransfer->imports[$importEnum] ??= $importEnum;

        $propertyName = $propertyTransfer->propertyName;
        $enumClassName = $propertyTransfer->enumType?->name ?: '';

        $templateTransfer->properties[$propertyName] = $enumClassName;
        $templateTransfer->attributes[$propertyName] = $this->getPropertyAttribute($enumClassName);
        $templateTransfer->nullables[$propertyName] = $propertyTransfer->isNullable;
    }

    private function getPropertyAttribute(string $enumClassName): string
    {
        return sprintf(AttributeTemplateEnum::ENUM_TYPE_ATTRIBUTE->value, $enumClassName);
    }
}
