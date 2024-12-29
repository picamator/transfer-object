<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Definition\Parser;

use Generator;

interface DefinitionParserInterface
{
    /**
     * @throws \Picamator\TransferObject\Dependency\Exception\YmlParserException
     *
     * @return Generator<int,\Picamator\TransferObject\Generated\DefinitionContentTransfer>
     */
    public function parseDefinition(string $definitionContent): Generator;
}
