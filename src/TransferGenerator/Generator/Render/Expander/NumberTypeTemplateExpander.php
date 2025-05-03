<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Generator\Render\Expander;

use Picamator\TransferObject\TransferGenerator\Generator\Enum\AttributeEnum;
use Picamator\TransferObject\TransferGenerator\Generator\Enum\AttributeTemplateEnum;
use Picamator\TransferObject\Generated\DefinitionPropertyTransfer;
use Picamator\TransferObject\Generated\TemplateTransfer;

final class NumberTypeTemplateExpander extends AbstractTemplateExpander
{
    protected function isApplicable(DefinitionPropertyTransfer $propertyTransfer): bool
    {
        return $propertyTransfer->numberType !== null;
    }

    protected function handleExpander(
        DefinitionPropertyTransfer $propertyTransfer,
        TemplateTransfer $templateTransfer,
    ): void {
        $templateTransfer->imports[AttributeEnum::NUMBER_TYPE_ATTRIBUTE->value]
            ??= AttributeEnum::NUMBER_TYPE_ATTRIBUTE->value;

        $importNumber = $propertyTransfer->numberType?->namespace?->fullName ?: '';

        $templateTransfer->imports[$importNumber] ??= $importNumber;

        $propertyName = $propertyTransfer->propertyName;
        $numberClassName = $propertyTransfer->numberType?->name ?: '';

        $templateTransfer->properties[$propertyName] = $numberClassName;
        $templateTransfer->attributes[$propertyName] = $this->getPropertyAttribute($numberClassName);
        $templateTransfer->nullables[$propertyName] = $propertyTransfer->isNullable;
    }

    private function getPropertyAttribute(string $numberClassName): string
    {
        return sprintf(AttributeTemplateEnum::NUMBER_TYPE_ATTRIBUTE->value, $numberClassName);
    }
}
