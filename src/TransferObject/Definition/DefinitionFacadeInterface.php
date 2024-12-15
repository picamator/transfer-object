<?php declare(strict_types=1);

namespace Picamator\TransferObject\Definition;

use Generator;

interface DefinitionFacadeInterface
{
    /**
     * Specification:
     * - Reads all definition files
     * - Parses definition content
     * - Validates definition content
     * - Converts definition content to `\Picamator\TransferObject\Generated\DefinitionTransfer`
     * - Returns Generator that additionally returns who many files where processed `Generator::getReturn()`
     *
     * @return \Generator<\Picamator\TransferObject\Generated\DefinitionTransfer>
     */
    public function getDefinitions(): Generator;
}
