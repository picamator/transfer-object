<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Generator\Render;

use Picamator\TransferObject\Generated\TemplateTransfer;

interface TemplateSorterInterface
{
    public function sortTemplateTransfer(TemplateTransfer $templateTransfer): void;
}
