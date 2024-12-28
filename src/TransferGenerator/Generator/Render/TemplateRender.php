<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Generator\Render;

use Picamator\TransferObject\TransferGenerator\Exception\TransferGeneratorException;
use Picamator\TransferObject\Generated\DefinitionContentTransfer;

readonly class TemplateRender implements TemplateRenderInterface
{
    private const string TEMPLATE_PATH = __DIR__ . '/Template/Template.tpl.php';

    public function __construct(
        private TemplateBuilderInterface $templateBuilder,
    ) {
    }

    public function renderTemplate(DefinitionContentTransfer $contentTransfer): string
    {
        $templateTransfer = $this->templateBuilder->buildTemplateTransfer($contentTransfer);

        ob_start();
        include self::TEMPLATE_PATH;
        $output = ob_get_clean();

        return $this->handleOutput($output);
    }

    private function handleOutput(false|string $output): string
    {
        $lastError = error_get_last();
        if ($lastError === null && $output !== false) {
            return $output;
        }

        throw new TransferGeneratorException(
            sprintf(
                'Template "%s" render error. Error: "%s", Line: "%s".',
                self::TEMPLATE_PATH,
                $lastError['message'] ?? '',
                $lastError['line'] ?? '',
            ),
        );
    }
}
