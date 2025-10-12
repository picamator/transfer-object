<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Generator\Render\Expander;

use Picamator\TransferObject\TransferGenerator\Generator\Enum\TransformerAttributeTemplateEnum;
use Picamator\TransferObject\Generated\DefinitionPropertyTransfer;
use Picamator\TransferObject\Generated\TemplateTransfer;

final class DateTimeTypeTemplateExpander extends AbstractTemplateExpander
{
    use TemplateExpanderTrait;

    protected function isApplicable(DefinitionPropertyTransfer $propertyTransfer): bool
    {
        return $propertyTransfer->dateTimeType !== null;
    }

    protected function handleExpander(
        DefinitionPropertyTransfer $propertyTransfer,
        TemplateTransfer $templateTransfer,
    ): void {
        $transformerEnum = TransformerAttributeTemplateEnum::DATE_TIME;
        $this->expandImports($transformerEnum->getImport(), $templateTransfer);

        /** @var \Picamator\TransferObject\Generated\DefinitionEmbeddedTypeTransfer $typeTransfer */
        $typeTransfer = $propertyTransfer->dateTimeType;
        $this->expandEmbeddedType($propertyTransfer, $typeTransfer, $templateTransfer);

        $templateTransfer->metaAttributes[$propertyTransfer->propertyName] = [
            $transformerEnum->renderTemplate($typeTransfer),
        ];
    }
}
