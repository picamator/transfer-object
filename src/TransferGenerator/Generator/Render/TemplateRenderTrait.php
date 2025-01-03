<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Generator\Render;

use Picamator\TransferObject\Generated\TemplateTransfer;

trait TemplateRenderTrait
{
    private const string META_CONSTANT_REGEX = '#(?<!^)[A-Z]#';

    protected function sortTemplate(TemplateTransfer $templateTransfer): void
    {
        $templateTransfer->imports->natsort();
        $templateTransfer->metaConstants->natsort();
    }

    protected function getMetaConstant(string $propertyName): string
    {
        /** @var string $propertyName */
        $propertyName = preg_replace(self::META_CONSTANT_REGEX, '_$0', $propertyName);

        return strtoupper($propertyName);
    }
}
