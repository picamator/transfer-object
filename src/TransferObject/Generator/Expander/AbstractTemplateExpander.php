<?php declare(strict_types=1);

namespace Picamator\TransferObject\Generator\Expander;

use Picamator\TransferObject\Generated\DefinitionPropertyTransfer;
use Picamator\TransferObject\Generated\TemplateTransfer;

abstract class AbstractTemplateExpander implements TemplateExpanderInterface
{
    private ?TemplateExpanderInterface $nextExpander;

    final public function expandTemplate(DefinitionPropertyTransfer $propertyTransfer, TemplateTransfer $templateTransfer): void
    {
        if ($this->handleExpander($propertyTransfer, $templateTransfer)) {
            return;
        }

        $this->nextExpander?->expandTemplate($propertyTransfer, $templateTransfer);
    }

    final public function setNext(TemplateExpanderInterface $expander): TemplateExpanderInterface
    {
        $this->nextExpander = $expander;

        return $expander;
    }

    protected abstract function handleExpander(DefinitionPropertyTransfer $propertyTransfer, TemplateTransfer $templateTransfer): bool;
}
