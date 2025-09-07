<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Generator\Render\Expander;

use Picamator\TransferObject\Generated\DefinitionEmbeddedTypeTransfer;
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

        /** @var \Picamator\TransferObject\Generated\DefinitionEmbeddedTypeTransfer $embeddedTypeTransfer */
        $embeddedTypeTransfer = $propertyTransfer->enumType;

        $className = $embeddedTypeTransfer->namespace?->fullName ?: '';
        $templateTransfer->imports[$className] ??= $className;

        $propertyName = $propertyTransfer->propertyName;
        $templateTransfer->properties[$propertyName] = $embeddedTypeTransfer->name;
        $templateTransfer->attributes[$propertyName] = $this->getPropertyAttribute($embeddedTypeTransfer);
        $templateTransfer->nullables[$propertyName] = $propertyTransfer->isNullable;
    }

    private function getPropertyAttribute(DefinitionEmbeddedTypeTransfer $embeddedTypeTransfer): string
    {
        return sprintf(AttributeTemplateEnum::ENUM_TYPE_ATTRIBUTE->value, $embeddedTypeTransfer->name);
    }
}
