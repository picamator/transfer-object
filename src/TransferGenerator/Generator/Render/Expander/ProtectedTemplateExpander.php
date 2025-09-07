<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Generator\Render\Expander;

use Picamator\TransferObject\Generated\DefinitionPropertyTransfer;
use Picamator\TransferObject\Generated\TemplateTransfer;

final class ProtectedTemplateExpander extends AbstractTemplateExpander
{
    /**
     * phpcs:disable SlevomatCodingStandard.Functions.UnusedParameter
     */
    protected function isApplicable(DefinitionPropertyTransfer $propertyTransfer): true
    {
        return true;
    }

    protected function handleExpander(
        DefinitionPropertyTransfer $propertyTransfer,
        TemplateTransfer $templateTransfer,
    ): void {
        $templateTransfer->protects[$propertyTransfer->propertyName] = $propertyTransfer->isProtected;
    }
}
