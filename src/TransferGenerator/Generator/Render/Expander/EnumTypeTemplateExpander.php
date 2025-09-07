<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Generator\Render\Expander;

use Override;
use Picamator\TransferObject\TransferGenerator\Generator\Enum\AttributeEmbeddedTemplateEnum;
use Picamator\TransferObject\TransferGenerator\Generator\Enum\AttributeEnum;
use Picamator\TransferObject\Generated\DefinitionPropertyTransfer;
use Picamator\TransferObject\Generated\TemplateTransfer;

final class EnumTypeTemplateExpander extends AbstractTemplateExpander
{
    use TemplateExpanderTrait;

    #[Override]
    protected function isApplicable(DefinitionPropertyTransfer $propertyTransfer): bool
    {
        return $propertyTransfer->enumType !== null;
    }

    protected function handleExpander(
        DefinitionPropertyTransfer $propertyTransfer,
        TemplateTransfer $templateTransfer,
    ): void {
        $this->expandImports(AttributeEnum::ENUM_TYPE_ATTRIBUTE, $templateTransfer);

        /** @var \Picamator\TransferObject\Generated\DefinitionEmbeddedTypeTransfer $embeddedTypeTransfer */
        $embeddedTypeTransfer = $propertyTransfer->enumType;
        $this->expandEmbeddedType($propertyTransfer, $embeddedTypeTransfer, $templateTransfer);

        $templateTransfer->attributes[$propertyTransfer->propertyName]
            = AttributeEmbeddedTemplateEnum::ENUM_TYPE_ATTRIBUTE->renderTemplate($embeddedTypeTransfer);
    }
}
