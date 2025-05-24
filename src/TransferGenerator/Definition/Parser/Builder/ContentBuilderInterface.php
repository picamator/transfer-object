<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Definition\Parser\Builder;

use Picamator\TransferObject\Generated\DefinitionContentTransfer;

interface ContentBuilderInterface
{
    /**
     * @param array<string,array<string,string|null>> $properties
     */
    public function createContentTransfer(string $className, array $properties): DefinitionContentTransfer;
}
