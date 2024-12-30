<?php

declare(strict_types=1);

namespace Picamator\TransferObject\DefinitionGenerator\Builder\Expander;

use Picamator\TransferObject\Generated\DefinitionGeneratorContentTransfer;

trait BuilderExpanderTrait
{
    /**
     * @see https://www.php.net/manual/en/language.oop5.basic.php
     * @see https://www.php.net/manual/en/language.variables.basics.php
     */
    private const string VARIABLE_NAME_PATTERN = '#^[a-zA-Z_\x80-\xff][a-zA-Z0-9_\x80-\xff]*$#';

    protected function getClassName(string $propertyName): string
    {
        $className = ucwords($propertyName, '_');

        return str_replace('_', '', $className);
    }

    /**
     * @param array<int|string,mixed> $content
     */
    protected function createGeneratorContentTransfer(
        string $className,
        array $content,
    ): DefinitionGeneratorContentTransfer {
        $contentTransfer = new DefinitionGeneratorContentTransfer();
        $contentTransfer->className = $className;
        $contentTransfer->content = $content;

        return $contentTransfer;
    }

    protected function isValidVariable(?string $variableName): bool
    {
        return $variableName !== null && preg_match(self::VARIABLE_NAME_PATTERN, $variableName) >= 1;
    }
}
