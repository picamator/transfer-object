<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Generator\Render\Expander;

use Picamator\TransferObject\Generated\DefinitionPropertyTransfer;
use Picamator\TransferObject\Generated\TemplateTransfer;
use Picamator\TransferObject\TransferGenerator\Generator\Enum\AttributeEnum;
use Picamator\TransferObject\TransferGenerator\Generator\Enum\AttributeTemplateEnum;

final class TransferTypeTemplateExpander extends AbstractTemplateExpander
{
    use TemplateExpanderTrait;

    protected function isApplicable(DefinitionPropertyTransfer $propertyTransfer): bool
    {
        return $propertyTransfer->transferType !== null;
    }

    protected function handleExpander(
        DefinitionPropertyTransfer $propertyTransfer,
        TemplateTransfer $templateTransfer,
    ): void {
        $templateTransfer->imports[AttributeEnum::TYPE_ATTRIBUTE->value] ??= AttributeEnum::TYPE_ATTRIBUTE->value;

        $propertyName = $propertyTransfer->propertyName;
        $templateTransfer->properties[$propertyName] = $this->getPropertyType($propertyTransfer);
        $templateTransfer->attributes[$propertyName] = $this->getPropertyAttribute($propertyTransfer);
        $templateTransfer->nullables[$propertyName] = $propertyTransfer->isNullable;
    }

    private function getPropertyAttribute(DefinitionPropertyTransfer $propertyTransfer): string
    {
        $transferType = $propertyTransfer->transferType?->name ?: '';

        return sprintf(AttributeTemplateEnum::TYPE_ATTRIBUTE->value, $transferType);
    }

    private function getPropertyType(DefinitionPropertyTransfer $propertyTransfer): string
    {
        $propertyType = $propertyTransfer->transferType?->name ?: '';
        $namespaceTransfer = $propertyTransfer->transferType?->namespace;

        if ($namespaceTransfer === null) {
            return $propertyType;
        }

        return $this->enforceTransferInterface($propertyType);
    }
}
