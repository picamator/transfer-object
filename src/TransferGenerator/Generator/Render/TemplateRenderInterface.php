<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Generator\Render;

use Picamator\TransferObject\Generated\DefinitionContentTransfer;
use Picamator\TransferObject\Generated\DefinitionTransfer;

interface TemplateRenderInterface
{
    /**
     * @throws \Picamator\TransferObject\TransferGenerator\Exception\TransferGeneratorException
     */
    public function renderTemplate(DefinitionTransfer $definitionTransfer): string;
}
