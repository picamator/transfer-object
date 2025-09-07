<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Generator\Render\Expander;

use Picamator\TransferObject\Generated\DefinitionEmbeddedTypeTransfer;
use Picamator\TransferObject\Generated\DefinitionPropertyTransfer;
use Picamator\TransferObject\Generated\TemplateTransfer;
use Picamator\TransferObject\TransferGenerator\Generator\Enum\AttributeEmbeddedTemplateEnum;
use Picamator\TransferObject\TransferGenerator\Generator\Enum\AttributeEnum;

final class TransferTypeTemplateExpander extends AbstractTemplateExpander
{
    use TemplateExpanderTrait;

    protected function isApplicable(DefinitionPropertyTransfer $propertyTransfer): bool
    {
        return $propertyTransfer->transferType !== null;
    }

    protected function handleExpander(
        DefinitionPropertyTransfer $propertyTransfer,
        TemplateTransfer $templateTransfer,
    ): void {
        $this->expandImports(AttributeEnum::TYPE_ATTRIBUTE, $templateTransfer);

        /** @var \Picamator\TransferObject\Generated\DefinitionEmbeddedTypeTransfer $embeddedTypeTransfer */
        $embeddedTypeTransfer = $propertyTransfer->transferType;

        $propertyName = $propertyTransfer->propertyName;
        $templateTransfer->properties[$propertyName] = $this->getPropertyType($embeddedTypeTransfer);
        $templateTransfer->nullables[$propertyName] = $propertyTransfer->isNullable;

        $templateTransfer->attributes[$propertyName]
            = AttributeEmbeddedTemplateEnum::TYPE_ATTRIBUTE->renderTemplate($embeddedTypeTransfer);
    }

    private function getPropertyType(DefinitionEmbeddedTypeTransfer $embeddedTypeTransfer): string
    {
        $propertyType = $embeddedTypeTransfer->name;
        $namespaceTransfer = $embeddedTypeTransfer->namespace;

        if ($namespaceTransfer === null) {
            return $propertyType;
        }

        return $this->enforceTransferInterface($propertyType);
    }
}
