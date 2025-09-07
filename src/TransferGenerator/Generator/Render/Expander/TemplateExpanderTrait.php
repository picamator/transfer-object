<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Generator\Render\Expander;

use BackedEnum;
use Picamator\TransferObject\Generated\DefinitionEmbeddedTypeTransfer;
use Picamator\TransferObject\Generated\DefinitionPropertyTransfer;
use Picamator\TransferObject\Generated\TemplateTransfer;

trait TemplateExpanderTrait
{
    final protected function enforceTransferInterface(string $propertyType): string
    {
        return 'TransferInterface&' . $propertyType;
    }

    final protected function expandImports(string|BackedEnum $className, TemplateTransfer $templateTransfer): void
    {
        if ($className instanceof BackedEnum) {
            $className = $className->value;
        }

        $templateTransfer->imports[$className] ??= $className;
    }

    final protected function expandEmbeddedType(
        DefinitionPropertyTransfer $propertyTransfer,
        DefinitionEmbeddedTypeTransfer $embeddedTypeTransfer,
        TemplateTransfer $templateTransfer,
    ): void {
        $className = $embeddedTypeTransfer->namespace?->fullName ?: '';
        $this->expandImports($className, $templateTransfer);

        $propertyName = $propertyTransfer->propertyName;
        $templateTransfer->properties[$propertyName] = $embeddedTypeTransfer->name;
        $templateTransfer->nullables[$propertyName] = $propertyTransfer->isNullable;
    }
}
