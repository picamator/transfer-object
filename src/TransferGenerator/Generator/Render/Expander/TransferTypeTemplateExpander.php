<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Generator\Render\Expander;

use Picamator\TransferObject\TransferGenerator\Generator\Enum\AttributeEnum;
use Picamator\TransferObject\TransferGenerator\Generator\Enum\AttributeTemplateEnum;
use Picamator\TransferObject\TransferGenerator\Generator\Render\TemplateRenderTrait;
use Picamator\TransferObject\Generated\DefinitionPropertyTransfer;
use Picamator\TransferObject\Generated\TemplateTransfer;

readonly class TransferTypeTemplateExpander implements TemplateExpanderInterface
{
    use TemplateRenderTrait;

    public function isApplicable(DefinitionPropertyTransfer $propertyTransfer): bool
    {
        return $propertyTransfer->transferType !== null;
    }

    public function expandTemplateTransfer(
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
