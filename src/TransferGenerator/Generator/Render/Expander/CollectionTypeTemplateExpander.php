<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Generator\Render\Expander;

use Picamator\TransferObject\TransferGenerator\Definition\Enum\BuildInTypeEnum;
use Picamator\TransferObject\TransferGenerator\Generator\Enum\AttributeEnum;
use Picamator\TransferObject\TransferGenerator\Generator\Enum\AttributeTemplateEnum;
use Picamator\TransferObject\TransferGenerator\Generator\Enum\DockBlockTemplateEnum;
use Picamator\TransferObject\TransferGenerator\Generator\Render\TemplateRenderTrait;
use Picamator\TransferObject\Generated\DefinitionPropertyTransfer;
use Picamator\TransferObject\Generated\TemplateTransfer;

readonly class CollectionTypeTemplateExpander implements TemplateExpanderInterface
{
    use TemplateRenderTrait;

    public function isApplicable(DefinitionPropertyTransfer $propertyTransfer): bool
    {
        return $propertyTransfer->collectionType !== null;
    }

    public function expandTemplateTransfer(
        DefinitionPropertyTransfer $propertyTransfer,
        TemplateTransfer $templateTransfer,
    ): void {
        $templateTransfer->imports[BuildInTypeEnum::ARRAY_OBJECT->value] ??= BuildInTypeEnum::ARRAY_OBJECT->value;
        $templateTransfer->imports[AttributeEnum::COLLECTION_TYPE_ATTRIBUTE->value]
            ??= AttributeEnum::COLLECTION_TYPE_ATTRIBUTE->value;

        $transferName = $propertyTransfer->collectionType ?: '';

        $propertyName = $propertyTransfer->propertyName;
        $templateTransfer->properties[$propertyName] = BuildInTypeEnum::ARRAY_OBJECT->value;
        $templateTransfer->attributes[$propertyName] = sprintf(
            AttributeTemplateEnum::COLLECTION_TYPE_ATTRIBUTE->value,
            $transferName,
        );
        $templateTransfer->dockBlocks[$propertyName] = sprintf(DockBlockTemplateEnum::COLLECTION->value, $transferName);

        $templateTransfer->nullables[$propertyName] = false;
    }
}
