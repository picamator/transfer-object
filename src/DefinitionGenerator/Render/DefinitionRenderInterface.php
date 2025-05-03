<?php

declare(strict_types=1);

namespace Picamator\TransferObject\DefinitionGenerator\Render;

use Picamator\TransferObject\Generated\DefinitionContentTransfer;

interface DefinitionRenderInterface
{
    public function renderSchema(): string;

    /**
     * @throws \Picamator\TransferObject\DefinitionGenerator\Exception\DefinitionGeneratorException
     */
    public function renderDefinitionContent(DefinitionContentTransfer $contentTransfer): string;
}
