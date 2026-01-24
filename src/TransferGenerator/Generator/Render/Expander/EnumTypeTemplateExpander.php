<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Generator\Render\Expander;

use Picamator\TransferObject\TransferGenerator\Generator\Enum\TransformerAttributeTemplateEnum;
use Picamator\TransferObject\Generated\DefinitionPropertyTransfer;
use Picamator\TransferObject\Generated\TemplateTransfer;

final class EnumTypeTemplateExpander extends AbstractTemplateExpander
{
    use TemplateExpanderTrait;

    protected function isApplicable(DefinitionPropertyTransfer $propertyTransfer): bool
    {
        return $propertyTransfer->enumType !== null;
    }

    protected function handleExpander(
        DefinitionPropertyTransfer $propertyTransfer,
        TemplateTransfer $templateTransfer,
    ): void {
        /** @var \Picamator\TransferObject\Generated\DefinitionEmbeddedTypeTransfer $typeTransfer */
        $typeTransfer = $propertyTransfer->enumType;
        $this->expandEmbeddedType($propertyTransfer, $typeTransfer, $templateTransfer);

        $transformerEnum = TransformerAttributeTemplateEnum::ENUM;
        $this->expandTransformerAttribute(
            propertyTransfer: $propertyTransfer,
            transformerEnum: $transformerEnum,
            templateTransfer: $templateTransfer,
            renderTemplate: fn(): string => $transformerEnum->renderTemplate($typeTransfer),
        );
    }
}
