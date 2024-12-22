<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Generator\Render\Expander;

use Picamator\TransferObject\TransferGenerator\Definition\Enum\BuildInTypeEnum;
use Picamator\TransferObject\TransferGenerator\Generator\Enum\DefaultValueTemplateEnum;
use Picamator\TransferObject\TransferGenerator\Generator\Enum\DockBlockTemplateEnum;
use Picamator\TransferObject\TransferGenerator\Generator\Render\TemplateRenderTrait;
use Picamator\TransferObject\Generated\DefinitionPropertyTransfer;
use Picamator\TransferObject\Generated\TemplateTransfer;

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
