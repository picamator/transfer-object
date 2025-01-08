<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Generator\Render\Expander;

use Picamator\TransferObject\Generated\DefinitionPropertyTransfer;
use Picamator\TransferObject\Generated\TemplateTransfer;

abstract class AbstractTemplateExpander implements TemplateExpanderInterface
{
    private ?TemplateExpanderInterface $nextExpander = null;

    public function setNextExpander(TemplateExpanderInterface $expander): TemplateExpanderInterface
    {
        $this->nextExpander = $expander;

        return $expander;
    }

    public function expandTemplateTransfer(
        DefinitionPropertyTransfer $propertyTransfer,
        TemplateTransfer $templateTransfer,
    ): void {
        if ($this->isApplicable($propertyTransfer)) {
            $this->handleExpander($propertyTransfer, $templateTransfer);
        }

        $this->nextExpander?->expandTemplateTransfer($propertyTransfer, $templateTransfer);
    }

    abstract protected function isApplicable(DefinitionPropertyTransfer $propertyTransfer): bool;

    abstract protected function handleExpander(
        DefinitionPropertyTransfer $propertyTransfer,
        TemplateTransfer $templateTransfer,
    ): void;
}
