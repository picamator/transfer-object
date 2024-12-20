<?php declare(strict_types = 1);

namespace Picamator\TransferObject\Generator\Render\Expander;

use Picamator\TransferObject\Transfer\Generated\DefinitionPropertyTransfer;
use Picamator\TransferObject\Transfer\Generated\TemplateTransfer;

interface TemplateExpanderInterface
{
    public function isApplicable(DefinitionPropertyTransfer $propertyTransfer): bool;

    public function expandTemplateTransfer(
        DefinitionPropertyTransfer $propertyTransfer,
        TemplateTransfer $templateTransfer
    ): void;
}
