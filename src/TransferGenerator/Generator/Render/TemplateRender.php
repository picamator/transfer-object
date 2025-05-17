<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Generator\Render;

use Picamator\TransferObject\Generated\DefinitionTransfer;
use Picamator\TransferObject\TransferGenerator\Exception\TransferGeneratorException;

readonly class TemplateRender implements TemplateRenderInterface
{
    private const string TEMPLATE_PATH = __DIR__ . '/Template/Template.tpl.php';

    private const string ERROR_MESSAGE_TEMPLATE = "Error: \"%s\".\n File: \"%s\".\n Line: \"%s\".";

    public function __construct(
        private TemplateBuilderInterface $templateBuilder,
        private TemplateHelperInterface $templateHelper,
    ) {
    }

    public function renderTemplate(DefinitionTransfer $definitionTransfer): string
    {
        $templateTransfer = $this->templateBuilder->createTemplateTransfer($definitionTransfer);
        $helper = $this->templateHelper->setTemplateTransfer($templateTransfer);

        /** @var string $output */
        $output = include self::TEMPLATE_PATH;

        $this->assertLastError();

        return $output;
    }

    /**
     * @throws TransferGeneratorException
     */
    private function assertLastError(): void
    {
        $lastError = error_get_last();
        if ($lastError === null || $lastError['file'] !== self::TEMPLATE_PATH) {
            return;
        }

        throw new TransferGeneratorException(
            sprintf(
                self::ERROR_MESSAGE_TEMPLATE,
                $lastError['message'],
                $lastError['file'],
                $lastError['line'],
            ),
        );
    }
}
