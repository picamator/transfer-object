<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Generator\Render\Expander;

use Picamator\TransferObject\TransferGenerator\Definition\Enum\BuildInTypeEnum;
use Picamator\TransferObject\TransferGenerator\Generator\Enum\AttributeEnum;
use Picamator\TransferObject\TransferGenerator\Generator\Enum\AttributeTemplateEnum;
use Picamator\TransferObject\TransferGenerator\Generator\Enum\DockBlockTemplateEnum;
use Picamator\TransferObject\Generated\DefinitionPropertyTransfer;
use Picamator\TransferObject\Generated\TemplateTransfer;

final class BuildInTypeTemplateExpander extends AbstractTemplateExpander
{
    use TemplateExpanderTrait;

    protected function isApplicable(DefinitionPropertyTransfer $propertyTransfer): bool
    {
        return $propertyTransfer->buildInType !== null;
    }

    protected function handleExpander(
        DefinitionPropertyTransfer $propertyTransfer,
        TemplateTransfer $templateTransfer,
    ): void {
        /** @var \Picamator\TransferObject\TransferGenerator\Definition\Enum\BuildInTypeEnum $buildInType */
        $buildInType = $propertyTransfer->buildInType;

        $propertyName = $propertyTransfer->propertyName;
        $templateTransfer->properties[$propertyName] = $buildInType->value;
        $templateTransfer->nullables[$propertyName] = $propertyTransfer->isNullable;

        if ($buildInType->isArrayObject()) {
            $this->expandArrayObjectType($propertyTransfer, $templateTransfer);

            return;
        }

        if ($buildInType->isArray()) {
            $this->expandArrayType($propertyTransfer, $templateTransfer);
        }
    }

    private function expandArrayType(
        DefinitionPropertyTransfer $propertyTransfer,
        TemplateTransfer $templateTransfer,
    ): void {
        $this->expandImports(AttributeEnum::ARRAY_TYPE_ATTRIBUTE, $templateTransfer);

        $propertyName = $propertyTransfer->propertyName;
        $templateTransfer->attributes[$propertyName] = AttributeTemplateEnum::ARRAY_TYPE_ATTRIBUTE->value;
        $templateTransfer->dockBlocks[$propertyName] = DockBlockTemplateEnum::ARRAY->value;
        $templateTransfer->nullables[$propertyName] = false;
    }

    private function expandArrayObjectType(
        DefinitionPropertyTransfer $propertyTransfer,
        TemplateTransfer $templateTransfer,
    ): void {
        $this->expandImports(BuildInTypeEnum::ARRAY_OBJECT, $templateTransfer);
        $this->expandImports(AttributeEnum::ARRAY_OBJECT_TYPE_ATTRIBUTE, $templateTransfer);

        $propertyName = $propertyTransfer->propertyName;
        $templateTransfer->attributes[$propertyName] = AttributeTemplateEnum::ARRAY_OBJECT_TYPE_ATTRIBUTE->value;
        $templateTransfer->dockBlocks[$propertyName] = DockBlockTemplateEnum::ARRAY_OBJECT->value;
        $templateTransfer->nullables[$propertyName] = false;
    }
}
