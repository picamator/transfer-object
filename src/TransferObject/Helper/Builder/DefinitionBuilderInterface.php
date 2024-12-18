<?php declare(strict_types = 1);

namespace Picamator\TransferObject\Helper\Builder;

use Generator;
use Picamator\TransferObject\Transfer\Generated\HelperContentTransfer;

interface DefinitionBuilderInterface
{
    /**
     * @throws \Picamator\TransferObject\Exception\HelperTransferException
     *
     * @return \Generator<\Picamator\TransferObject\Transfer\Generated\DefinitionContentTransfer>
     */
    public function buildDefinitionContents(HelperContentTransfer $helperContentTransfer): Generator;
}
