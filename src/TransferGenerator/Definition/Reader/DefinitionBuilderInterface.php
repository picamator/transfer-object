<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Definition\Reader;

use Picamator\TransferObject\Generated\DefinitionTransfer;

interface DefinitionBuilderInterface
{
    /**
     * @param array<string,mixed> $properties
     */
    public function buildDefinitionTransfer(string $className, array $properties): DefinitionTransfer;
}
