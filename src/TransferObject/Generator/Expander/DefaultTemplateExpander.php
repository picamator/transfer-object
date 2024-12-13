<?php declare(strict_types=1);

namespace Picamator\TransferObject\Generator\Expander;

use Picamator\TransferObject\Generated\DefinitionPropertyTransfer;
use Picamator\TransferObject\Generated\TemplateTransfer;

final class DefaultTemplateExpander extends AbstractTemplateExpander
{
    protected function handleExpander(DefinitionPropertyTransfer $propertyTransfer, TemplateTransfer $templateTransfer): true
    {
        $propertyName = $propertyTransfer->propertyName;
        $templateTransfer->properties[$propertyName] = $propertyTransfer->type;

        return true;
    }
}
