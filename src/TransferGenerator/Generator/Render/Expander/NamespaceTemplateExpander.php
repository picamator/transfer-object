<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Generator\Render\Expander;

use Picamator\TransferObject\Generated\DefinitionNamespaceTransfer;
use Picamator\TransferObject\Generated\DefinitionPropertyTransfer;
use Picamator\TransferObject\Generated\TemplateTransfer;
use Picamator\TransferObject\TransferGenerator\Generator\Enum\TransferEnum;

final class NamespaceTemplateExpander extends AbstractTemplateExpander
{
    protected function isApplicable(DefinitionPropertyTransfer $propertyTransfer): bool
    {
        return $this->getNamespaceTransfer($propertyTransfer) !== null;
    }

    protected function handleExpander(
        DefinitionPropertyTransfer $propertyTransfer,
        TemplateTransfer $templateTransfer,
    ): void {
        $namespaceTransfer = $this->getNamespaceTransfer($propertyTransfer);
        $namespace = $namespaceTransfer?->fullName ?: '';

        $templateTransfer->imports[$namespace] ??= $namespace;
        $templateTransfer->imports[TransferEnum::INTERFACE->value] ??= TransferEnum::INTERFACE->value;
    }

    private function getNamespaceTransfer(DefinitionPropertyTransfer $propertyTransfer): ?DefinitionNamespaceTransfer
    {
        return $propertyTransfer->transferType?->namespace ?: $propertyTransfer->collectionType?->namespace;
    }
}
