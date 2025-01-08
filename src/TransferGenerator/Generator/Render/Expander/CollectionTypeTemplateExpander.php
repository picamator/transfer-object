<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Generator\Render\Expander;

use Picamator\TransferObject\Generated\DefinitionPropertyTransfer;
use Picamator\TransferObject\Generated\TemplateTransfer;
use Picamator\TransferObject\TransferGenerator\Definition\Enum\BuildInTypeEnum;
use Picamator\TransferObject\TransferGenerator\Generator\Enum\AttributeEnum;
use Picamator\TransferObject\TransferGenerator\Generator\Enum\AttributeTemplateEnum;
use Picamator\TransferObject\TransferGenerator\Generator\Enum\DockBlockTemplateEnum;

final class CollectionTypeTemplateExpander extends AbstractTemplateExpander
{
    use TemplateExpanderTrait;

    protected function isApplicable(DefinitionPropertyTransfer $propertyTransfer): bool
    {
        return $propertyTransfer->collectionType !== null;
    }

    protected function handleExpander(
        DefinitionPropertyTransfer $propertyTransfer,
        TemplateTransfer $templateTransfer,
    ): void {
        $templateTransfer->imports[BuildInTypeEnum::ARRAY_OBJECT->value] ??= BuildInTypeEnum::ARRAY_OBJECT->value;
        $templateTransfer->imports[AttributeEnum::COLLECTION_TYPE_ATTRIBUTE->value]
            ??= AttributeEnum::COLLECTION_TYPE_ATTRIBUTE->value;

        $propertyName = $propertyTransfer->propertyName;
        $templateTransfer->properties[$propertyName] = BuildInTypeEnum::ARRAY_OBJECT->value;
        $templateTransfer->attributes[$propertyName] = $this->getPropertyAttribute($propertyTransfer);
        $templateTransfer->dockBlocks[$propertyName] = $this->getPropertyDockBlock($propertyTransfer);
        $templateTransfer->nullables[$propertyName] = false;
    }

    private function getPropertyDockBlock(DefinitionPropertyTransfer $propertyTransfer): string
    {
        $propertyType = $propertyTransfer->collectionType?->name ?: '';
        $namespaceTransfer = $propertyTransfer->collectionType?->namespace;

        if ($namespaceTransfer !== null) {
            $propertyType = $this->enforceTransferInterface($propertyType);
        }

        return sprintf(DockBlockTemplateEnum::COLLECTION->value, $propertyType);
    }

    private function getPropertyAttribute(DefinitionPropertyTransfer $propertyTransfer): string
    {
        $transferType = $propertyTransfer->collectionType?->name ?: '';

        return sprintf(AttributeTemplateEnum::COLLECTION_TYPE_ATTRIBUTE->value, $transferType);
    }
}
