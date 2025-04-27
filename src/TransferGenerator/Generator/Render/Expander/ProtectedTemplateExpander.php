<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Generator\Render\Expander;

use Picamator\TransferObject\Generated\DefinitionPropertyTransfer;
use Picamator\TransferObject\Generated\TemplateTransfer;

final class ProtectedTemplateExpander extends AbstractTemplateExpander
{
    protected function isApplicable(DefinitionPropertyTransfer $propertyTransfer): true
    {
        return true;
    }

    protected function handleExpander(
        DefinitionPropertyTransfer $propertyTransfer,
        TemplateTransfer $templateTransfer,
    ): void {
        $propertyName = $propertyTransfer->propertyName;
        $templateTransfer->protects[$propertyName] = $propertyTransfer->isProtected;
    }
}
