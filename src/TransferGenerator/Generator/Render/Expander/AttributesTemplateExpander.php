<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Generator\Render\Expander;

use Picamator\TransferObject\Generated\DefinitionAttributeTransfer;
use Picamator\TransferObject\Generated\DefinitionPropertyTransfer;
use Picamator\TransferObject\Generated\TemplateTransfer;

final class AttributesTemplateExpander extends AbstractTemplateExpander
{
    use TemplateExpanderTrait;

    protected function isApplicable(DefinitionPropertyTransfer $propertyTransfer): bool
    {
        return $propertyTransfer->attributes->count() !== 0;
    }

    protected function handleExpander(
        DefinitionPropertyTransfer $propertyTransfer,
        TemplateTransfer $templateTransfer,
    ): void {
        foreach ($propertyTransfer->attributes as $attributeTransfer) {
            $this->expandImports($attributeTransfer->namespace->fullName, $templateTransfer);

            $templateTransfer->propertyAttributes[$propertyTransfer->propertyName][]
                = $this->getAttribute($attributeTransfer);
        }
    }

    private function getAttribute(DefinitionAttributeTransfer $attributeTransfer): string
    {
        $arguments = $attributeTransfer->arguments;
        if ($arguments === null) {
            return $attributeTransfer->namespace->baseName;
        }

        return $attributeTransfer->namespace->baseName . $arguments;
    }
}
