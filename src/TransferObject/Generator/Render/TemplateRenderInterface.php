<?php declare(strict_types = 1);

namespace Picamator\TransferObject\Generator\Render;

use Picamator\TransferObject\Generated\DefinitionContentTransfer;

interface TemplateRenderInterface
{
    public function renderTemplate(DefinitionContentTransfer $contentTransfer): string;
}
