<?php declare(strict_types=1);

namespace Picamator\TransferObject\Generator\Expander;

use Picamator\TransferObject\Definition\Enum\DefinitionTypeEnum;
use Picamator\TransferObject\Generated\DefinitionPropertyTransfer;
use Picamator\TransferObject\Generated\TemplateTransfer;
use Picamator\TransferObject\Generator\Enum\PropertyTypeEnum;
use Picamator\TransferObject\Generator\Enum\TransferEnum;

final class TypeTemplateExpander extends AbstractTemplateExpander
{
    protected function handleExpander(DefinitionPropertyTransfer $propertyTransfer, TemplateTransfer $templateTransfer): bool
    {
        if (DefinitionTypeEnum::tryFrom($propertyTransfer->type) !== null) {
            return false;
        }

        $templateTransfer->imports[] = PropertyTypeEnum::CLASS_NAME->value;

        $transferName = $propertyTransfer->type . TransferEnum::FILE_NAME_SUFFIX->value;
        $propertyName = $propertyTransfer->propertyName;

        $templateTransfer->properties[$propertyName] = $transferName;
        $templateTransfer->attributes[$propertyName] = sprintf(PropertyTypeEnum::ATTRIBUTE_TEMPLATE->value, $transferName);

        return true;
    }
}
