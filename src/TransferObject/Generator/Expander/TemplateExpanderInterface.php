<?php declare(strict_types=1);

namespace Picamator\TransferObject\Generator\Expander;

use Picamator\TransferObject\Generated\DefinitionPropertyTransfer;
use Picamator\TransferObject\Generated\TemplateTransfer;

interface TemplateExpanderInterface
{
    public function expandTemplate(DefinitionPropertyTransfer $propertyTransfer, TemplateTransfer $templateTransfer): void;

    public function setNext(TemplateExpanderInterface $expander): TemplateExpanderInterface;
}
