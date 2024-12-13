<?php declare(strict_types=1);

namespace Picamator\TransferObject\Generator\Expander;

use Picamator\TransferObject\Generated\DefinitionPropertyTransfer;
use Picamator\TransferObject\Generated\TemplateTransfer;
use Picamator\TransferObject\Generator\Enum\ArrayObjectEnum;
use Picamator\TransferObject\Generator\Enum\CollectionPropertyTypeEnum;
use Picamator\TransferObject\Generator\Enum\TransferEnum;

final class CollectionTypeTemplateExpander extends AbstractTemplateExpander
{
    protected function handleExpander(DefinitionPropertyTransfer $propertyTransfer, TemplateTransfer $templateTransfer): bool
    {
        if ($propertyTransfer->collectionType === null) {
            return false;
        }

        $templateTransfer->imports[] = ArrayObjectEnum::CLASS_NAME->value;
        $templateTransfer->imports[] = CollectionPropertyTypeEnum::CLASS_NAME->value;

        $transferName = $propertyTransfer->collectionType . TransferEnum::FILE_NAME_SUFFIX->value;

        $propertyName = $propertyTransfer->propertyName;
        $templateTransfer->properties[$propertyName] = ArrayObjectEnum::CLASS_NAME->value;
        $templateTransfer->attributes[$propertyName] = sprintf(CollectionPropertyTypeEnum::ATTRIBUTE_TEMPLATE->value, $transferName);
        $templateTransfer->dockBlocks[$propertyName] = sprintf(CollectionPropertyTypeEnum::DOCK_BLOCK_TEMPLATE->value, $transferName);

        return true;
    }
}
