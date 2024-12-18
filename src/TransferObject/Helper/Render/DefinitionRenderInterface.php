<?php declare(strict_types = 1);

namespace Picamator\TransferObject\Helper\Render;

use Picamator\TransferObject\Transfer\Generated\DefinitionContentTransfer;

interface DefinitionRenderInterface
{
    public function renderDefinitionContent(DefinitionContentTransfer $contentTransfer): string;
}
