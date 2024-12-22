<?php declare(strict_types = 1);

namespace Picamator\TransferObject\DefinitionGenerator\Builder;

use Generator;
use Picamator\TransferObject\Generated\HelperContentTransfer;

interface DefinitionBuilderInterface
{
    /**
     * @throws \Picamator\TransferObject\DefinitionGenerator\Exception\GeneratorTransferException
     *
     * @return \Generator<\Picamator\TransferObject\Generated\DefinitionContentTransfer>
     */
    public function buildDefinitionContents(HelperContentTransfer $helperContentTransfer): Generator;
}
