<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Generator\Render\Expander;

use Picamator\TransferObject\Generated\DefinitionNamespaceTransfer;
use Picamator\TransferObject\Generated\DefinitionPropertyTransfer;
use Picamator\TransferObject\Generated\TemplateTransfer;
use Picamator\TransferObject\TransferGenerator\Generator\Enum\TransferEnum;

final class NamespaceTemplateExpander extends AbstractTemplateExpander
{
    use TemplateExpanderTrait;

    protected function isApplicable(DefinitionPropertyTransfer $propertyTransfer): bool
    {
        return $propertyTransfer->transferType?->namespace !== null
            || $propertyTransfer->collectionType?->namespace !== null;
    }

    protected function handleExpander(
        DefinitionPropertyTransfer $propertyTransfer,
        TemplateTransfer $templateTransfer,
    ): void {
        /** @var \Picamator\TransferObject\Generated\DefinitionNamespaceTransfer $namespaceTransfer */
        $namespaceTransfer = $this->getNamespaceTransfer($propertyTransfer);

        $this->expandImports($namespaceTransfer->fullName, $templateTransfer);
        $this->expandImports(TransferEnum::INTERFACE, $templateTransfer);
    }

    private function getNamespaceTransfer(DefinitionPropertyTransfer $propertyTransfer): ?DefinitionNamespaceTransfer
    {
        return $propertyTransfer->transferType?->namespace ?: $propertyTransfer->collectionType?->namespace;
    }
}
