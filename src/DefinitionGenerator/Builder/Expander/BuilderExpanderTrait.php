<?php

declare(strict_types=1);

namespace Picamator\TransferObject\DefinitionGenerator\Builder\Expander;

use Picamator\TransferObject\Generated\DefinitionGeneratorContentTransfer;

trait BuilderExpanderTrait
{
    protected function getClassName(string $propertyName): string
    {
        $className = ucwords($propertyName, '_');

        return str_replace('_', '', $className);
    }

    /**
     * @param array<int|string,mixed> $content
     */
    protected function createGeneratorContentTransfer(string $className, array $content): DefinitionGeneratorContentTransfer
    {
        $contentTransfer = new DefinitionGeneratorContentTransfer();
        $contentTransfer->className = $className;
        $contentTransfer->content = $content;

        return $contentTransfer;
    }
}