<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Generator\Render;

use Picamator\TransferObject\Generated\DefinitionTransfer;
use Picamator\TransferObject\Generated\TransferGeneratorContentTransfer;
use Picamator\TransferObject\TransferGenerator\Generator\Render\Template\Template;

readonly class TemplateRender implements TemplateRenderInterface
{
    public function __construct(
        private TemplateBuilderInterface $templateBuilder,
        private Template $template,
    ) {
    }

    public function renderTemplate(DefinitionTransfer $definitionTransfer): TransferGeneratorContentTransfer
    {
        $templateTransfer = $this->templateBuilder->createTemplateTransfer($definitionTransfer);

        $content = $this->template->__invoke($templateTransfer);

        return new TransferGeneratorContentTransfer([
            TransferGeneratorContentTransfer::CLASS_NAME_PROP => $definitionTransfer->content->className,
            TransferGeneratorContentTransfer::CONTENT_PROP => $content,
        ]);
    }
}
