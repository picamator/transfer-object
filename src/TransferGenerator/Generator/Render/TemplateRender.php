<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Generator\Render;

use Picamator\TransferObject\Generated\DefinitionTransfer;
use Picamator\TransferObject\TransferGenerator\Generator\Render\Template\Template;

readonly class TemplateRender implements TemplateRenderInterface
{
    public function __construct(
        private TemplateBuilderInterface $templateBuilder,
        private Template $template,
    ) {
    }

    public function renderTemplate(DefinitionTransfer $definitionTransfer): string
    {
        $templateTransfer = $this->templateBuilder->createTemplateTransfer($definitionTransfer);

        return $this->template->__invoke($templateTransfer);
    }
}
