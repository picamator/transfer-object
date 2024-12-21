<?php declare(strict_types = 1);

namespace Picamator\TransferObject\Generator\Render\Expander;

use Picamator\TransferObject\Generator\Enum\AttributeEnum;
use Picamator\TransferObject\Generator\Enum\AttributeTemplateEnum;
use Picamator\TransferObject\Generator\Render\TemplateRenderTrait;
use Picamator\TransferObject\Transfer\Generated\DefinitionPropertyTransfer;
use Picamator\TransferObject\Transfer\Generated\TemplateTransfer;

readonly class TransferTypeTemplateExpander implements TemplateExpanderInterface
{
    use TemplateRenderTrait;

    public function isApplicable(DefinitionPropertyTransfer $propertyTransfer): bool
    {
        return $propertyTransfer->transferType !== null;
    }

    public function expandTemplateTransfer(
        DefinitionPropertyTransfer $propertyTransfer,
        TemplateTransfer $templateTransfer,
    ): void {
        $templateTransfer->imports[AttributeEnum::TYPE_ATTRIBUTE->value] ??= AttributeEnum::TYPE_ATTRIBUTE->value;

        $transferName = $this->getTransferName($propertyTransfer->transferType);
        $propertyName = $propertyTransfer->propertyName;

        $templateTransfer->properties[$propertyName] = $transferName;
        $templateTransfer->attributes[$propertyName] = sprintf(AttributeTemplateEnum::TYPE_ATTRIBUTE->value, $transferName);
    }
}
