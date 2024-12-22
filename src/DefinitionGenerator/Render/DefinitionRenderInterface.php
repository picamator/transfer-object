<?php declare(strict_types = 1);

namespace Picamator\TransferObject\DefinitionGenerator\Render;

use Picamator\TransferObject\Generated\DefinitionContentTransfer;

interface DefinitionRenderInterface
{
    public function renderDefinitionContent(DefinitionContentTransfer $contentTransfer): string;
}
