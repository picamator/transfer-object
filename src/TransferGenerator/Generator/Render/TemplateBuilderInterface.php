<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Generator\Render;

use Picamator\TransferObject\Generated\DefinitionContentTransfer;
use Picamator\TransferObject\Generated\TemplateTransfer;

interface TemplateBuilderInterface
{
    public function buildTemplateTransfer(DefinitionContentTransfer $contentTransfer): TemplateTransfer;
}
