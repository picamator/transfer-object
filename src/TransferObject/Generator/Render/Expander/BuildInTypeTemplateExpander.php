<?php declare(strict_types = 1);

namespace Picamator\TransferObject\Generator\Render\Expander;

use Picamator\TransferObject\Definition\Enum\BuildInTypeEnum;
use Picamator\TransferObject\Generator\Enum\DefaultValueTemplateEnum;
use Picamator\TransferObject\Generator\Enum\DockBlockTemplateEnum;
use Picamator\TransferObject\Generator\Render\TemplateRenderTrait;
use Picamator\TransferObject\Transfer\Generated\DefinitionPropertyTransfer;
use Picamator\TransferObject\Transfer\Generated\TemplateTransfer;

readonly class BuildInTypeTemplateExpander implements TemplateExpanderInterface
{
    use TemplateRenderTrait;

    public function isApplicable(DefinitionPropertyTransfer $propertyTransfer): bool
    {
        return $propertyTransfer->buildInType !== null;
    }

    public function expandTemplateTransfer(
        DefinitionPropertyTransfer $propertyTransfer,
        TemplateTransfer $templateTransfer,
    ): void {
        $propertyName = $propertyTransfer->propertyName;
        $templateTransfer->properties[$propertyName] = $propertyTransfer->buildInType;

        if (BuildInTypeEnum::isArrayObject($propertyTransfer->buildInType)) {
            $templateTransfer->imports[BuildInTypeEnum::ARRAY_OBJECT->value] ??= BuildInTypeEnum::ARRAY_OBJECT->value;
            $templateTransfer->defaultValues[$propertyName] = DefaultValueTemplateEnum::ARRAY_OBJECT->value;
            $templateTransfer->dockBlocks[$propertyName] = DockBlockTemplateEnum::ARRAY_OBJECT->value;

            return;
        }

        if (BuildInTypeEnum::isArray($propertyTransfer->buildInType)) {
            $templateTransfer->defaultValues[$propertyName] = DefaultValueTemplateEnum::ARRAY->value;
            $templateTransfer->dockBlocks[$propertyName] = DockBlockTemplateEnum::ARRAY->value;

            return;
        }

        if (BuildInTypeEnum::isIterable($propertyTransfer->buildInType)) {
            $templateTransfer->defaultValues[$propertyName] = DefaultValueTemplateEnum::ARRAY->value;
            $templateTransfer->dockBlocks[$propertyName] = DockBlockTemplateEnum::ITERABLE->value;
        }
    }
}
