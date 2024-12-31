<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Generator\Render\Expander;

use Picamator\TransferObject\TransferGenerator\Generator\Enum\AttributeEnum;
use Picamator\TransferObject\TransferGenerator\Generator\Enum\AttributeTemplateEnum;
use Picamator\TransferObject\Generated\DefinitionPropertyTransfer;
use Picamator\TransferObject\Generated\TemplateTransfer;

readonly class EnumTypeTemplateExpander implements TemplateExpanderInterface
{
    public function isApplicable(DefinitionPropertyTransfer $propertyTransfer): bool
    {
        return $propertyTransfer->enumType !== null;
    }

    public function expandTemplateTransfer(
        DefinitionPropertyTransfer $propertyTransfer,
        TemplateTransfer $templateTransfer,
    ): void {
        $templateTransfer->imports[AttributeEnum::ENUM_TYPE_ATTRIBUTE->value]
            ??= AttributeEnum::ENUM_TYPE_ATTRIBUTE->value;

        $importEnum = ltrim($propertyTransfer->enumType, '\\');
        $templateTransfer->imports[$importEnum] ??= $importEnum;

        $propertyName = $propertyTransfer->propertyName;
        $enumClassName = $this->getEnumName($propertyTransfer);

        $templateTransfer->properties[$propertyName] = $enumClassName;
        $templateTransfer->attributes[$propertyName] = sprintf(
            AttributeTemplateEnum::ENUM_TYPE_ATTRIBUTE->value,
            $enumClassName,
        );

        $templateTransfer->nullables[$propertyName] = true;
    }

    private function getEnumName(DefinitionPropertyTransfer $propertyTransfer): string
    {
        $enumName = $propertyTransfer->enumType ?? '';

        return basename(str_replace('\\', '/', $enumName));
    }
}
