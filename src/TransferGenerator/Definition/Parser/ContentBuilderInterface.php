<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Definition\Parser;

use Picamator\TransferObject\Generated\DefinitionContentTransfer;

interface ContentBuilderInterface
{
    /**
     * @param array<string,mixed> $properties
     */
    public function createContentTransfer(string $className, array $properties): DefinitionContentTransfer;
}
