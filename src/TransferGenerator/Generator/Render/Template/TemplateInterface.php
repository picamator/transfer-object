<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Generator\Render\Template;

use Picamator\TransferObject\Generated\TemplateTransfer;

interface TemplateInterface
{
    public function render(TemplateTransfer $templateTransfer): string;
}
