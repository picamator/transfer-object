<?php declare(strict_types = 1);

namespace Picamator\TransferObject\Generator\Render\Expander;

use Picamator\TransferObject\Definition\Enum\TypeEnum;
use Picamator\TransferObject\Generator\Enum\AttributeEnum;
use Picamator\TransferObject\Generator\Enum\AttributeTemplateEnum;
use Picamator\TransferObject\Generator\Enum\DefaultValueTemplateEnum;
use Picamator\TransferObject\Generator\Enum\DockBlockTemplateEnum;
use Picamator\TransferObject\Generator\Render\TemplateRenderTrait;
use Picamator\TransferObject\Transfer\Generated\DefinitionPropertyTransfer;
use Picamator\TransferObject\Transfer\Generated\TemplateTransfer;

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
        $templateTransfer->imports[TypeEnum::ARRAY_OBJECT->value] ??= TypeEnum::ARRAY_OBJECT->value;
        $templateTransfer->imports[AttributeEnum::COLLECTION_TYPE_ATTRIBUTE->value] ??= AttributeEnum::COLLECTION_TYPE_ATTRIBUTE->value;

        $transferName = $this->getTransferName($propertyTransfer->collectionType);

        $propertyName = $propertyTransfer->propertyName;
        $templateTransfer->properties[$propertyName] = TypeEnum::ARRAY_OBJECT->value;
        $templateTransfer->attributes[$propertyName] = sprintf(AttributeTemplateEnum::COLLECTION_TYPE_ATTRIBUTE->value, $transferName);
        $templateTransfer->dockBlocks[$propertyName] = sprintf(DockBlockTemplateEnum::COLLECTION->value, $transferName);
        $templateTransfer->defaultValues[$propertyName] = DefaultValueTemplateEnum::ARRAY_OBJECT->value;
    }

}
