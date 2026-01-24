<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Generator\Render\Expander;

use Picamator\TransferObject\Generated\DefinitionEmbeddedTypeTransfer;
use Picamator\TransferObject\Generated\DefinitionPropertyTransfer;
use Picamator\TransferObject\Generated\TemplateTransfer;
use Picamator\TransferObject\TransferGenerator\Generator\Enum\TransformerAttributeTemplateEnum;

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
        /** @var \Picamator\TransferObject\Generated\DefinitionEmbeddedTypeTransfer $typeTransfer */
        $typeTransfer = $propertyTransfer->transferType;

        $propertyName = $propertyTransfer->propertyName;
        $templateTransfer->properties[$propertyName] = $this->getPropertyType($typeTransfer);
        $templateTransfer->nullables[$propertyName] = $propertyTransfer->isNullable;

        $transformerEnum = TransformerAttributeTemplateEnum::TRANSFER;
        $this->expandTransformerAttribute(
            propertyTransfer: $propertyTransfer,
            transformerEnum: $transformerEnum,
            templateTransfer: $templateTransfer,
            renderTemplate: fn(): string => $transformerEnum->renderTemplate($typeTransfer),
        );
    }

    private function getPropertyType(DefinitionEmbeddedTypeTransfer $typeTransfer): string
    {
        if ($typeTransfer->namespace === null) {
            return $typeTransfer->name;
        }

        return $this->enforceTransferInterface($typeTransfer->name);
    }
}
