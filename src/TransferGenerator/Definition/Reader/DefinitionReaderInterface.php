<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Definition\Reader;

use Generator;

interface DefinitionReaderInterface
{
    /**
     * @throws \Picamator\TransferObject\Dependency\Exception\YmlParserException
     *
     * @return \Generator<\Picamator\TransferObject\Generated\DefinitionTransfer>
     */
    public function getDefinitions(): Generator;
}
