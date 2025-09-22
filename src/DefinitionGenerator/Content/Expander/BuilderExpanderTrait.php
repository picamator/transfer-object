<?php

declare(strict_types=1);

namespace Picamator\TransferObject\DefinitionGenerator\Content\Expander;

use Picamator\TransferObject\Generated\DefinitionGeneratorContentTransfer;

trait BuilderExpanderTrait
{
    private const string CLASS_NAME_SEPARATOR = '_';

    final protected function getClassName(string $propertyName): string
    {
        $className = ucwords($propertyName, self::CLASS_NAME_SEPARATOR);

        return str_replace(self::CLASS_NAME_SEPARATOR, '', $className);
    }

    /**
     * @param array<int|string,mixed> $content
     */
    final protected function createGeneratorContentTransfer(
        string $className,
        array $content,
    ): DefinitionGeneratorContentTransfer {
        return new DefinitionGeneratorContentTransfer([
            DefinitionGeneratorContentTransfer::CLASS_NAME => $className,
            DefinitionGeneratorContentTransfer::CONTENT => $content,
        ]);
    }

    final protected function filterOnlyArray(mixed $item): bool
    {
        return is_array($item);
    }

    final protected function filterNonArray(mixed $item): bool
    {
        return !is_array($item);
    }
}
