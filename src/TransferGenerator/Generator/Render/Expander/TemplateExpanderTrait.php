<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Generator\Render\Expander;

use Picamator\TransferObject\Generated\DefinitionEmbeddedTypeTransfer;
use Picamator\TransferObject\Generated\DefinitionPropertyTransfer;
use Picamator\TransferObject\Generated\TemplateTransfer;

trait TemplateExpanderTrait
{
    final protected function enforceTransferInterface(string $propertyType): string
    {
        return 'TransferInterface&' . $propertyType;
    }

    final protected function expandImports(string $className, TemplateTransfer $templateTransfer): void
    {
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
