<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Generator\Render\Expander;

use Override;
use Picamator\TransferObject\Generated\DefinitionEmbeddedTypeTransfer;
use Picamator\TransferObject\TransferGenerator\Generator\Enum\AttributeEnum;
use Picamator\TransferObject\TransferGenerator\Generator\Enum\AttributeTemplateEnum;
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
            = $this->getPropertyAttribute($embeddedTypeTransfer);
    }

    private function getPropertyAttribute(DefinitionEmbeddedTypeTransfer $embeddedTypeTransfer): string
    {
        return sprintf(AttributeTemplateEnum::ENUM_TYPE_ATTRIBUTE->value, $embeddedTypeTransfer->name);
    }
}
