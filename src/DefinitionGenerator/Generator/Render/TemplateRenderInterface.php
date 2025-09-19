<?php

declare(strict_types=1);

namespace Picamator\TransferObject\DefinitionGenerator\Generator\Render;

use Picamator\TransferObject\Generated\DefinitionContentTransfer;

interface TemplateRenderInterface
{
    public function renderSchema(): string;

    /**
     * @throws \Picamator\TransferObject\DefinitionGenerator\Exception\DefinitionGeneratorException
     */
    public function renderContent(DefinitionContentTransfer $contentTransfer): string;
}
