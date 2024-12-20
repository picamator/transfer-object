<?php declare(strict_types = 1);

namespace Picamator\TransferObject\Generator\Render;

use Picamator\TransferObject\Transfer\Generated\DefinitionContentTransfer;
use Picamator\TransferObject\Transfer\Generated\TemplateTransfer;

interface TemplateBuilderInterface
{
    public function buildTemplateTransfer(DefinitionContentTransfer $contentTransfer): TemplateTransfer;
}
