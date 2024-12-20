<?php declare(strict_types = 1);

namespace Picamator\TransferObject\Generator\Render\Expander;

use Picamator\TransferObject\Definition\Enum\TypeEnum;
use Picamator\TransferObject\Generator\Enum\DefaultValueTemplateEnum;
use Picamator\TransferObject\Generator\Enum\DockBlockTemplateEnum;
use Picamator\TransferObject\Generator\Render\TemplateRenderTrait;
use Picamator\TransferObject\Transfer\Generated\DefinitionPropertyTransfer;
use Picamator\TransferObject\Transfer\Generated\TemplateTransfer;

readonly class BuildInTypeTemplateExpander implements TemplateExpanderInterface
{
    use TemplateRenderTrait;

    public function isApplicable(DefinitionPropertyTransfer $propertyTransfer): true
    {
        return true;
    }

    public function expandTemplateTransfer(
        DefinitionPropertyTransfer $propertyTransfer,
        TemplateTransfer $templateTransfer,
    ): void {
        $propertyName = $propertyTransfer->propertyName;
        $templateTransfer->properties[$propertyName] = $propertyTransfer->type;

        if (TypeEnum::isArrayObject($propertyTransfer->type)) {
            $templateTransfer->imports[TypeEnum::ARRAY_OBJECT->value] ??= TypeEnum::ARRAY_OBJECT->value;
            $templateTransfer->defaultValues[$propertyName] = DefaultValueTemplateEnum::ARRAY_OBJECT->value;
            $templateTransfer->dockBlocks[$propertyName] = DockBlockTemplateEnum::ARRAY_OBJECT->value;

            return;
        }

        if (TypeEnum::isArray($propertyTransfer->type)) {
            $templateTransfer->defaultValues[$propertyName] = DefaultValueTemplateEnum::ARRAY->value;
            $templateTransfer->dockBlocks[$propertyName] = DockBlockTemplateEnum::ARRAY->value;

            return;
        }

        if (TypeEnum::isIterable($propertyTransfer->type)) {
            $templateTransfer->defaultValues[$propertyName] = DefaultValueTemplateEnum::ARRAY->value;
            $templateTransfer->dockBlocks[$propertyName] = DockBlockTemplateEnum::ITERABLE->value;
        }
    }
}
