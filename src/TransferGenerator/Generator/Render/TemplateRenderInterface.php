<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Generator\Render;

use Picamator\TransferObject\Generated\DefinitionTransfer;
use Picamator\TransferObject\Generated\TransferGeneratorContentTransfer;

interface TemplateRenderInterface
{
    /**
     * @throws \Picamator\TransferObject\TransferGenerator\Exception\TransferGeneratorException
     */
    public function renderTemplate(DefinitionTransfer $definitionTransfer): TransferGeneratorContentTransfer;
}
