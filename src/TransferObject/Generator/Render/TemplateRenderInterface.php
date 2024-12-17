<?php declare(strict_types = 1);

namespace Picamator\TransferObject\Generator\Render;

use Picamator\TransferObject\Transfer\Generated\DefinitionContentTransfer;

interface TemplateRenderInterface
{
    /**
     * @throws \Picamator\TransferObject\Exception\GeneratorTransferException
     */
    public function renderTemplate(DefinitionContentTransfer $contentTransfer): string;
}
