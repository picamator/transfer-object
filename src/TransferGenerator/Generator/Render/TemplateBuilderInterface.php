<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Generator\Render;

use Picamator\TransferObject\Generated\DefinitionTransfer;
use Picamator\TransferObject\Generated\TemplateTransfer;

interface TemplateBuilderInterface
{
    /**
     * @throws \Picamator\TransferObject\TransferGenerator\Exception\TransferGeneratorConfigNotFoundException
     */
    public function createTemplateTransfer(DefinitionTransfer $definitionTransfer): TemplateTransfer;
}
