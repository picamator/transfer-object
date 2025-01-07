<?php

declare(strict_types=1);

namespace Picamator\Tests\Unit\TransferObject\TransferGenerator\Definition\Parser\Expander;

use Picamator\TransferObject\Generated\DefinitionNamespaceTransfer;

interface NamespacePropertyExpanderInterface
{
    public function createDefinitionNamespaceTransfer(string $namespace): DefinitionNamespaceTransfer;

    public function isNamespace(string $propertyType): bool;
}
