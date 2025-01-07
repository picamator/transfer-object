<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Generator\Render\Expander;

use Picamator\TransferObject\Generated\DefinitionNamespaceTransfer;
use Picamator\TransferObject\TransferGenerator\Generator\Enum\TransferEnum;
use Picamator\TransferObject\TransferGenerator\Generator\Render\TemplateRenderTrait;
use Picamator\TransferObject\Generated\DefinitionPropertyTransfer;
use Picamator\TransferObject\Generated\TemplateTransfer;

readonly class NamespaceTemplateExpander implements TemplateExpanderInterface
{
    use TemplateRenderTrait;

    public function isApplicable(DefinitionPropertyTransfer $propertyTransfer): bool
    {
        return $this->getNamespaceTransfer($propertyTransfer) !== null;
    }

    public function expandTemplateTransfer(
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
