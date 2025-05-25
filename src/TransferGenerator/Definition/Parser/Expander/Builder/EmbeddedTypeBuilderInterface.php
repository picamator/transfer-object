<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Definition\Parser\Expander\Builder;

use Picamator\TransferObject\Generated\DefinitionEmbeddedTypeTransfer;

interface EmbeddedTypeBuilderInterface
{
    public function createTypeTransfer(string $type): DefinitionEmbeddedTypeTransfer;

    public function createPrefixTypeTransfer(string $type): DefinitionEmbeddedTypeTransfer;
}
