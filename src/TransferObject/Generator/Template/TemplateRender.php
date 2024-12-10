<?php declare(strict_types = 1);

namespace Picamator\TransferObject\Generator\Template;

use Picamator\TransferObject\Generated\TemplateTransfer;

readonly class TemplateRender implements TemplateRenderInterface
{
    private const string TEMPLATE_PATH = 'Transfer.tpl.php';

    public function renderTemplate(TemplateTransfer $templateTransfer): string
    {
        ob_start();

        include static::TEMPLATE_PATH;

        return ob_get_clean();
    }
}
