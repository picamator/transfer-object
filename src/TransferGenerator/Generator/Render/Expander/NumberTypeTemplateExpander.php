<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Generator\Render\Expander;

use Picamator\TransferObject\TransferGenerator\Generator\Enum\AttributeEmbeddedTemplateEnum;
use Picamator\TransferObject\TransferGenerator\Generator\Enum\AttributeEnum;
use Picamator\TransferObject\Generated\DefinitionPropertyTransfer;
use Picamator\TransferObject\Generated\TemplateTransfer;

final class NumberTypeTemplateExpander extends AbstractTemplateExpander
{
    use TemplateExpanderTrait;

    protected function isApplicable(DefinitionPropertyTransfer $propertyTransfer): bool
    {
        return $propertyTransfer->numberType !== null;
    }

    protected function handleExpander(
        DefinitionPropertyTransfer $propertyTransfer,
        TemplateTransfer $templateTransfer,
    ): void {
        $this->expandImports(AttributeEnum::NUMBER_TYPE_ATTRIBUTE, $templateTransfer);

        /** @var \Picamator\TransferObject\Generated\DefinitionEmbeddedTypeTransfer $embeddedTypeTransfer */
        $embeddedTypeTransfer = $propertyTransfer->numberType;
        $this->expandEmbeddedType($propertyTransfer, $embeddedTypeTransfer, $templateTransfer);

        $templateTransfer->attributes[$propertyTransfer->propertyName]
            = AttributeEmbeddedTemplateEnum::NUMBER_TYPE_ATTRIBUTE->renderTemplate($embeddedTypeTransfer);
    }
}
