<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Definition\Parser\Expander\Builder;

use Picamator\TransferObject\Generated\DefinitionNamespaceTransfer;

interface NamespaceBuilderInterface
{
    public function createNamespaceTransfer(string $namespace): DefinitionNamespaceTransfer;
}
