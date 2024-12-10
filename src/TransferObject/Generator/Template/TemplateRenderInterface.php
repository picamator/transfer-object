<?php declare(strict_types = 1);

namespace Picamator\TransferObject\Generator\Template;

use Picamator\TransferObject\Generated\TemplateTransfer;

interface TemplateRenderInterface
{
    public function renderTemplate(TemplateTransfer $templateTransfer): string;
}
